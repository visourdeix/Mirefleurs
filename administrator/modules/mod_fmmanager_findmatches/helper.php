<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  mod_latest
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Helper for mod_latest
 *
 * @since  1.5
 */
abstract class ModFmmanagerFindmatchesHelper
{

    public static function getAjax() {

        jimport('FMManager.framework');

        $input  = JFactory::getApplication()->input;
        $params = (array)json_decode(base64_decode($input->get('params', "", 'BASE64')));

        $list = self::getData($params);

        if(!empty($list))
            return FootManager\Helpers\Layout::render('html.thumbnails.grouped', array("items" => $list, "params" => $params,  "layout" => "event.thumbnail", "component" => FM_MANAGER_COMPONENT));
        else
            return FootManager\Helpers\Layout::render('system.message', array("message" => JText::_("FMLIB_ERROR_NO_FILTER"), "color" => "error"));

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
        // Params
        $teams = JArrayHelper::getValue($params, "teams");
        $states = JArrayHelper::getValue($params, "states");
        $group =JArrayHelper::getValue($params, "group_by", "dates");
        $categories = JArrayHelper::getValue($params, "categories");
        $competition = JArrayHelper::getValue($params, "competition");
        $start_date = JArrayHelper::getValue($params, "start_date");
        $end_date = JArrayHelper::getValue($params, "end_date");

        if($teams || $states || $categories || $competition || $start_date || $end_date) {

            $matches = FMManager\Database\Models\Match::with(["matchday.competition.tournament.type", "team1", "team2"])->joinTournamentType()->where("fm_tournament_types.by_match", "=", 1);
            $matchdays = FMManager\Database\Models\Matchday::with(["competition.tournament.type"])->joinTournamentType()->where("fm_tournament_types.by_match", "=", 0);

            // Filters;
            if($start_date || $end_date) {
                $end_date = $end_date ? new JDate($end_date) : new JDate();
                $start_date = $start_date ? new JDate($start_date) : new JDate();

                $matches = $matches->betweenDates($start_date, $end_date);
                $matchdays = $matchdays->betweenDates($start_date, $end_date);
            }

            if($categories) {
                $matches = $matches->whereIn("fm_tournaments.category_id", $categories);
                $matchdays = $matchdays->whereIn("fm_tournaments.category_id", $categories);
            }
            if($states) {
                $matches = $matches->whereIn("fm_matches.state", $states);
                $matchdays = $matchdays->whereIn("fm_matchdays.state", $states);
            }
            if($competition) {
                $matches = $matches->where("fm_matchdays.competition_id", "=", $competition);
                $matchdays = $matchdays->where("fm_matchdays.competition_id", "=", $competition);
            }

            if($teams) {
                $matches = $matches->where(function($query) use($teams) {
                    $query->whereIn("team1_id", $teams)
                        ->orWhereIn("team2_id", $teams);
                });
                $matchdays = $matchdays->whereHas("competition", function($query) use($teams) {
                    $query->whereHas("competitionTeams", function($query) use($teams) {
                        $query->whereIn("team_id", $teams);
                    });
                });
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

		return null;
	}

}