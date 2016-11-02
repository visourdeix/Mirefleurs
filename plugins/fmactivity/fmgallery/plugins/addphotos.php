<?php
/**
 * @package      pkg_useractivity
 * @subpackage   plg_useractivity_content
 *
 * @author       Tobias Kuhn (eaxs)
 * @copyright    Copyright (C) 2013 Tobias Kuhn. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 */

defined('_JEXEC') or die();

jimport("FMActivity.library");
jimport("FMManager.library");

/**
 * Content User Activity plugin
 *
 */
class plgFmactivityFmgalleryAddphotos
{

    const PHOTOS_ADDED = "photos_added";

    private static function getItem($table) {
        return FMGallery\Database\Models\Category::withoutGlobalScopes()->where("id", "=", $table->id)->first();
    }

    /**
     * Summary of setData
     * @param mixed $data
     * @param mixed $table
     * @param mixed $eventType
     */
    public static function setData(&$data, $table, $eventType) {
        $cat = self::getItem($table);
        $data->category = $cat->parent_category->title;
    }

    /**
     * Summary of isFeatured
     * @param mixed $table
     * @param mixed $eventType
     * @return mixed
     */
    public static function isFeatured($table, $eventType) {
        return ($eventType == FMActivity\Constants::SAVE_NEW || FMActivity\Constants::SAVE_UPDATE);
    }

    public static function getEvent($currentItem, $table, $eventType) {
        return self::PHOTOS_ADDED;
    }
}