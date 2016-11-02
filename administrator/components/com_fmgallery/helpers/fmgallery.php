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

jimport('FMGallery.library');
class FmgalleryHelper
{
    private static $entries = array(
                                array("photos", "COM_FMGALLERY_MENU_PHOTOS", ""),
                                array("videos", "COM_FMGALLERY_MENU_VIDEOS", ""),
                                array("files", "COM_FMGALLERY_MENU_FILES", "")
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
        jimport("FMGallery.framework");
        $component     = JFactory::getApplication()->input->get('option');

        if($component == 'com_categories')
            $view = 'categories';
        else {
            $view     = JFactory::getApplication()->input->get('view');
            $view = ($view) ? ($view) : "photos";
        }
        $actions = FootManager\Helpers\Access::getActions(FM_GALLERY_COMPONENT);

        foreach (self::$entries AS $entry) {

            if(empty($entry[2]) || $actions->get($entry[2].".admin")) {

                JHtmlSidebar::addEntry(
                    JText::_($entry[1]),
                    'index.php?option=' . FM_GALLERY_COMPONENT.'&view='.$entry[0],
                    ($view == $entry[0])
                );
            }

        }

        if($actions->get("core.manage")) {
            JHtmlSidebar::addEntry(
                        JText::_("COM_FMGALLERY_MENU_CATEGORIES"),
                        'index.php?option=com_categories&extension='.FM_GALLERY_COMPONENT,
                        ($view == 'categories')
                    );
        }
    }
}