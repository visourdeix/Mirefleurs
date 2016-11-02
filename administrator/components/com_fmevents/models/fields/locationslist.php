<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Form
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;
jimport('FMEvents.framework');
FootManager\Form\Helper::loadFieldClass('fmlist');

/**
 * Form Field class for the Joomla Platform.
 * Provides radio button inputs
 *
 * @link   http://www.w3.org/TR/html-markup/command.radio.html#command.radio
 * @since  11.1
 */
class JFormFieldLocationsList extends JFormFieldFmList
{

    protected function getDefaultEditLink() {
        return "index.php?option=".FM_EVENTS_COMPONENT."&task=location.edit";
    }

    protected function getDefaultButtonTitle() {
        return "COM_FMEVENTS_CREATE_NEW_LOCATION";
    }

    protected function getDefaultPlaceHolder() {
        return "COM_FMEVENTS_SELECT_LOCATION";
    }

    protected function allowEdit() {
        return FootManager\Helpers\Access::getActions(FM_EVENTS_COMPONENT)->get("locations.manage");
    }

    /**
     * Method to get the field option groups.
     *
     * @return  array  The field option objects as a nested array in groups.
     *
     * @since   11.1
     * @throws  UnexpectedValueException
     */
	protected function getDefaultOptions()
	{
        return FMEvents\Database\Models\Location::all()->toDropdown("name");
    }

}