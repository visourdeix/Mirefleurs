<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Form
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;
jimport('FMManager.library');

/**
 * Form Field class for the Joomla Platform.
 * Display a JSON loaded window with a repeatable set of sub fields
 *
 * @package     Joomla.Platform
 * @subpackage  Form
 * @since       3.2
 */
class JFormFieldTacticEditor extends JFormField
{
    protected $subForm;
    protected $tooltip;
    protected $labelkey;
    protected $numberkey;

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
            $this->tooltip    = (string) $this->element['tooltip'] ? (string) $this->element['tooltip'] : "";
            $this->labelkey    = (string) $this->element['labelkey'] ? (string) $this->element['labelkey'] : "";
            $this->numberkey    = (string) $this->element['numberkey'] ? (string) $this->element['numberkey'] : "";

			// Initialize variables.
			$this->subForm = new JForm($this->name, array('control' => ""));
            $children = $this->element->children();
            if(count((array)$children) > 0 && $children[0]->getName() !== 'field') {
                $children = $children[0]->children();
            }
			$xml = $children->asXML();

			$this->subForm->load($xml);
            $this->subForm->setFields($children);

			// Needed for repeating modals in gmaps
			$this->subForm->repeatCounter = (int) @$this->form->repeatCounter;
		}

		return $return;
	}

	/**
     * Method to get the field input markup.
     *
     * @return  string  The field input markup.
     *
     * @since   3.2
     */
	protected function getInput()
	{
		$attribs = array();
        $fields = array();
        if(is_string($this->value))
            $values = (array)json_decode($this->value);
        elseif(is_object($this->value))
            $values = get_object_vars($this->value);
        else
            $values = (array)$this->value;

        foreach ($this->subForm->getGroup(null) as $field)
		{
            if(($field instanceof JFormFieldFmList || $field instanceof JFormFieldFmGroupedList)) {
                if($field->__get("editLink") != "" && $field->__get("editLink") != "none") {
                    $field->__set("editLink", "");
                }
            }

			$item = array();
            $item["key"] = $field->name;
			$item["label"] = $field->getLabel($field->name);
			$item["description"] = JText::_($field->description);
			$item["input"] = $field->getInput();
			$fields[] = $item;
		}

        $attribs["values"] = $values;
        $attribs["editinputs"] = $fields;
        $attribs["tooltipkey"] = $this->tooltip;
        $attribs["labelkey"] = $this->labelKey;
        $attribs["numberkey"] = $this->numberkey;
        $attribs["name"] = $this->name;

        $str[] = '<div id="'.$this->id.'_tacticeditor" class="'.$this->class.'"></div>';

        FMManager\Html\Tactic::editor('#'.$this->id.'_tacticeditor', $attribs);

        return implode("\n", $str);

	}

    /**
     * Method to get a control group with label and input.
     *
     * @param   array  $options  Options to be passed into the rendering of the field
     *
     * @return  string  A string containing the html for the control group
     *
     * @since   3.2
     */
	public function renderField($options = array())
	{

        $html = array();

        $html[] = '<div class="control-group">';
        $html[] = $this->getLabel();
        $html[] = $this->getInput();
        $html[] = '</div>';

        return implode("\n", $html);

	}

}