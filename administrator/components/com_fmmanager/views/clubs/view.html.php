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

class FmmanagerViewClubs extends FootManager\View\Items
{
    protected function canAdd() {
        return $this->actions->get("clubs.manage");
    }

    protected function canEdit($id = null, $i = 0) {
        return $this->actions->get("clubs.manage");
    }

    protected function canDelete() {
        return $this->actions->get("clubs.manage");
    }

    protected function getFields() {
        return array(
            "logo" => array("width" => "50px", "class" => "", "header" => ""),
            "name" => array("linkable" => true, "sortable" => true, "class" => "has-context"),
            "color" => array("class" => "center hidden-phone"),
            "city" => array("sortable" => true, "class" => "hidden-phone")
            );
    }

    protected function formatValue($key, $item, $i) {
        switch ($key)
        {
            case "logo":
                return FootManager\Utilities\ImageHelper::render(\FMManager\Helper::getClubLogo($item->logo), array("alt" => $item->name));
                break;

            case "color" :
                return FootManager\Helpers\Layout::render("html.color", array("color" => $item->home_color, "params" => array("show_tooltip" => true)));

        	default:
                return parent::formatValue($key, $item, $i);
        }

    }

    protected function getClassRow($item, $i) {
        return $item->id == \FMManager\Helper::getMyClubId() ? "fm-my-club-row" : "";
    }
}