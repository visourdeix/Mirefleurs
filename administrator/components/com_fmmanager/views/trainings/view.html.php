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

class FmmanagerViewTrainings extends FootManager\View\Items
{
    protected function init() {
        if(parent::init()) {
            $this->addMultipleForm = $this->get('AddMultipleForm');
            return true;
        }
        return false;
    }

    protected function canCopy() {
        return true;
    }

    protected function canAdd() {
        return $this->
actions->get("trainings.manage");
    }

    protected function canEdit($id = null, $i = 0) {
        return $this->actions->get("trainings.manage");
    }

    protected function canDelete() {
        return $this->actions->get("trainings.manage");
    }

    protected function getFields() {
        return array(
            "state" => array("width" => "1%", "sortable" => true, "class" => "center"),
            "rosters" => array("linkable" => true, "class" => "has-context"),
             "date" => array("sortable" => true,"class" => "center"),
             "stadium" => array("sortable" => true, "sort" => "fm_stadiums.name")
            );
    }

    protected function formatValue($key, $item, $i) {
        switch ($key)
        {

            case "state" :
                if($this->canEdit()) {
                    if($item->state == FootManager\Constants::ACTIVE)
                        return \FootManager\UI\Html\Button::link("javascript:void(0)", "", "fa fa-check", array("onclick" => 'listItemTask(\'cb' . $i . '\', \'trainings.cancelEvent\')', "class" => "btn-success btn-mini hasTooltip", "title" => JText::_("FMLIB_CANCEL")));
                    else
                        return \FootManager\UI\Html\Button::link("javascript:void(0)", "", "fa fa-remove", array("onclick" => 'listItemTask(\'cb' . $i . '\', \'trainings.active\')', "class" => "btn-danger btn-mini hasTooltip", "title" => JText::_("FMLIB_ACTIVE")));
                } else {
                    if($item->state == FootManager\Constants::ACTIVE)
                        return "<span class='fa fa-check fm-text-color-green'></span>";
                    else
                        return "<span class='fa fa-remove fm-text-color-red'></span>";
                }

            case "rosters":
                return $item->rosters->implode("small_name", ", ");

            case "date" :
                return '<b>'.$item->datetime->format('l d F Y').'</b><br />'.$item->datetime->format('G:i').' - '.$item->end_date->format('G:i');

            case "stadium":
                return $item->stadium->name_and_city;

        	default:
                return parent::formatValue($key, $item, $i);
        }

    }

    protected function addToolbarButtons() {
        parent::addToolbarButtons();

        if($this->canEdit()) FootManager\UI\Html\Toolbar::taskbutton('trainings.active', "FMLIB_ACTIVE", "fa fa-check");
        if($this->canEdit()) FootManager\UI\Html\Toolbar::taskbutton('trainings.cancelEvent', "FMLIB_CANCEL", "icon-delete");
    }

    /**
     * Add the "Add" Button.
     */
    protected function addAddButton() {
        parent::addAddButton();

        FootManager\UI\Html\Toolbar::modal("addMultipleModal", "fa fa-plus", "COM_FMMANAGER_ADD_MULTIPLE", "btn-success nowrap");
    }

}