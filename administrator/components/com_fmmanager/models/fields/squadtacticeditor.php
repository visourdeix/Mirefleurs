<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Form
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;
require_once __DIR__ .'/tacticeditor.php';

/**
 * Form Field class for the Joomla Platform.
 * Display a JSON loaded window with a repeatable set of sub fields
 *
 * @package     Joomla.Platform
 * @subpackage  Form
 * @since       3.2
 */
class JFormFieldSquadTacticEditor extends JFormFieldTacticEditor
{
    protected $tactic;

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
			$this->tactic    = (string) $this->element['tactic'] ? (string) $this->element['tactic'] : 0;
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

        $values = array();
        if(is_string($this->value))
            $values = (array)json_decode($this->value);
        elseif(is_object($this->value))
            $values = get_object_vars($this->value);
        else
            $values = (array)$this->value;

        $fields = array();
        foreach ($this->subForm->getGroup(null) as $field)
		{
            $field->__set("inRepeater", true);
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

        $attribs["name"] = $this->name;
        $attribs["values"] = $values;
        $attribs["readonlypositions"] = $this->getTactic();
        $attribs["tooltipkey"] = $this->tooltip;
        $attribs["editinputs"] = $fields;
        $attribs["readonly"] = $this->readonly;
        $attribs["labelkey"] = $this->labelkey;
        $attribs["numberkey"] = $this->numberkey;

        $str[] = '<div id="'.$this->id.'_tacticeditor" class="'.$this->class.'"></div>';

        FMManager\Html\Tactic::editor('#'.$this->id.'_tacticeditor', $attribs);

        return implode("\n", $str);

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
	protected function getTactic()
	{
        $options = \FMManager\Database\Models\TacticPositions::where("tactic_id", "=", $this->tactic)->get()->toArray();

		return $options;
	}

}