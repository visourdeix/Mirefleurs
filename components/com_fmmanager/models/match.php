<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\Registry\Registry;

/**
 * Content Component Article Model
 *
 * @since  1.5
 */
class FmmanagerModelMatch extends \FootManager\Model\Item
{

    protected function loadItem($pk) {
        return FMManager\Database\Models\Match::with(["goals.striker", "playersStatistics.statistic", "playersStatistics.person", "stadium.ground", "team1", "team2", "matchday.competition.tournament.type"])->find($pk);
    }

    public function getCallUp($id, $params = array()) {
        $match = FMManager\Database\Models\Match::withoutGlobalScopes()->with(["call_up.contacts.contacts"])->find($id);

        return $match->call_up;

    }

    public function getResults($id, $params = array()) {
        $match = FMManager\Database\Models\Match::find($id);

        return $match->matchday->matches->except($id);

    }

    public function getRanking($id, $params = array()) {
        $match = FMManager\Database\Models\Match::find($id);
        $competition = $match->matchday->competition;
        $item = new stdClass();

        // Params
        $columns = $competition->attribs["ranking_columns"];
        if(empty($columns) || $columns == "[]") {
            $columns = JArrayHelper::getValue($params, "ranking_columns", \FMManager\Helper::$RANKING_COLUMNS);
        }

        $item->legend = $competition->ranking_legend;
        $item->columns = is_string($columns) ? json_decode($columns) : $columns;
        $item->ranking = $competition->getRanking(FMManager\Constants::GENERAL, $match->datetime);

        return $item;
    }

    public function getFaceToFace($id, $params = array()) {

        $count_in_series = isset($params["match_count_in_series"]) ? $params["match_count_in_series"] : 5;

        $match = FMManager\Database\Models\Match::find($id);
        $matches = FMManager\Database\Models\Match::where(function($query) use($match) {
                $query->whereIn("team1_id", [$match->team1_id, $match->team2_id])
                    ->orWhereIn("team2_id", [$match->team1_id, $match->team2_id]);
            })->get();

        $item = new stdClass();

        $item->confrontations = $matches->filter(function($obj) use($match) { return $obj->played && FootManager\Utilities\DateHelper::isBefore($obj->datetime, $match->datetime) && $obj->isInEvent($match->team1) && $obj->isInEvent($match->team2) ;});

        $team1_last_matches = $matches->filter(function($obj) use($match) { return $obj->played && FootManager\Utilities\DateHelper::isBefore($obj->datetime, $match->datetime) && $obj->isInEvent($match->team1);});
        $item->team1_last_matches = $team1_last_matches->slice(count($team1_last_matches) - $count_in_series, $count_in_series);

        $team1_next_matches = $matches->filter(function($obj) use($match) { return ($obj->played || $obj->state == FMManager\Constants::NOT_PLAYED) && FootManager\Utilities\DateHelper::isAfter($obj->datetime, $match->datetime) && $obj->isInEvent($match->team1);});
        $item->team1_next_events = $team1_next_matches->slice(0, $count_in_series);

        $team2_last_matches = $matches->filter(function($obj) use($match) { return $obj->played && FootManager\Utilities\DateHelper::isBefore($obj->datetime, $match->datetime) && $obj->isInEvent($match->team2);});
        $item->team2_last_matches = $team2_last_matches->slice(count($team2_last_matches) - $count_in_series, $count_in_series);

        $team2_next_matches = $matches->filter(function($obj) use($match) { return ($obj->played || $obj->state == FMManager\Constants::NOT_PLAYED) && FootManager\Utilities\DateHelper::isAfter($obj->datetime, $match->datetime) && $obj->isInEvent($match->team2);});
        $item->team2_next_events = $team2_next_matches->slice(0, $count_in_series);

        $item->team1 = $match->team1;
        $item->team2 = $match->team2;

        return $item;
    }

    public function getStats($id, $params = array()) {

        $match = FMManager\Database\Models\Match::with(["teamsStatistics"])->find($id);
        $item = new stdClass();

        $teams_stats = FMManager\Database\Models\MatchTeamStatistics::with(["statistic"])->where("match_id", "=", $match->id)->get()->groupBy("statistic_id");

        $teams = array($match->team1, $match->team2);
        $matches = new FMManager\Database\Collections\Matches([$match]);

        $players_stats = [];
        foreach ($teams as $team)
        {
        	// Stats
            $stats = $matches->getStatsOfPlayers($team)->filter(function($obj) { return $obj->goals > 0 || $obj->assists > 0 || count($obj->stats) > 0; })->sortByDesc("goals");
            if(count($stats)) $players_stats[$team->id] = $stats;
        }

        $item->team1 = $match->team1;
        $item->team2 = $match->team2;
        $item->teams_stats = $teams_stats;
        $item->players_stats = $players_stats;

        return $item;
    }

    public function getTeams($id, $params = array()) {

        $match = FMManager\Database\Models\Match::with(["tactic1.tacticPositions", "tactic2.tacticPositions", "goals.striker", "goals.passer", "substitutions.playerOut", "substitutions.playerIn", "players.person", "staff.person", "team1", "team2"])->find($id);
        $item = new stdClass();

        $item->players1 = new FootManager\Database\Eloquent\Collection();
        $item->players2 = new FootManager\Database\Eloquent\Collection();
        $item->staff1 = new FootManager\Database\Eloquent\Collection();
        $item->staff2 = new FootManager\Database\Eloquent\Collection();

        for ($i = 1; $i <= 2; $i++)
        {
            $teamProperty = "team".$i;
            $tacticProperty = "tactic".$i;
        	$rosterProperty = "roster".$i;
            $playersProperty = "players".$i;
            $staffProperty = "staff".$i;
            $goalsProperty = "goals".$i;
            $substitutionsProperty = "substitutions".$i;

            $item->$teamProperty = $match->$teamProperty;
            $item->$tacticProperty = $match->$tacticProperty;

            if($match->$rosterProperty) {
                $rosterPlayers = FMManager\Database\Models\RosterPlayers::with("position")->where("roster_id", "=", $match->$rosterProperty->id)->get();
                $item->$playersProperty = $match->$playersProperty;
                $goals = $match->$goalsProperty;
                $substitutions = $match->$substitutionsProperty;

                foreach ($item->$playersProperty as $player)
                {
                    $rosterPlayer = $rosterPlayers->where("person_id", $player->person_id)->first();
                    $player->person->position = $rosterPlayer ? $rosterPlayer->position : null;
                    $player->goals = $goals->filter(function($obj) use($player) { return $obj->striker_id == $player->person_id;});
                    $player->assists = $goals->filter(function($obj) use($player) { return $obj->passer_id == $player->person_id;});
                    $player->substitutions = $substitutions->filter(function($obj) use($player) { return $obj->playerOut_id == $player->person_id || $obj->playerIn_id == $player->person_id;});
                }
                $item->$playersProperty = $item->$playersProperty->sortMulti(["person.position.ordering", "number", "person.inverse_name"]);

                $rosterStaff = FMManager\Database\Models\RosterStaff::with("_function")->where("roster_id", "=", $match->$rosterProperty->id)->get();
                $item->$staffProperty = $match->$staffProperty;
                foreach ($item->$staffProperty as $id => $person)
                {
                    $rosterPerson = $rosterStaff->where("person_id", $person->person_id)->first();
                    $function = $rosterPerson ? $rosterPerson->_function : null;
                    $person->person->_function = $function;
                }
                $item->$staffProperty = $item->$staffProperty->sortMulti(["person._function.ordering", "person.inverse_name"]);
            }

        }

        return $item;
    }
}