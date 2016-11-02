<?php
/**
 * @package      com_fmevents.administrator
 * @subpackage   Helpers
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

defined('JPATH_PLATFORM') or die;
jimport('FMEvents.library');

/**
 * This class contains common methods and properties
 * used in work with forms on the back-end.
 *
 * @package      com_fmevents.administrator
 * @subpackage   Helpers
 */
class FmeventsHelper
{
    private static $entries = array(
                                array("events", "COM_FMEVENTS_MENU_EVENTS", ""),
                                array("locations", "COM_FMEVENTS_MENU_LOCATIONS", "locations")
                                );

    /**
     * Configure the Linkbar.
     *
     * @param     string    $view    The name of the active view.
     *
     * @return    void
     */
    public static function addSubmenu()
    {
        jimport("FMEvents.framework");
        $component     = JFactory::getApplication()->input->get('option');

        if($component == 'com_categories')
            $view = 'categories';
        else {
            $view     = JFactory::getApplication()->input->get('view');
            $view = ($view) ? ($view) : "events";
        }
        $actions = FootManager\Helpers\Access::getActions(FM_EVENTS_COMPONENT);

        foreach (self::$entries AS $entry) {
            if(empty($entry[2]) || $actions->get($entry[2].".admin"))
                JHtmlSidebar::addEntry(JText::_($entry[1]),'index.php?option=' . FM_EVENTS_COMPONENT.'&view='.$entry[0],($view == $entry[0]));

        }

        if($actions->get("core.manage")) {
            JHtmlSidebar::addEntry(JText::_("FMLIB_MENU_CATEGORIES"),'index.php?option=com_categories&extension='.FM_EVENTS_COMPONENT,($view == 'categories'));
        }
    }
}