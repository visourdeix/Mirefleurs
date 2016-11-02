<?php
/**FMClub
 * @package      pkg_foomanager
 * @subpackage   lib_FootManager
 *
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 */

namespace FMGallery;

defined('_JEXEC') or die();

/**
 * Get functions related to a person.
 *
 */
abstract class Helper {

    public static function getImageFromExt($file, $size) {
        $ext = strtolower(\JFile::getExt($file));
        $image = FM_GALLERY_PATH_IMAGES_REL.DS."default".DS.$ext."-".$size.".png";
        if(!\JFile::exists(JPATH_ROOT.DS.$image))
            $image = FM_GALLERY_PATH_IMAGES_REL.DS."default".DS."default-".$size.".png";
        return self::getFullPath($image);
    }

    /**
     * Gets the image full path.
     * @return mixed
     */
    public static function getImage($photo, $size) {
        $field = "thumb_".$size;
        $rel_path = ($photo) ? $photo->$field : "";
        return self::getFullPath($rel_path, "thumb_empty_".$size);
    }

    /**
     * Gets the image full path.
     * @return mixed
     */
    public static function getFullPath($rel_path, $default = "") {
        return \FootManager\Utilities\FileHelper::getFullPath($rel_path, $default, FM_GALLERY_COMPONENT);
    }

}

?>