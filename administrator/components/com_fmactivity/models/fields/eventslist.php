<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Form
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

jimport('FMActivity.library');
FootManager\Form\Helper::loadFieldClass('fmlist');

/**
 * Form Field class for the Joomla Platform.
 * Provides radio button inputs
 *
 * @link   http://www.w3.org/TR/html-markup/command.radio.html#command.radio
 * @since  11.1
 */
class JFormFieldEventsList extends JFormFieldFmList
{

    /**
     * A flexible category list that respects access controls
     *
     * @var    string
     * @since  1.6
     */
	public $type = 'EventsList';

    protected function allowEdit() {
        return false;
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
        return FMActivity\Database\Models\Event::all()->map(function($obj) {
             \JFactory::getLanguage()->load("plg_fmactivity_content");
            $new_obj = new stdClass();
            $new_obj->id = $obj->id;

            if($obj->plugin)
                $new_obj->label = JText::_("PLG_FMACTIVITY_CONTENT_".strtoupper($obj->name)."_LABEL");
            else
                $new_obj->label = JText::_("COM_FMACTIVITY_".strtoupper($obj->name)."_LABEL");
            return $new_obj;
            })->toDropdown("label", "id");
	}

}