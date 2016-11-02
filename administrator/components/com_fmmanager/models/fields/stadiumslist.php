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
class JFormFieldStadiumsList extends JFormFieldFmGroupedList
{

    protected function getDefaultEditLink() {
        return "index.php?option=".FM_MANAGER_COMPONENT."&task=stadium.edit";
    }

    protected function getDefaultButtonTitle() {
        return "COM_FMMANAGER_CREATE_NEW_STADIUM";
    }

    protected function getDefaultPlaceHolder() {
        return "COM_FMMANAGER_SELECT_STADIUM";
    }

    protected function allowEdit() {
        return FootManager\Helpers\Access::getActions(FM_MANAGER_COMPONENT)->get("stadiums.manage");
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
        $groups = array();

        $stadiums = FMManager\Database\Models\Stadium::all();
        $my_teams_stadium_id = FMManager\Database\Models\Team::withoutGlobalScopes()->where("club_id", "=", FMManager\Helper::getMyClubId())->get()->map(function($obj) { return $obj->stadium_id; })->toArray();

        $groups[JText::_("COM_FMMANAGER_GROUP_MY_STADIUMS")] = $stadiums->whereIn("id", $my_teams_stadium_id)->toDropdown("name_and_city");
        $groups[JText::_("COM_FMMANAGER_GROUP_OTHER_STADIUMS")] = $stadiums->except($my_teams_stadium_id)->toDropdown("name_and_city");

        return $groups;
    }

}