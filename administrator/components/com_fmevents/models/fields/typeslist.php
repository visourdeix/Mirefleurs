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
class JFormFieldTypesList extends JFormFieldFmList
{

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
        $types = array();
        $searchtypes = FootManager\Helpers\Plugin::trigger(FM_EVENTS, "onGetType");

        foreach ($searchtypes as $type)
        {
            if (is_array($type))
            {
                $types = array_merge($types, $type);
            }
        }

        $options = array();
        foreach ($types as $key => $type)
        {
        	$item = new stdClass();
            $item->value = $key;
            $item->text = JText::_($type["title"]);
            $options[] = $item;
        }

        return $options;
	}

}