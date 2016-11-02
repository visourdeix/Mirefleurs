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
FootManager\Form\Helper::loadFieldClass('fmstateslist');

/**
 * Form Field class for the Joomla Platform.
 * Provides radio button inputs
 *
 * @link   http://www.w3.org/TR/html-markup/command.radio.html#command.radio
 * @since  11.1
 */
class JFormFieldStatesList extends JFormFieldFmStatesList
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
        $options = array();

        $notPlayed = new stdClass();
        $notPlayed->value = FMManager\Constants::NOT_PLAYED;
        $notPlayed->text = JText::_("FM_STATE_0");
        $options[] = $notPlayed;

        $played = new stdClass();
        $played->value = FMManager\Constants::PLAYED;
        $played->text = JText::_("FM_STATE_1");
        $options[] = $played;

        $reported = new stdClass();
        $reported->value = FMManager\Constants::REPORTED;
        $reported->text = JText::_("FM_STATE_2");
        $options[] = $reported;

        $cancelled = new stdClass();
        $cancelled->value = FMManager\Constants::CANCELLED;
        $cancelled->text = JText::_("FM_STATE_3");
        $options[] = $cancelled;

        $stopped = new stdClass();
        $stopped->value = FMManager\Constants::STOPPED;
        $stopped->text = JText::_("FM_STATE_4");
        $options[] = $stopped;

		return $options;
	}

}