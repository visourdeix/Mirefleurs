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
JFormHelper::loadFieldClass('groupedlist');
/**
 * Form Field class for the Joomla Platform.
 * Provides radio button inputs
 *
 * @link   http://www.w3.org/TR/html-markup/command.radio.html#command.radio
 * @since  11.1
 */
class JFormFieldFmGroupedList extends JFormFieldGroupedList
{
	/**
     * The form field type.
     *
     * @var    string
     * @since  11.1
     */
	protected $type = 'FmGroupedList';

    protected $editLink;
    protected $buttonTitle;
    protected $placeholder;
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
		$attr .= $this->disabled ? ' disabled' : '';
		$attr .= !empty($this->size) ? ' size="' . $this->size . '"' : '';
		$attr .= $this->multiple ? ' multiple' : '';
		$attr .= $this->required ? ' required aria-required="true"' : '';
		$attr .= $this->autofocus ? ' autofocus' : '';
        $attr .= $this->placeholder ? ' data-placeholder="'.JText::_($this->placeholder).'"' : '';

		// Initialize JavaScript field attributes.
		$attr .= !empty($this->onchange) ? ' onchange="' . $this->onchange . '"' : '';

		// Get the field groups.
		$groups = (array) $this->getGroups();

		// Create a read-only list (no name) with a hidden input to store the value.
		if ($this->readonly)
		{
			$html[] = JHtml::_(
				'select.groupedlist', $groups, null,
				array(
					'list.attr' => $attr, 'id' => $this->id, 'list.select' => $this->value, 'group.items' => null, 'option.key.toHtml' => false,
					'option.text.toHtml' => false
				)
			);
			$html[] = '<input type="hidden" name="' . $this->name . '" value="' . htmlspecialchars($this->value, ENT_COMPAT, 'UTF-8') . '" />';
		}

		// Create a regular list.
		else
		{
            if($this->editLink != '' && !$this->inRepeater && $this->allowEdit())
                $html[] = "<div class='input-append'>";

			$html[] = JHtml::_(
				'select.groupedlist', $groups, $this->name,
				array(
					'list.attr' => $attr, 'id' => $this->id, 'list.select' => $this->value, 'group.items' => null, 'option.key.toHtml' => false,
					'option.text.toHtml' => false, "option.attr" => "attributes"
				)
			);

            if($this->editLink != '' && !$this->inRepeater && $this->allowEdit())
                $html[] = "<a class='btn hasTooltip' href='".JRoute::_($this->editLink)."' target='_blank' title='".JText::_($this->buttonTitle)."'><span class='fa fa-plus'></span></a></div>";
		}

		return implode($html);

	}

    /**
     * Method to get the field option groups.
     *
     * @return  array  The field option objects as a nested array in groups.
     *
     * @since   11.1
     * @throws  UnexpectedValueException
     */
	protected function getGroups()
	{
        $groups = $this->getDefaultGroups();

        if(isset($this->allowed_options)) {
            foreach ($groups as $group => $options)
            {
            	foreach ($options as $key => $option)
                {
                    if(!in_array($option->value, $this->allowed_options)) {
                        unset($groups[$group][$key]);
                    }
                }

                if(count($groups[$group]) == 0) {
                    unset($groups[$group]);
                }
            }
        }

        // Merge any additional options in the XML definition.
		$groups = array_merge(parent::getGroups(), $groups);

        return $groups;
    }

    /**
     * Method to get the field option groups.
     *
     * @return  array  The field option objects as a nested array in groups.
     *
     * @since   11.1
     * @throws  UnexpectedValueException
     */
	protected function getDefaultGroups()
	{
        return array();
    }

}