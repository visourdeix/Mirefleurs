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
JFormHelper::loadFieldClass('checkboxes');

/**
 * Form Field class for the Joomla Platform.
 * Displays options as a list of check boxes.
 * Multiselect may be forced to be true.
 *
 * @see    JFormFieldCheckbox
 * @since  11.1
 */
class JFormFieldFmToggles extends JFormFieldCheckboxes
{
	/**
     * The form field type.
     *
     * @var    string
     * @since  11.1
     */
	protected $type = 'FmToggles';

    protected $onText;
    protected $offText;
	protected $size;
    protected $onColor;
    protected $offColor;
    protected $all;

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
			$this->onText    = (string) $this->element['onText'] ? (string) $this->element['onText'] : '<i class=\'fa fa-check\'></i>';
			$this->offText    = (string) $this->element['offText'] ? (string) $this->element['offText'] : '<i class=\'fa fa-remove\'></i>';
            $this->size    = (string) $this->element['size'] ? (string) $this->element['size'] : "mini";
			$this->onColor    = (string) $this->element['onColor'] ? (string) $this->element['onColor'] : "primary";
			$this->offColor    = (string) $this->element['offColor'] ? (string) $this->element['offColor'] : "default";
            $this->all    = isset($this->element['all']) ? ((string)$this->element['all'] == "true" || (string)$this->element['all'] == "1") : false;
		}

		return $return;
	}

	/**
     * Method to get the field input markup for check boxes.
     *
     * @return  string  The field input markup.
     *
     * @since   11.1
     */
	protected function getInput()
	{

		$html = array();

        $attribs = array();
		$attribs["on"]   = JText::_($this->onText);
		$attribs["off"]    = JText::_($this->offText);
		$attribs["size"]    = $this->size;
		$attribs["onstyle"]    = $this->onColor;
		$attribs["offstyle"] = $this->offColor;
        $attribs["style"] = $this->class;

		// Initialize some field attributes.
		$checkedOptions = explode(',', (string) $this->checkedOptions);
		$required       = $this->required ? ' required aria-required="true"' : '';
		$autofocus      = $this->autofocus ? ' autofocus' : '';

        $values = (is_string($this->value)) ? explode(',', $this->value) : (array)$this->value;

		// Including fallback code for HTML5 non supported browsers.
		JHtml::_('jquery.framework');
		JHtml::_('script', 'system/html5fallback.js', false, true);

		// Start the checkbox field output.
		$html[] = '<fieldset id="' . $this->id . '" class="fmtoggles "' . $required . $autofocus . '>';

		// Get the field options.
		$options = $this->getOptions();

		// Build the checkbox field output.
		$html[] = '<ul>';

        if($this->all) {
            $html[] = '<li class="all">';
            $html[] = '<span id="' . $this->id.'_all" class="btn tn-default btn-mini">'.JText::_("FMLIB_ALL_SELECT_UNSELECT").'</span>';
            $html[] = '</li>';
        }

		foreach ($options as $i => $option)
		{
            $checked = '';
			// Initialize some option attributes.
			if (!isset($values) || empty($values))
			{
				$checked = (in_array((string) $option->value, (array) $checkedOptions) ? ' checked' : '');
			}
			else
			{
				$checked = (in_array((string) $option->value, $values) ? ' checked' : '');
			}

			$checked = empty($checked) && isset($option->checked) && $option->checked ? ' checked' : $checked;
            $disabled = (isset($option->disabled) && $option->disabled);

			$html[] = '<li>';
            $html[] = FootManager\UI\Html\Form::checkbox(array("id" => $this->id, "name" => $this->name, "value" => $option->value, "class" => "fmtoggle"), $checked, $disabled);

			$html[] = '<label for="' . $this->id . $i.'">' . JText::_($option->text) . '</label>';
			$html[] = '</li>';
		}

		$html[] = '</ul>';

		// End the checkbox field output.
		$html[] = '</fieldset>';

        FootManager\UI\ui::toggle('#'.$this->id.' input[name="'.$this->name.'"]', $attribs);

		return implode($html);
	}
}