<?php
/**
 * @package      com_fmevents.administrator
 * @subpackage   Helpers
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

defined('JPATH_PLATFORM') or die;
jimport('FMActivity.library');

/**
 * This class contains common methods and properties
 * used in work with forms on the back-end.
 *
 * @package      com_fmevents.administrator
 * @subpackage   Helpers
 */
class FmactivityHelper
{
    private static $entries = array(
                                array("activities", "COM_FMACTIVITY_MENU_ACTIVITIES", "")
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
        $view     = JFactory::getApplication()->input->get('view');
        $view = ($view) ? ($view) : "activities";

        $actions = FootManager\Helpers\Access::getActions(FM_ACTIVITY_COMPONENT);

        foreach (self::$entries AS $entry) {
            if(empty($entry[2]) || $actions->get($entry[2].".admin"))
                JHtmlSidebar::addEntry(JText::_($entry[1]),'index.php?option=' . FM_ACTIVITY_COMPONENT.'&view='.$entry[0],($view == $entry[0]));

        }

    }
}