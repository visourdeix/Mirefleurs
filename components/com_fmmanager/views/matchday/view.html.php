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
class FmmanagerViewMatchday extends FootManager\View\Ajax
{

    protected function getDescription() {
        return JText::sprintf("COM_FMMANAGER_DESCRIPTION_MATCHDAY", $this->item->matchday->name, $this->item->matchday->competition->small_name);
    }

    protected function getItemTitle() {
        return $this->item->matchday->name;
    }

    protected function getItemPageTitle() {
        return $this->item->matchday->name." - ".$this->item->matchday->competition->small_name;
    }

    protected function getPathway() {

        $competition = $this->item->matchday->competition_id;
        $path = array();

        if(!isset($this->menu) || empty($this->menu->query['option']) || empty($this->menu->query['view']) || $this->component != $this->menu->query["option"] || !(($this->menu->query["view"] == "ranking" || $this->menu->query["view"] == "results") && $this->menu->query["id"] == $competition))
            $path[] = array('title' => $this->item->matchday->competition->small_name, 'link' => FmmanagerHelperRoute::competition($competition, "results"));

        return $path;

    }

    public  function loadAjaxContent() {
    }

}