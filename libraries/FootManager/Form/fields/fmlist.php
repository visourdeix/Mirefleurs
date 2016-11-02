<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Form
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

jimport('FootManager.framework');
JFormHelper::loadFieldClass('list');

/**
 * Form Field class for the Joomla Platform.
 * Provides radio button inputs
 *
 * @link   http://www.w3.org/TR/html-markup/command.radio.html#command.radio
 * @since  11.1
 */
class JFormFieldFmList extends JFormFieldList
{

    protected $editLink;
    protected $buttonTitle;
    protected $placeholder;
    protected $inRepeater = false;
    protected $allowed_options;

    /**
     * Method to attach a JForm object to the field.
     *
     * @param   SimpleXMLElement  $element  The SimpleXMLElement object representing the <field /> tag for the form field object.
     * @param   mixed             $value    The form field value to validate.
     * @param   string            $group    The field name group control value. This acts as as an array container for the field.
     *                                      For example if the field has name="foo" and the group value is set to "bar" then the
     *                                      full field name would end up being "bar[foo]".
     *
     * @return  boolean  True on success.
     *
     * @see     JFormField::setup()
     * @since   3.2
     */
	public function setup(SimpleXMLElement $element, $value, $group = null)
	{
		$return = parent::setup($element, $value, $group);

		if ($return)
		{
			$this->editLink    = isset($this->element['editLink']) ? $this->element['editLink'] : $this->getDefaultEditLink();
            $this->buttonTitle    = isset($this->element['buttonTitle']) ? $this->element['buttonTitle'] : $this->getDefaultButtonTitle();
            $this->placeholder    = isset($this->element['placeholder']) ? $this->element['placeholder'] : $this->getDefaultPlaceHolder();
            $this->allowed_options    = isset($this->element['allowed_options']) ? explode(",", (string)$this->element['allowed_options']) : null;

		}

		return $return;
	}

    protected function getDefaultEditLink() {
        return "";
    }

    protected function getDefaultButtonTitle() {
        return "FMLIB_CREATE_NEW_ITEM";
    }

    protected function getDefaultPlaceHolder() {
        return "FMLIB_SELECT_ITEM";
    }

    protected function allowEdit() {
        return true;
    }

    /**
     * Method to get certain otherwise inaccessible properties from the form field object.
     *
     * @param   string  $name  The property name for which to the the value.
     *
     * @return  mixed  The property value or null.
     *
     * @since   11.1
     */
	public function __get($name)
	{
		switch ($name)
		{
            case "editLink";
            case "buttonTitle";
                return $this->$name;
        }

        return parent::__get($name);

    }

    /**
     * Method to get the field input markup.
     *
     * @return  string  The field input markup.
     *
     * @since   11.1
     */
	protected function getInput() {

        JHtml::_('formbehavior.chosen', 'select');

        $html = array();
		$attr = '';

		// Initialize some field attributes.
		$attr .= !empty($this->class) ? ' class="' . $this->class . '"' : '';
		$attr .= !empty($this->size) ? ' size="' . $this->size . '"' : '';
		$attr .= $this->multiple ? ' multiple' : '';
		$attr .= $this->required ? ' required aria-required="true"' : '';
		$attr .= $this->autofocus ? ' autofocus' : '';
        $attr .= $this->placeholder ? ' data-placeholder="'.JText::_($this->placeholder).'"' : '';

		// To avoid user's confusion, readonly="true" should imply disabled="true".
		if ((string) $this->readonly == '1' || (string) $this->readonly == 'true' || (string) $this->disabled == '1'|| (string) $this->disabled == 'true')
		{
			$attr .= ' disabled="disabled"';
		}

		// Initialize JavaScript field attributes.
		$attr .= $this->onchange ? ' onchange="' . $this->onchange . '"' : '';

		// Get the field options.
		$options = (array) $this->getOptions();

		// Create a read-only list (no name) with hidden input(s) to store the value(s).
		if ((string) $this->readonly == '1' || (string) $this->readonly == 'true')
		{
			$html[] = JHtml::_('select.genericlist', $options, '', trim($attr), 'value', 'text', $this->value, $this->id);

			// E.g. form field type tag sends $this->value as array
			if ($this->multiple && is_array($this->value))
			{
				if (!count($this->value))
				{
					$this->value[] = '';
				}

				foreach ($this->value as $value)
				{
					$html[] = '<input type="hidden" name="' . $this->name . '" value="' . htmlspecialchars($value, ENT_COMPAT, 'UTF-8') . '" />';
				}
			}
			else
			{
				$html[] = '<input type="hidden" name="' . $this->name . '" value="' . htmlspecialchars($this->value, ENT_COMPAT, 'UTF-8') . '" />';
			}
		}
		else
		// Create a regular list.
		{
            if($this->editLink != '' && !$this->inRepeater && $this->allowEdit())
                $html[] = "<div class='input-append'>";

			$html[] = JHtml::_('select.genericlist', $options, $this->name, array("list.attr" => trim($attr), "option.attr" => "attributes", "list.select" =>$this->value, "id" => $this->id));

            if($this->editLink != '' && !$this->inRepeater && $this->allowEdit())
                $html[] = "<a class='btn hasTooltip' href='".JRoute::_($this->editLink)."' target='_blank' title='".JText::_($this->buttonTitle)."'><span class='fa fa-plus'></span></a></div>";
		}

		return implode("\n\r", $html);

	}

    /**
     * Method to get a list of categories that respects access controls and can be used for
     * either category assignment or parent category assignment in edit screens.
     * Use the parent element to indicate that the field will be used for assigning parent categories.
     *
     * @return  array  The field option objects.
     *
     * @since   1.6
     */
	protected function getOptions()
	{
		$options = $this->getDefaultOptions();

        if(isset($this->allowed_options)) {
            foreach ($options as $key => $option)
            {
                if(!in_array($option->value, $this->allowed_options)) {
                    unset($options[$key]);
                }
            }
        }

		// Merge any additional options in the XML definition.
		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}

    /**
     * Method to get a list of categories that respects access controls and can be used for
     * either category assignment or parent category assignment in edit screens.
     * Use the parent element to indicate that the field will be used for assigning parent categories.
     *
     * @return  array  The field option objects.
     *
     * @since   1.6
     */
	protected function getDefaultOptions()
	{
		return array();
	}

}