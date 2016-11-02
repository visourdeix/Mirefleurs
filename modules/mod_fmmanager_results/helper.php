<?php
/**
 * @package     Fmmanager
 * @subpackage  mod_fmmanager_ranking
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use \FMManager\Database\Models;

/**
 * Helper for this module.
 *
 * @since  1.5
 */
abstract class ModFmmanagerResultsHelper
{

    public static function getAjax() {
        jimport('FMManager.library');

        $input  = JFactory::getApplication()->input;
        $params = (array)json_decode(base64_decode($input->get('params', "", 'BASE64')));

        $data = self::getEvent($params);

        if($data)
        {
            ob_start();
            include JModuleHelper::getLayoutPath('mod_fmmanager_results', 'content');
            $result = ob_get_contents();
            ob_end_clean();
            return $result;
        }
        else
            return FootManager\Helpers\Layout::render("messages.nodata");
    }

    /**
     * Get the data from module.
     *
     * @param   array  &$params  The module parameters.
     *
     * @return  mixed  An array of articles, or false on error.
     */
	public static function getData(&$params)
	{
        $ajax_loading = JArrayHelper::getValue($params, "ajax_loading", false);
        if(!$ajax_loading) {
            return self::getEvent($params);
        } else  {
            return new stdClass();
        }
	}

    /**
     * Get the ranking.
     *
     * @param   array  &$params  The module parameters.
     *
     * @return  mixed  An array of articles, or false on error.
     */
	private static function getEvent($params)
	{
        $ids  = JArrayHelper::getValue($params, "rosters", array());
        $date  = JArrayHelper::getValue($params, "date", date('Y-m-d G:i:s'));

        if($ids && $date) {
            $direction  = JArrayHelper::getValue($params, "direction", 1);
            $show_stats  = JArrayHelper::getValue($params, "show_stats", false);

            // Filters;
            $start_date = ($direction == 1) ? new JDate($date) : null;
            $end_date = ($direction == -1) ? new JDate($date) : null;
            $dir = ($direction == -1) ? "desc" : "asc";

            $matches = FMManager\Database\Models\Match::withoutGlobalScopes()
                ->byMatch(1)
                ->betweenDates($start_date, $end_date)
                ->whereIn("fm_matches.state", [FMManager\Constants::NOT_PLAYED, FMManager\Constants::PLAYED])
                ->where(function($query) use($ids) {
                    $query->whereHas("team1", function($query) use($ids) {
                            $query->whereHas("rosters", function($query) use($ids) {
                                $query->whereIn("id", $ids);
                            });
                        });
                    $query->orWhereHas("team2", function($query) use($ids) {
                            $query->whereHas("rosters", function($query) use($ids) {
                                $query->whereIn("id", $ids);
                            });
                        });
                })
                ->orderBy("date", $dir)
                ->orderBy("time", $dir)
                ->take(1)
                ->get();

            $matchdays = FMManager\Database\Models\Matchday::withoutGlobalScopes()
                ->byMatch(0)
                ->betweenDates($start_date, $end_date)
                ->whereIn("fm_matchdays.state", [FMManager\Constants::NOT_PLAYED, FMManager\Constants::PLAYED])
                ->whereHas("competition", function($query) use($ids) {
                    $query->whereHas("competitionTeams", function($query) use($ids) {
                        $query->whereHas("team", function($query) use($ids) {
                            $query->whereHas("rosters", function($query) use($ids) {
                                $query->whereIn("id", $ids);
                            });
                        });
                    });
                })
                ->orderBy("date", $dir)
                ->orderBy("time", $dir)
                ->take(1)
                ->get();

            // Events
            $items = $matches->merge($matchdays);

            $items = $items->sortMulti(["datetime"], [$direction]);

            if(count($items) > 0) {
                $result = $items->first();

                if($show_stats && $result->type == "match") $result->load(["goals.striker", "playersStatistics.statistic", "playersStatistics.person"]);
                return $result;
            }
        }

        return null;
	}
}