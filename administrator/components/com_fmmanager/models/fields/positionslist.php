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
FootManager\Form\Helper::loadFieldClass('fmlist');

/**
 * Form Field class for the Joomla Platform.
 * Provides radio button inputs
 *
 * @link   http://www.w3.org/TR/html-markup/command.radio.html#command.radio
 * @since  11.1
 */
class JFormFieldPositionsList extends JFormFieldFmList
{

    protected function getDefaultEditLink() {
        return "index.php?option=".FM_MANAGER_COMPONENT."&task=position.edit";
    }

    protected function getDefaultButtonTitle() {
        return "COM_FMMANAGER_CREATE_NEW_POSITION";
    }

    protected function getDefaultPlaceHolder() {
        return "COM_FMMANAGER_SELECT_POSITION";
    }

    protected function allowEdit() {
        return FootManager\Helpers\Access::getActions(FM_MANAGER_COMPONENT)->get("data.manage");
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
	protected function getDefaultOptions()
	{
        return FMManager\Database\Models\Position::all()->toDropdown();
	}

}