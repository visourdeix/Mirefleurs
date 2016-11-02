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
class JFormFieldRostersList extends JFormFieldFmGroupedList
{

    protected function getDefaultEditLink() {
        return "index.php?option=".FM_MANAGER_COMPONENT."&task=roster.edit";
    }

    protected function getDefaultButtonTitle() {
        return "COM_FMMANAGER_CREATE_NEW_ROSTER";
    }

    protected function getDefaultPlaceHolder() {
        return "COM_FMMANAGER_SELECT_ROSTER";
    }

    protected function allowEdit() {
        return FootManager\Helpers\Access::getActions(FM_MANAGER_COMPONENT)->get("rosters.manage");
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
        return FMManager\Database\Models\Roster::orderBySeason()->orderByCategory()->get()->toGroupedDropdown(function($obj) { return $obj->season->label; }, "small_name");
    }

}