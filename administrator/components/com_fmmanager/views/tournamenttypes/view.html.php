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

class FmmanagerViewTournamenttypes extends FMManager\View\Backend\DataList {

    protected function getFields() {

        $array = array(
            "has_ranking" =>
array("sortable" => true, "class" => "center hidden-phone"),
            "by_match" => array("sortable" => true, "class" => "center hidden-phone"),
            );

        return array_merge(parent::getFields(), $array);
    }

    protected function formatValue($key, $item, $i) {
        switch ($key)
        {
            case "has_ranking":
            case "by_match":
                if($item->$key)
                    return '<span class="fm-text-140 fm-text-color-green"><span class="fa fa-check"></span></span>';
                break;

        	default:
                return parent::formatValue($key, $item, $i);
        }

    }

}