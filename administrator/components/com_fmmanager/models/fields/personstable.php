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
class JFormFieldPersonsTable extends JFormField
{

    protected $subForm;
    protected $persons;
    protected $fixed_fields;

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
            $this->persons    = (string) $this->element['persons'] ? (string) $this->element['persons'] : "";

            // Initialize variables.
			$this->subForm = new JForm($this->name, array('control' => $this->name));
            $children = $this->element->children();
            if(count((array)$children) > 0 && $children[0]->getName() !== 'field') {
                $children = $children[0]->children();
            }
            $xml = $children->asXML();

            $this->subForm->load($xml);

            if(count((array)$children))
                $this->subForm->setFields($children);

			// Needed for repeating modals in gmaps
            $this->subForm->repeatCounter = (int) @$this->form->repeatCounter;
            $this->subForm->repeat = 1;

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

        // Init variables
		$fields = array();

        $value = array_map(function($obj) { return is_object($obj) ? JArrayHelper::fromObject($obj) : $obj; }, (array)$this->value);

        // Init Persons
        $persons = $this->getPersons();

        // Init fields
        $fields = $this->subForm->getGroup(null);

        $str = array();

        // Add Table
        $str[] = '  <table id="'.$this->id.'_personstable" class="table fm-table-responsive table-striped'.$this->class.'">';

        // Header
        $str[] = '      <thead>';

        // Person Name
        $str[] = '          <tr>';

        $str[] = '              <th>';
        $str[] =                    JText::_("COM_FMMANAGER_FIELD_PERSON") ;
        $str[] = '              </th>';

        foreach ($fields as $field)
		{
            $str[] = '          <th class="center">';
            $str[] = '              <span class="hasTooltip" title="' . JText::_($field->description) . '">' . strip_tags($field->getLabel($field->name)) . '</span>';
            $str[] = '          </th>';
        }

        $str[] = '          </tr>';
        $str[] = '      </thead>';

        // Body
        $str[] = '      <tbody>';

        // Row ALL
        $str[] = '       <tr class="fm-row-all">';

        $str[] = '          <td class="fm-cell-all" data-title="">';
        $str[] =                    JText::_("FMLIB_ALL_3");
        $str[] = '          </td>';

        foreach ($fields as $field)
        {
            $field->__set("inRepeater", true);
            $field->__set("id", $field->getAttribute("name"));
            $field->__set("name", "all][".$field->getAttribute("name"));
            if(($field instanceof JFormFieldFmList || $field instanceof JFormFieldFmGroupedList)) {
                if($field->__get("editLink") != "" && $field->__get("editLink") != "none") {
                    if(!$field->readonly && !$field->disabled)
                        $links[] = array($field->__get("editLink"), $field->__get("buttonTitle"));
                    $field->__set("editLink", "");
                }
            }

            $str[] = '          <td class="center" data-title="' . strip_tags($field->getLabel($field->name)) . '">';
            $str[] =                    '<div>'.$field->getInput().'</div>';
            $str[] = '          </td>';
        }

        $str[] = '          </tr>';

        // Persons
        foreach ($persons as $person)
        {

            $str[] = '       <tr>';

            // Person Row
            $str[] = '          <td data-title="' . JText::_("COM_FMMANAGER_FIELD_PERSON") . '">';
            $str[] =                    FootManager\UI\Html\Form::hidden(array("value" => $person->id, "name" => $this->name."[".$person->id."][person_id]"));
            $str[] =                    $person->inverse_name;
            $str[] = '          </td>';

            foreach ($fields as $field)
            {
                if($field instanceof JFormFieldFmToggle)
                    $field->__set("checked", false);
                $field->setValue($field->default);

                if(isset($value[$person->id])) {
                    if(isset($value[$person->id][$field->getAttribute("name")])) {
                        if($field instanceof JFormFieldFmToggle)
                            $field->__set("checked", $value[$person->id][$field->getAttribute("name")]);
                        else
                            $field->setValue($value[$person->id][$field->getAttribute("name")]);

                    }
                }
                $field->__set("id", $person->id);
                $field->__set("name", $person->id."][".$field->getAttribute("name"));

                $str[] = '          <td style="min-height:12px" class="center" data-title="' . strip_tags($field->getLabel($field->name)) . '" >';
                $str[] =                    '<div>'.$field->getInput().'</div>';
                $str[] = '          </td>';
            }

            $str[] = '          </tr>';

        }
        $str[] = '      </tbody>';

        $str[] = '  </table>';

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

    /**
     * Method to get a list of categories that respects access controls and can be used for
     * either category assignment or parent category assignment in edit screens.
     * Use the parent element to indicate that the field will be used for assigning parent categories.
     *
     * @return  array  The field option objects.
     *
     * @since   1.6
     */
	protected function getPersons()
	{
        if($this->persons) {
            return FMManager\Database\Models\Person::whereIn("id", (array)explode(",", $this->persons))->get();
        }
		return array();
	}

}