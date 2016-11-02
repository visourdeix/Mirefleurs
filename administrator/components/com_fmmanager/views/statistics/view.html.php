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

class FmmanagerViewStatistics extends FMManager\View\Backend\DataList {

    protected function getFields() {

        $array_before = array(
            "image" =>
array("width" => "30px","class" => "center", "header" => "")
            );

        $array = array(
            "abbreviation" => array("class" => "center fm-hidden-large-tablet-max"),
            "by_player" => array("sortable" => true, "class" => "center hidden-phone"),
            "by_staff" => array("sortable" => true, "class" => "center hidden-phone"),
            "by_team" => array("sortable" => true, "class" => "center hidden-phone"),
            "by_match" => array("sortable" => true, "class" => "center hidden-phone"),
            "by_matchday" => array("sortable" => true, "class" => "center hidden-phone"),
            "unit" => array("sortable" => true, "class" => "center fm-hidden-large-tablet-max"),
            "calculation" => array("sortable" => true, "class" => "center fm-hidden-large-tablet-max")
            );

        return array_merge($array_before, parent::getFields(), $array);
    }

    protected function formatValue($key, $item, $i) {
        switch ($key)
        {
            case "image" :
                return FMManager\Html\Statistic::image($item, array("style" => "min-width:20px!important;max-width:20px!important;"));

            case "by_player":
            case "by_staff":
            case "by_team":
            case "by_match":
            case "by_matchday":
                if($item->$key)
                    return '<span class="fm-text-140 fm-text-color-green"><span class="fa fa-check"></span></span>';
                break;

            case "unit":
                if($item->unit)
				    return JText::_("FM_UNIT_".$item->unit."_ICON");
                break;

            case "calculation":
                if($item->calculation)
				    return JText::_("FM_CALCULATION_".$item->calculation);
                break;

        	default:
                return parent::formatValue($key, $item, $i);
        }

    }

}