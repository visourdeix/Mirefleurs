<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Form
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;
jimport('FMManager.library');
FootManager\Form\Helper::loadFieldClass('fmgroupedlist');

/**
 * Form Field class for the Joomla Platform.
 * Provides radio button inputs
 *
 * @link   http://www.w3.org/TR/html-markup/command.radio.html#command.radio
 * @since  11.1
 */
class JFormFieldPersonsList extends JFormFieldFmGroupedList
{
    protected $group;

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
            $this->group    = (string) $this->element['group'] ? (string) $this->element['group'] : "";

		}

		return $return;
	}

    protected function getDefaultEditLink() {
        return "index.php?option=".FM_MANAGER_COMPONENT."&task=person.edit";
    }

    protected function getDefaultButtonTitle() {
        return "COM_FMMANAGER_CREATE_NEW_PERSON";
    }

    protected function getDefaultPlaceHolder() {
        return "COM_FMMANAGER_SELECT_PERSON";
    }

    protected function allowEdit() {
        return FootManager\Helpers\Access::getActions(FM_MANAGER_COMPONENT)->get("persons.manage");
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
        switch ($this->group)
        {
            case "category":
                return FMManager\Database\Models\Person::with("category")->orderByCategory()->get()->toGroupedDropdown(function($obj) { return ($obj->category) ? $obj->category->label : JText::_("FM_MANAGERS"); }, "inverse_name");

            case "position":
                return FMManager\Database\Models\Person::with("position")->orderByPosition()->get()->toGroupedDropdown(function($obj) { return ($obj->position) ? $obj->position->label : JText::_("FM_NONE"); }, "inverse_name");
                
        	default:
                return FMManager\Database\Models\Person::all()->toGroupedDropdown(function($obj) { return substr($obj->last_name, 0, 1); }, "inverse_name");
        }
    }

}