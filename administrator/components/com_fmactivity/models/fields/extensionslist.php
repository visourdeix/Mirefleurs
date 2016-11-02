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
class JFormFieldExtensionsList extends JFormFieldFmList
{

    /**
     * A flexible category list that respects access controls
     *
     * @var    string
     * @since  1.6
     */
	public $type = 'ExtensionsList';

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
        return FMActivity\Database\Models\Type::all()->unique("extension")->map(function($obj) {
             \JFactory::getLanguage()->load($obj->extension);
            $new_obj = new stdClass();
            $new_obj->extension = $obj->extension;
            $new_obj->label = JText::_(strtoupper($obj->extension));
            return $new_obj;
            })->toDropdown("label", "extension");
	}

}