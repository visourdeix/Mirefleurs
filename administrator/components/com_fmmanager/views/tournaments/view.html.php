<?php
/**
 * @package      Fmmanager
 * @subpackage   com_fmmanager
 *
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 */

defined('_JEXEC') or die();

class FmmanagerViewTournaments extends FootManager\View\Items
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
            "name" => array("linkable" => true, "sortable" => true, "class" => "has-context"),
            "category" => array("sort" => "fm_categories.ordering", "sortable" => true),
            "type" => array("class" => "hidden-phone", "sort" => "fm_tournament_types.ordering", "sortable" => true),
            "competitions" => array("class" => "center hidden-phone")
            );
    }

    protected function formatValue($key, $item, $i) {
        switch ($key)
        {
            case "logo":
                return FootManager\Utilities\ImageHelper::render(\FMManager\Helper::getTournamentLogo($item->logo), array("alt" => $item->name));

            case "category":
                return $item->category->label;

            case "type":
                return $item->type->label;

            case "competitions":
                $count = count($item->competitions);
                $badge = ($count > 0) ? "info" : "warning";
                return '<span class="badge badge-'.$badge.'">'.$count.'</span>';

        	default:
                return parent::formatValue($key, $item, $i);
        }

    }

}