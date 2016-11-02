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
class FmmanagerViewMatch extends \FootManager\View\Ajax
{

    protected function getDescription() {
        return JText::sprintf("COM_FMMANAGER_DESCRIPTION_MATCH", $this->item->team1->small_name, $this->item->team2->small_name, $this->item->matchday->competition->small_name);
    }

    protected function getItemTitle() {
        return $this->item->team1->small_name." - ".$this->item->team2->small_name;
    }

    protected function getPageItemTitle() {
        return $this->item->team1->small_name." - ".$this->item->team2->small_name." - ".$this->item->match->competition->small_name;
    }

    protected function getKeywords() {
        return array_merge(array($this->item->team1->small_name, $this->item->team2->small_name), parent::getKeywords());
    }

    protected function getPathway() {

        $competition = $this->item->matchday->competition;
        $path = array();

        if(!isset($this->menu) || empty($this->menu->query['option']) || empty($this->menu->query['view']) || $this->component != $this->menu->query["option"] || !(($this->menu->query["view"] == "ranking" || $this->menu->query["view"] == "results") && $this->menu->query["id"] == $competition->id))
            $path[] = array('title' => $competition->small_name, 'link' => FmmanagerHelperRoute::competition($competition, "results"));

        $path[] = array('title' => $this->item->matchday->name, 'link' => FmmanagerHelperRoute::matchday($this->item->matchday));

        return $path;

    }

    /**
     * Display the view
     *
     */
    protected function loadScripts()
    {
        FootManager\UI\Loader::chart();
        parent::loadScripts();
    }

    public  function loadAjaxContent() {
    }

}