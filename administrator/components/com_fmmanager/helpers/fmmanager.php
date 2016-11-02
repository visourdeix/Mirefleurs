<?php
/**
 * @package      Fmmanager
 * @subpackage   Dashboard
 *
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 */

defined('_JEXEC') or die();

jimport('FootManager.framework');

class FmmanagerHelper
{
    private static $entries = array(
                                array("dashboard", "COM_FMMANAGER_MENU_DASHBOARD", ""),
                                array("tournaments", "COM_FMMANAGER_MENU_TOURNAMENTS", "competitions"),
                                array("competitions", "COM_FMMANAGER_MENU_COMPETITIONS", "competitions"),
                                array("matchdays", "COM_FMMANAGER_MENU_MATCHDAYS", "competitions"),
                                array("clubs", "COM_FMMANAGER_MENU_CLUBS", "clubs"),
                                array("stadiums", "COM_FMMANAGER_MENU_STADIUMS", "stadiums"),
                                array("rosters", "COM_FMMANAGER_MENU_ROSTERS", "rosters"),
                                array("persons", "COM_FMMANAGER_MENU_PERSONS", "persons"),
                                array("trainings", "COM_FMMANAGER_MENU_TRAININGS", "trainings"),
                                array("seasons", "COM_FMMANAGER_MENU_SEASONS", "data"),
                                array("statistics", "COM_FMMANAGER_MENU_STATISTICS", "data"),
                                array("categories", "COM_FMMANAGER_MENU_CATEGORIES", "data"),
                                array("positions", "COM_FMMANAGER_MENU_POSITIONS", "data"),
                                array("functions", "COM_FMMANAGER_MENU_FUNCTIONS", "data"),
                                array("diplomas", "COM_FMMANAGER_MENU_DIPLOMAS", "data"),
                                array("grounds", "COM_FMMANAGER_MENU_GROUNDS", "data"),
                                array("tournamenttypes", "COM_FMMANAGER_MENU_TOURNAMENT_TYPES", "data"),
                                array("tactics", "COM_FMMANAGER_MENU_TACTICS", "data")
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
        $view = ($view) ? ($view) : "dashboard";
        $actions = FootManager\Helpers\Access::getActions(FM_MANAGER_COMPONENT);

        foreach (self::$entries AS $entry) {

            if(empty($entry[2]) || $actions->get($entry[2].".admin")) {

                JHtmlSidebar::addEntry(
                    JText::_($entry[1]),
                    'index.php?option=' . FM_MANAGER_COMPONENT.'&view='.$entry[0],
                    ($view == $entry[0])
                );
            }

        }
    }
}