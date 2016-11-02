<?php
/**
 * @package      Fmmanager
 * @subpackage   lib_FootManager
 *
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 */

namespace FMGallery\Html;

defined('_JEXEC') or die();

/**
 * Html for Foot Manager classes.
 *
 */
abstract class Photo
{

    /**
     * Summary of image
     * @param \FMGallery\Database\Models\Photo $model
     * @param mixed $attribs
     * @param mixed $async
     * @return string
     */
    static public function image($model, $size = "medium", $attribs = array(), $async = true) {

        if(!isset($attribs["alt"])) {
            $attribs["alt"] = $model->title;
        }

        if(!isset($attribs["title"])) {
            $attribs["title"] = $model->title;
        }

        return \FootManager\Utilities\ImageHelper::render(\FMGallery\Helper::getImage($model, $size), $attribs, $async);

    }

}