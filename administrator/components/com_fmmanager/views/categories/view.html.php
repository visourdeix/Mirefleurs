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

class FmmanagerViewCategories extends FMManager\View\Backend\DataList {

    protected function getFields() {
        $array = array(
            "year" => array("sortable" => true, "class" => "center"),
            "color" => array("class" => "center")
            );

        return array_merge(parent::getFields(), $array);
    }

    protected function formatValue($key, $item, $i) {
        switch ($key)
        {
            case "color" :
                return FootManager\Helpers\Layout::render("html.color", array("color" => $item->color, "params" => array("show_tooltip" => true)));

            case "year" :
                return $item->year;

        	default:
                return parent::formatValue($key, $item, $i);
        }

    }

}