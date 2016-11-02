<?php
/**
 * @package     mod_fmmanager_nextmatches
 * @subpackage  helper.php
 *
 * @copyright   Copyright (C) 2016 Stéphane ANDRE. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Helper for mod_latest
 *
 * @since  1.5
 */
abstract class ModFmmanagerNextmatchesHelper
{

    public static function getAjax() {

        jimport('FMManager.framework');

        $input  = JFactory::getApplication()->input;
        $params = (array)json_decode(base64_decode($input->get('params', "", 'BASE64')));

        $list = self::getEvents($params);

        return FootManager\Helpers\Layout::render('html.thumbnails.grouped', array("items" => $list, "layout" => "event.thumbnail", "params" => $params, "component" => FM_MANAGER_COMPONENT));
    }

    /**
     * Get a list of articles.
     *
     * @param   array  &$params  The module parameters.
     *
     * @return  mixed  An array of articles, or false on error.
     */
	public static function getData($params)
	{
        return null;
    }

    /**
     * Get a list of articles.
     *
     * @param   array  &$params  The module parameters.
     *
     * @return  mixed  An array of articles, or false on error.
     */
	public static function getEvents($params)
	{
        // Params
        $days = JArrayHelper::getValue($params, "days", 10);
        $teams = JArrayHelper::getValue($params, "teams", "all");
        $states = JArrayHelper::getValue($params, "states", []);
        $group =JArrayHelper::getValue($params, "group_by", "dates");
        $categories = JArrayHelper::getValue($params, "categories", []);

        $matches = FMManager\Database\Models\Match::with(["matchday.competition.tournament.type", "team1", "team2"]);
        $matchdays = FMManager\Database\Models\Matchday::with(["competition.tournament.type"]);

        // Filters;
        $start_date = new JDate();
        $end_date = new JDate(date('Y-m-d G:i:s', strtotime($start_date->format('Y-m-d G:i:s'). ' + '.$days.' days')));

        $matches = $matches->byMatch(1)->betweenDates($start_date, $end_date);
        $matchdays = $matchdays->byMatch(0)->betweenDates($start_date, $end_date);

        if($categories) {
            $matches = $matches->whereIn("fm_tournaments.category_id", $categories);
            $matchdays = $matchdays->whereIn("fm_tournaments.category_id", $categories);
        }
        if($states) {
            $matches = $matches->whereIn("fm_matches.state", $states);
            $matchdays = $matchdays->whereIn("fm_matchdays.state", $states);
        }

        $matches = $matches->get();
        $matchdays = $matchdays->get();

        $items = $matches->merge($matchdays);

        if($teams == 'my') $items = $items->filter(function ($obj) { return $obj->isMyEvent();} );

        switch ($group)
        {
        	case "competitions":
                $items = $items->sortMulti(["competition.tournament.category.ordering", "competition.tournament.type.ordering", "competition.tournament.ordering", "datetime"]);
                $items = $items->groupBy(function($obj) { return $obj->competition->medium_name;});
                break;

            default:
                $items = $items->sortMulti(["datetime", "competition.tournament.category.ordering", "competition.tournament.type.ordering", "competition.tournament.ordering"]);
                $items = $items->groupBy(function($obj) { return $obj->datetime->format("l d F");});

        }

		return $items;
	}

    /**
     * Get allowed Categories.
     */
    public static function getAllowedCategories() {
        return \FMManager\Database\Models\Category::isAllowed(["results", "call_up"])->unique("id")->getColumn("id")->toArray();
    }
}