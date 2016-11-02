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

class FmmanagerViewCompetitions extends FootManager\View\Items
{
    protected function canAdd() {
        return $this->actions->get("competitions.manage");
    }

    protected function canEdit($id = null, $i = 0) {
        return $this->actions->get("competitions.manage");
    }

    protected function canDelete() {
        return $this->actions->get("competitions.manage");
    }

    protected function getFields() {
        return array(
            "logo" => array("width" => "50px", "class" => "", "header" => ""),
            "name" => array("linkable" => true, "sortable" => true, "class" => "has-context", "sort" => "fm_seasons.ordering"),
            "matchdays" => array("class" => "center hidden-phone"),
            "teams" => array("class" => "center hidden-phone")
            );
    }

    protected function formatValue($key, $item, $i) {
        switch ($key)
        {
            case "logo":
                return FMManager\Html\Competition::image($item);

            case "matchdays":
                $count = count($item->matchdays);
                $badge = ($count > 0) ? "info" : "warning";
                return '<a href="'.JRoute::_('index.php?option='.$this->component.'&view=matchdays&competition='.(int) $item->id).'" class="badge badge-'.$badge.'">'.$count.'</a>';

            case "teams":
                $count = count($item->competitionTeams);
                $badge = ($count > 0) ? "info" : "warning";
                return '<span class="badge badge-'.$badge.'">'.$count.'</span>';

        	default:
                return parent::formatValue($key, $item, $i);
        }

    }

}