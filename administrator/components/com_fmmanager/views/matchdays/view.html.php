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

class FmmanagerViewMatchdays extends FootManager\View\Items
{
    protected $competition;
    protected $addMultipleForm;

    protected function init() {
        if(parent::init()) {
            $this->competition = $this->get('Competition');
            $this->addMultipleForm = $this->get('AddMultipleForm');
            return true;
        }
        return false;
    }

    protected function canAdd() {
        return $this->canEdit();
    }

    protected function canEdit($id = null, $i = 0) {
        return isset($this->competition) ? $this->user->authorise( "results.edit", FM_MANAGER_COMPONENT.".category." . $this->competition->tournament->category_id ) : false;
    }

    protected function canDelete() {
        return $this->canEdit();
    }

    /**
     * Add the "Add" Button.
     */
    protected function addAddButton() {
        parent::addAddButton();

        \FootManager\UI\Html\Toolbar::modal("addMultipleModal", "fa fa-plus", "COM_FMMANAGER_ADD_MULTIPLE", "btn-success nowrap");
    }

    protected function getFields() {
        return array(
            "name" => array("linkable" => true, "sortable" => true, "class" => "has-context"),
            "date" => array("sortable" => true, "class" => "center"),
            "matches" => array("class" => "center hidden-phone"),
            "matches_played" => array("class" => "center hidden-phone")
            );
    }

    protected function formatValue($key, $item, $i) {
        switch ($key)
        {
            case "date":
                return '<span class="hidden-phone">' . $this->escape($item->date->format('l d F Y')) . '</span>'.
                '<span class="visible-phone">' . $this->escape($item->date->format('d-m-Y')) . '</span>';

            case "matches":
                $count = count($item->matches);
                $badge = ($count > 0) ? "default" : "important";
                return '<span class="badge badge-'.$badge.'">'.$count.'</span>';

            case "matches_played":
                $count = count($item->matches);
                $played = $item->matches->filter(function($obj) { return $obj->played; });
                $countPlayed = count($played);
                $badge = "info";
                if($countPlayed < $count && \FootManager\Utilities\DateHelper::isBeforeToday($item->date))
                    $badge = "warning";
                elseif($countPlayed == 0 && $count == 0)
                    $badge = "important";
                elseif($countPlayed == $count)
                    $badge = "success";
                else
                    $badge = "default";
                return '<span class="badge badge-'.$badge.'">'.$countPlayed.'</span>';

        	default:
                return parent::formatValue($key, $item, $i);
        }

    }
}