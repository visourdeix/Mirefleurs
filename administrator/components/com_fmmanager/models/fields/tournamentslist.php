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
class JFormFieldTournamentsList extends JFormFieldFmGroupedList
{

    protected function getDefaultEditLink() {
        return "index.php?option=".FM_MANAGER_COMPONENT."&task=tournament.edit";
    }

    protected function getDefaultButtonTitle() {
        return "COM_FMMANAGER_CREATE_NEW_TOURNAMENT";
    }

    protected function getDefaultPlaceHolder() {
        return "COM_FMMANAGER_SELECT_TOURNAMENT";
    }

    protected function allowEdit() {
        return FootManager\Helpers\Access::getActions(FM_MANAGER_COMPONENT)->get("competitions.manage");
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
        return FMManager\Database\Models\Tournament::joinCategory()->joinTournamentType()->orderBy("fm_categories.ordering")->orderBy("fm_tournament_types.ordering")->orderBy("fm_tournaments.ordering")->with("category")->get()->toGroupedDropdown(function($obj) { return $obj->category->label; }, "name");
    }

}