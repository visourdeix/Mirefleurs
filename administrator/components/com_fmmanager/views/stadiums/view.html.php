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

class FmmanagerViewStadiums extends FootManager\View\Items
{
    protected function canAdd() {
        return $this->actions->get("stadiums.manage");
    }

    protected function canEdit($id = null, $i = 0) {
        return $this->actions->get("stadiums.manage");
    }

    protected function canDelete() {
        return $this->actions->get("stadiums.manage");
    }

    protected function getFields() {
        return array(
            "name" => array("linkable" => true, "sortable" => true, "class" => "has-context"),
             "ground" => array("width" => "200px", "class" => "center hidden-phone", "sort" => "fm_grounds.ordering", "sortable" => true),
            "city" => array("sortable" => true)
            );
    }

    protected function formatValue($key, $item, $i) {
        switch ($key)
        {

            case "ground" :
                return FootManager\Utilities\ImageHelper::render(\FMManager\Helper::getGroundImage($item->ground->image), array("style" => "height:25px;"));

        	default:
                return parent::formatValue($key, $item, $i);
        }

    }

}