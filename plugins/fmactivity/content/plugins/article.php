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

/**
 * Content User Activity plugin
 *
 */
class plgFmactivityContentArticle
{

    /**
     * Summary of setData
     * @param mixed $data
     * @param mixed $table
     * @param mixed $eventType
     */
    public static function setData(&$data, $table, $eventType) {
        $cat = \FootManager\Database\Models\Category::find($table->catid);
        $data->category = $cat->title;
        $data->metadata->set("catid", $table->catid);
    }

    /**
     * Summary of setData
     * @param mixed $data
     * @param mixed $table
     * @param mixed $eventType
     */
    public static function setActivity(&$data, $table, $eventType) {
        $data->date = $table->publish_up;
    }

    /**
     * Summary of isFeatured
     * @param mixed $table
     * @param mixed $eventType
     * @return mixed
     */
    public static function isFeatured($table, $eventType) {
        return $eventType == FMActivity\Constants::SAVE_NEW;
    }
}