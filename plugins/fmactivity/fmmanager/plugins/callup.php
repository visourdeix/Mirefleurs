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
class plgFmactivityFmmanagerCallup
{

    private static function getItem($table) {
        return FMManager\Database\Models\Callup::withoutGlobalScopes()->where("id", "=", $table->id)->first();
    }

    /**
     * Summary of setData
     * @param mixed $data
     * @param mixed $table
     * @param mixed $eventType
     */
    public static function setData(&$data, $table, $eventType) {

        $app = JFactory::getApplication('administrator');
        $type = $app->input->get("type", null, 'base64');
        $type = base64_decode($type);
        $event_id = $app->input->get("event_id", null, 'int');

        if($type == "Match"){
            $item = FMManager\Database\Models\Match::withoutGlobalScopes()->where("id", "=", $event_id)->first();

            $data->title = $item->team1->small_name." - ".$item->team2->small_name;
            $data->description = $item->competition->tournament->name.' - '.$item->matchday->name;
            $data->category = $item->category->label;

            $data->metadata->set("color", $item->category->color);
            $data->metadata->set("id", $item->id);
            $data->metadata->set("type", $item->type);
        }

        if($type == "Matchday"){
            $item = FMManager\Database\Models\Matchday::withoutGlobalScopes()->where("id", "=", $event_id)->first();

            $data->title = $item->name;
            $data->description = $item->competition->tournament->name;
            $data->category = $item->category->label;

            $data->metadata->set("color", $item->category->color);
            $data->metadata->set("id", $item->id);
            $data->metadata->set("type", $item->type);
        }
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
}