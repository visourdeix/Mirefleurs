<?php
/**
 * @package      Fmmanager
 * @subpackage   lib_FootManager
 *
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 */

namespace FMEvents\Html;

defined('_JEXEC') or die();

/**
 * Html for Foot Manager classes.
 *
 */
abstract class Location
{
    /**
     * Summary of image
     * @param \FMEvents\Database\Models\Location $model
     * @param mixed $attribs
     * @param mixed $async
     * @return string
     */
    static public function image($model, $attribs = array(), $async = true) {

        if(!isset($attribs["alt"])) {
            $attribs["alt"] = $model->name;
        }

        if(!isset($attribs["title"])) {
            $attribs["title"] = $model->name;
        }

        return \FootManager\Utilities\ImageHelper::render(\FMEvents\Helper::getLocationPhoto($model->photo), $attribs, $async);

    }

}