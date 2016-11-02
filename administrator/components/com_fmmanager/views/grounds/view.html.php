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

class FmmanagerViewGrounds extends FMManager\View\Backend\DataList {

    protected function getFields() {
        $array = array(
            "image" =>
array("class" => "center hidden-phone")
            );

        return array_merge(parent::getFields(), $array);
    }

    protected function formatValue($key, $item, $i) {
        switch ($key)
        {
            case "image" :
                return FootManager\Utilities\ImageHelper::render(\FMManager\Helper::getGroundImage($item->image), array("style" => "height:25px;"));

        	default:
                return parent::formatValue($key, $item, $i);
        }

    }

}