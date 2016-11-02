<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
jimport("FMManager.library");

/**
 * Content Component Route Helper.
 *
 * @since  1.5
 */
abstract class FmmanagerHelperRoute
{
	/**
     * Route for person view.
     * @param mixed $item
     * @return string
     */
	public static function person($item)
	{
		return self::route('person', $item);
	}

    /**
     * Route for match view.
     * @param mixed $item
     * @return string
     */
	public static function match($item)
	{
        $item = ($item instanceof Illuminate\Database\Eloquent\Model) ? $item : FMManager\Database\Models\Match::withoutGlobalScopes()->find($item);

        $needles = array();
        if($item) {
            $rosters = \FMManager\Database\Models\Roster::withoutGlobalScopes()->where(function($query) use($item) {
                $query->where("team_id", "=", $item->team1_id)->orWhere("team_id", "=", $item->team2_id);
            })->get()->getColumn("id")->toArray();
            $needles["results"] = $item->competition->id;
            $needles["ranking"] = $item->competition->id;
            $needles["roster"] = $rosters;
            $needles["events"] = $rosters;
        }
		return self::route('match', $item->id, $needles);
	}

    /**
     * Route for matchday view.
     * @param mixed $item
     * @return string
     */
	public static function matchday($item)
	{

        $item = ($item instanceof Illuminate\Database\Eloquent\Model) ? $item : FMManager\Database\Models\Matchday::withoutGlobalScopes()->find($item);

        $needles = array();
        if($item) {
            $teams = $item->competition->competitionTeams->getColumn("team_id")->toArray();
            $rosters = \FMManager\Database\Models\Roster::withoutGlobalScopes()->whereIn("team_id", $teams)->get()->getColumn("id")->toArray();

            $needles["results"] = $item->competition->id;
            $needles["ranking"] = $item->competition->id;
            $needles["roster"] = $rosters;
            $needles["events"] = $rosters;
        }
		return self::route('matchday', $item->id, $needles);
	}

    /**
     * Route for competition view.
     * @param mixed $item
     * @return string
     */
	public static function competition($item, $view)
	{
        $item = ($item instanceof Illuminate\Database\Eloquent\Model) ? $item : FMManager\Database\Models\Competition::withoutGlobalScopes()->find($item);

        $needles = array();
        if($item) {
            $teams = $item->competitionTeams->getColumn("team_id")->toArray();
            $competitions = \FMManager\Database\Models\Competition::whereHas("competitionTeams", function($query) use($teams) {
                    $query->whereIn("team_id", $teams)
                        ->whereHas("team", function($query) {
                            $query->where("club_id", "=", \FMManager\Helper::getMyClubId());
                    });
            })->where("id", "<>", $item->id)->get()->getColumn("id")->toArray();

            $rosters = \FMManager\Database\Models\Roster::withoutGlobalScopes()->whereIn("team_id", $teams)->get()->getColumn("id")->toArray();

            $needles["ranking"] = array_merge([$item->id], $competitions);
            $needles["results"] = array_merge([$item->id], $competitions);
            $needles["roster"] = $rosters;
            $needles["events"] = $rosters;
        }
        return self::route($view, $item,$needles);

	}

    /**
     * Route for roster view.
     * @param mixed $item
     * @return string
     */
	public static function roster($item, $view)
	{
        $item = ($item instanceof Illuminate\Database\Eloquent\Model) ? $item : \FMManager\Database\Models\Roster::withoutGlobalScopes()->find($item);

        $needles = array();
        if($item) {
            $rosters = \FMManager\Database\Models\Roster::withoutGlobalScopes()->where("team_id", "=", $item->team_id)->where("id", "<>", $item->id)->get()->getColumn("id")->toArray();
            $needles["roster"] = array_merge([$item->id], $rosters);
            $needles["players"] = array_merge([$item->id], $rosters);
            $needles["events"] = array_merge([$item->id], $rosters);
            $needles["teamstats"] = array_merge([$item->id], $rosters);
            $needles["playersstats"] = array_merge([$item->id], $rosters);
        }
        return self::route($view, $item,$needles);
	}

    /**
     * Route for roster view.
     * @param mixed $item
     * @return string
     */
	public static function season($item, $view)
	{
        $item = ($item instanceof Illuminate\Database\Eloquent\Model) ? $item : \FMManager\Database\Models\Season::withoutGlobalScopes()->find($item);

        $needles = array();
        if($item) {
            $seasons = \FMManager\Database\Models\Season::withoutGlobalScopes()->where("id", "<>", $item->id)->get()->getColumn("id")->toArray();
            $needles[$view] = array_merge([$item->id], $seasons);
            $needles["staff"] = array_merge([$item->id], $seasons);
            $needles["managers"] = array_merge([$item->id], $seasons);
        }
        return self::route($view, $item,$needles);
	}

	/**
     * Route an item.
     * @param string $view
     * @param mixed $item
     * @param array $needles
     * @return string
     */
	public static function route($view, $item, $needles = array(), $itemId = 0)
	{

        $id = ($item instanceof Illuminate\Database\Eloquent\Model) ? $item->id : $item;
        $needles               = array_merge(array($view => $id), $needles);
        $link = 'index.php?';
        $params["option"] = FM_MANAGER_COMPONENT;
        $params["view"] = $view;
        $params["id"] = $id;

        if(!$itemId) {
            if ($item = FootManager\Helpers\Route::findItem($needles, FM_MANAGER_COMPONENT, FootManager\Helpers\Application::getConfiguration(FM_MANAGER_COMPONENT)->get("set_itemid")))
                $params["Itemid"] = $item;
        } else {
            $params["Itemid"] = $itemId;
        }

        $link = $link.FootManager\Utilities\UrlHelper::prepareParameters($params);

		return JRoute::_($link);
	}

}