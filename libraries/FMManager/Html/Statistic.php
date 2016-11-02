<?php
/**
 * @package      Fmmanager
 * @subpackage   lib_FootManager
 *
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 */

namespace FMManager\Html;

defined('_JEXEC') or die();

/**
 * Html for Foot Manager classes.
 *
 */
abstract class Statistic
{

    /**
     * Summary of image
     * @param \FMManager\Database\Models\Team $model
     * @param mixed $attribs
     * @param mixed $async
     * @return string
     */
    static public function image($model, $attribs = array(), $async = true) {

        if($model) {
            if(!isset($attribs["alt"])) {
                $attribs["alt"] = $model->label;
            }

            if(!isset($attribs["title"])) {
                $attribs["title"] = $model->label;
            }

            return \FootManager\Utilities\ImageHelper::render(\FMManager\Helper::getStatisticImage($model->image), $attribs, $async);
        }

        return "";

    }

}