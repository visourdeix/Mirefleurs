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

class FmmanagerViewSeasons extends FMManager\View\Backend\DataList {

    protected function getFields() {

        $array = array(
            "managers" => array("class" => "center hidden-phone"),
            );

        return array_merge(parent::getFields(), $array);
    }

    protected function formatValue($key, $item, $i) {
        switch ($key)
        {

            case "managers":
                $count = count($item->managers);
                $badge = ($count > 0) ? "info" : "warning";
                return '<span class="badge badge-'.$badge.'">'.$count.'</span>';

        	default:
                return parent::formatValue($key, $item, $i);
        }

    }
}