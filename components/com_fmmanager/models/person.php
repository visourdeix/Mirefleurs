<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Content Component Article Model
 *
 * @since  1.5
 */
class FmmanagerModelPerson extends \FootManager\Model\Ajax
{

    protected function loadItem($pk) {
        return \FMManager\Database\Models\Person::find($pk);
    }

    public function getData($id, &$params = array()) {
        $item = new stdClass();

        // Player Stats
        $player_matches_by_competition = \FMManager\Database\Models\MatchPlayers::with(["match", "team"])
            ->join("fm_matches", "fm_match_players.match_id", "=", "fm_matches.id")
            ->join("fm_matchdays", "fm_matches.matchday_id", "=", "fm_matchdays.id")
            ->join("fm_competitions", "fm_matchdays.competition_id", "=", "fm_competitions.id")
            ->join("fm_tournaments", "fm_competitions.tournament_id", "=", "fm_tournaments.id")
            ->join("fm_tournament_types", "fm_tournaments.type_id", "=", "fm_tournament_types.id")
            ->join("fm_seasons", "fm_competitions.season_id", "=", "fm_seasons.id")
            ->join("fm_categories", "fm_tournaments.category_id", "=", "fm_categories.id")
            ->where("person_id", "=", $id)
            ->orderBy("fm_seasons.ordering")
            ->orderBy("fm_categories.ordering")
            ->orderBy("fm_tournament_types.ordering")
            ->orderBy("fm_tournaments.ordering")
            ->select("fm_match_players.*")
            ->get()
            ->groupBy("match.matchday.competition_id");

        $player_stats = new \FootManager\Database\Eloquent\Collection();
        foreach ($player_matches_by_competition as $player_matches)
        {
            $player_matches_by_team = $player_matches->groupBy("team_id");
            foreach ($player_matches_by_team as $matches)
            {
            	$matches_of_players = $matches->map(function($obj) { return $obj->match; });
                $matches_of_players = new FMManager\Database\Collections\Matches($matches_of_players);
                $team = $matches->first()->team;
                $obj = $matches_of_players->getStatsOfPlayer($id, $team);
                $obj->team = $team;
                $obj->competition = $matches->first()->match->matchday->competition;
                $player_stats->offsetSet(null, $obj);
            }

        }

        // Staff Stats
        $staff_matches_by_competition = \FMManager\Database\Models\MatchStaff::with(["match", "team"])
            ->join("fm_matches", "fm_match_staff.match_id", "=", "fm_matches.id")
            ->join("fm_matchdays", "fm_matches.matchday_id", "=", "fm_matchdays.id")
            ->join("fm_competitions", "fm_matchdays.competition_id", "=", "fm_competitions.id")
            ->join("fm_tournaments", "fm_competitions.tournament_id", "=", "fm_tournaments.id")
            ->join("fm_tournament_types", "fm_tournaments.type_id", "=", "fm_tournament_types.id")
            ->join("fm_seasons", "fm_competitions.season_id", "=", "fm_seasons.id")
            ->join("fm_categories", "fm_tournaments.category_id", "=", "fm_categories.id")
            ->where("person_id", "=", $id)
            ->orderBy("fm_seasons.ordering")
            ->orderBy("fm_categories.ordering")
            ->orderBy("fm_tournament_types.ordering")
            ->orderBy("fm_tournaments.ordering")
            ->select("fm_match_staff.*")
            ->get()
            ->groupBy("match.matchday.competition_id");

        $staff_stats = new \FootManager\Database\Eloquent\Collection();
        foreach ($staff_matches_by_competition as $staff_matches)
        {
            $staff_matches_by_team = $staff_matches->groupBy("team_id");
            foreach ($staff_matches_by_team as $matches)
            {
            	$matches_of_staff= $matches->map(function($obj) { return $obj->match; });
                $matches_of_staff = new FMManager\Database\Collections\Matches($matches_of_staff);
                $team = $matches->first()->team;
                $obj = $matches_of_staff->getStatsOfTeam($team);
                $obj->team = $team;
                $obj->competition = $matches->first()->match->matchday->competition;
                $staff_stats->offsetSet(null, $obj);
            }

        }

        $item->player_stats = $player_stats->groupBy("competition.season.label");
        $item->staff_stats = $staff_stats->groupBy("competition.season.label");

        return $item;
    }
}