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

class FmmanagerViewRosters extends FootManager\View\Items
{
    protected function canAdd() {
        return $this->actions->get("rosters.manage");
    }

    protected function canEdit($id = null, $i = 0) {
        if(isset($this->items[$i])) {
            $category_id = $this->items[$i]->team->category_id;
            return $this->actions->get("rosters.manage") && $this->user->authorise( "roster.edit", FM_MANAGER_COMPONENT.".category." . $category_id );
        }
        return false;
    }

    protected function canDelete() {
        return $this->actions->get("rosters.manage");
    }

    protected function getFields() {
        return array(
            "photo" => array("width" => "70px", "class" => "", "header" => ""),
            "name" => array("linkable" => true, "sortable" => true, "class" => "has-context", "sort" => "fm_seasons.ordering"),
            "players" => array("class" => "center hidden-phone"),
            "staff" => array("class" => "center hidden-phone")
            );
    }

    protected function formatValue($key, $item, $i) {
        switch ($key)
        {
            case "photo":
                return FMManager\Html\Roster::image($item);

            case "players":
                $count = count($item->players);
                $badge = ($count) ? "info" : "warning";
                return '<span class="badge badge-'.$badge.'">'.$count.'</span>';

            case "staff":
                $count = count($item->staff);
                $badge = ($count) ? "info" : "warning";
                return '<span class="badge badge-'.$badge.'">'.$count.'</span>';

        	default:
                return parent::formatValue($key, $item, $i);
        }

    }

}