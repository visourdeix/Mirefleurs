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

class FmmanagerViewFunctions extends FMManager\View\Backend\DataList {

    protected function getFields() {
        $array = array(
            "extra" => array("sortable" => true, "class" => "center", "header" => "COM_FMMANAGER_FIELD_TYPE")
            );

        return array_merge(parent::getFields(), $array);
    }

    protected function formatValue($key, $item, $i) {
        switch ($key)
        {
            case "extra" :
                if(!$item->extra)
                    return '<i class="fa fa-futbol-o"></a>';
                break;

        	default:
                return parent::formatValue($key, $item, $i);
        }

    }

}