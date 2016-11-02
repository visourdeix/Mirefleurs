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
class plgFmactivityFmmanagerMatch
{

    const SUMMARY_ADDED = "summary_added";
    const SCORE_ADDED = "score_added";

    private static function getItem($table) {
        return FMManager\Database\Models\Match::withoutGlobalScopes()->where("id", "=", $table->id)->first();
    }

    /**
     * Summary of setData
     * @param mixed $data
     * @param mixed $table
     * @param mixed $eventType
     */
    public static function setData(&$data, $table, $eventType) {

        $item = self::getItem($table);

        $myteam = ($item->team2->club_id == \FMManager\Helper::getMyClubId()) ? $item->team2 : $item->team1;
        $color = ($item->isWinner($myteam)) ? "green" : (($item->isLooser($myteam)) ? "red" : "gray");

        $data->title = $item->team1->small_name." - ".$item->team2->small_name;
        $data->description = $item->competition->tournament->name.' - '.$item->matchday->name;
        $data->category = $item->category->label;

        $data->metadata->set("color", $item->category->color);
        $data->metadata->set("header_color", $color);
        $data->metadata->set("score", $item->score);
        $data->metadata->set("state", $item->state);
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
        return ($eventType == self::SCORE_ADDED || $eventType == self::SUMMARY_ADDED) && $item->competition->tournament->type->by_match && $item->isMyEvent() && $item->played;
    }

    public static function getEvent($currentItem, $table, $eventType) {

        if((empty($currentItem) || empty($currentItem->metadata["summary"])) && $table->summary != '') {
            return self::SUMMARY_ADDED;
        }

        if((empty($currentItem) || empty($currentItem->metadata["state"]) || $currentItem->metadata["state"] != FMManager\Constants::PLAYED) && $table->state == FMManager\Constants::PLAYED) {
            return self::SCORE_ADDED;
        }

        return $eventType;
    }
}