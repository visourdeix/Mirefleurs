<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * HTML Article View class for the Content component
 *
 * @since  1.5
 */
class FmeventsViewCalendar extends FootManager\View\Item
{

    protected function getDescription() {
        return JText::_('COM_FMEVENTS_DESCRIPTION_CALENDAR');
    }

    protected function getItemTitle() {
        return JText::_("COM_FMEVENTS_CALENDAR");
    }

}