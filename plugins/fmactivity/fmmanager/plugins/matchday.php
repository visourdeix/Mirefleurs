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
class plgFmactivityFmmanagerMatchday
{

    const SUMMARY_ADDED = "summary_added";
    const SCORE_ADDED = "score_added";

    private static function getItem($table) {
        return FMManager\Database\Models\Matchday::withoutGlobalScopes()->where("id", "=", $table->id)->first();
    }

    /**
     * Summary of setData
     * @param mixed $data
     * @param mixed $table
     * @param mixed $eventType
     */
    public static function setData(&$data, $table, $eventType) {

        $item = self::getItem($table);

        $data->description = $item->competition->tournament->name;
        $data->category = $item->category->label;

        $data->metadata->set("color", $item->category->color);
        $data->metadata->set("state", $item->state);
        $data->metadata->set("matches", count($item->matches->filter(function($obj) { return $obj->played == FMManager\Constants::PLAYED; })));
        $data->metadata->set("summary", ($item->summary != ""));

        $data->state = 1;
    }

    /**
     * Summary of isFeatured
     * @param mixed $table
     * @param mixed $eventType
     * @return mixed
     */
    public static function isFeatured($table, $eventType) {
        $item = self::getItem($table);
        return ($eventType == self::SCORE_ADDED || $eventType == self::SUMMARY_ADDED) && !$item->competition->tournament->type->by_match && $item->isMyEvent() && $item->played && count($item->matches) > 0;
    }

    public static function getEvent($currentItem, $table, $eventType) {

        if((empty($currentItem) || empty($currentItem->metadata["summary"])) && $table->summary != '') {
            return self::SUMMARY_ADDED;
        }

        $item = self::getItem($table);
        $matches = $item->matches->filter(function($obj) { return $obj->played == FMManager\Constants::PLAYED; });
        if((empty($currentItem) || empty($currentItem->metadata["matches"])) && $currentItem->metadata["matches"] != count($matches)) {
            return self::SCORE_ADDED;
        }

        return $eventType;
    }
}