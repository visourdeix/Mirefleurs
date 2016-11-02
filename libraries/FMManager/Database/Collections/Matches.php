<?php
/**
 * @package      FMEvents
 * @subpackage   Calendar
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FMManager\Database\Collections;

defined('JPATH_PLATFORM') or die;

/**
 * This class contains common methods and properties for a database item
 *
 * @package      FMEvents
 * @subpackage   Calendar
 */
class Matches extends \FootManager\Database\Eloquent\Collection {

    public function getStatsOfTeam($team) {

        $team_id = ($team instanceof \FMManager\Database\Models\Team) ? $team->id : $team;
        $item = new \stdClass();

        // Played
        $played = $this->filter(function($obj) {  return $obj->played; });
        $played_id = $played->map(function($obj) { return $obj->id; });
        $matchdays_id = $played->map(function($obj) { return $obj->matchday_id; });

        $item->played = $played;

        // Bigger matches
        foreach ($played as $match)
        {
            if($match->getDifference($team_id) > 0) {
                if(isset($item->biggerVictory)) {
                    if($match->getDifference($team_id) > $item->biggerVictory->getDifference($team_id))
                        $item->biggerVictory = $match;
                }
                else
                    $item->biggerVictory = $match;
            }

            if($match->getDifference($team_id) < 0) {
                if(isset($item->biggerDefeat)) {
                    if($match->getDifference($team_id) < $item->biggerDefeat->getDifference($team_id))
                        $item->biggerDefeat = $match;
                }
                else
                    $item->biggerDefeat = $match;
            }
        }

        // Series
        $matches_results = $played->map(function($obj) use($team_id) { return $obj->getResult($team_id);});
        $matches_conceded = $played->map(function($obj) use($team_id) { return ($obj->getConceded($team_id) == 0) ? 1 : 0;});
        $matches_scored = $played->map(function($obj) use($team_id) { return ($obj->getScored($team_id) > 0) ? 1 : 0;});

        $item->matchesWithoutVictories = \FootManager\Utilities\ArrayHelper::getMaxSuccessiveValue($matches_results, array(\FMManager\Constants::DEFEAT, \FMManager\Constants::DEFEAT_TO_PENALTIES, \FMManager\Constants::DRAW));
        $item->matchesWithoutDefeats = \FootManager\Utilities\ArrayHelper::getMaxSuccessiveValue($matches_results, array(\FMManager\Constants::VICTORY, \FMManager\Constants::VICTORY_TO_PENALTIES, \FMManager\Constants::DRAW));
        $item->consecutivesVictories = \FootManager\Utilities\ArrayHelper::getMaxSuccessiveValue($matches_results, \FMManager\Constants::VICTORY);
        $item->consecutivesDefeats = \FootManager\Utilities\ArrayHelper::getMaxSuccessiveValue($matches_results, \FMManager\Constants::DEFEAT);
        $item->consecutivesNoConceded = \FootManager\Utilities\ArrayHelper::getMaxSuccessiveValue($matches_conceded, 1);
        $item->consecutivesScored = \FootManager\Utilities\ArrayHelper::getMaxSuccessiveValue($matches_scored, 1);
        $item->consecutivesConceded = \FootManager\Utilities\ArrayHelper::getMaxSuccessiveValue($matches_conceded, 0);
        $item->consecutivesNoScored = \FootManager\Utilities\ArrayHelper::getMaxSuccessiveValue($matches_scored, 0);

        // Results
        $item->victories = $played->filter(function($obj) use($team_id) {  return $obj->isWinner($team_id); });
        $item->defeats = $played->filter(function($obj) use($team_id) {  return $obj->isLooser($team_id); });
        $item->draws = $played->filter(function($obj) use($team_id) {  return $obj->getResult($team_id) == \FMManager\Constants::DRAW; });

        // Scored
        $item->scored = $played->sum(function($obj) use($team_id) { return $obj->getScored($team_id); });

        // Conceded
        $item->conceded = $played->sum(function($obj) use($team_id) { return $obj->getConceded($team_id); });

        // Players stats
        $matches_players_statistics = \FMManager\Database\Models\MatchPlayerStatistics::whereIn("match_id", $played_id)->where("team_id", "=", $team_id)->get();
        $matchdays_players_statistics = \FMManager\Database\Models\MatchdayPlayerStatistics::whereIn("matchday_id", $matchdays_id)->get();
        $players_statistics = $matches_players_statistics->union($matchdays_players_statistics);
        $statistics = $players_statistics->unique(function($obj) { return $obj->statistic->id; })->map(function($obj) { return $obj->statistic; });

        $item->players_stats = new \FootManager\Database\Eloquent\Collection();
        foreach ($statistics as $statistic)
        {
            $player_statistic = $players_statistics->filter(function($obj) use($statistic) { return $obj->statistic_id == $statistic->id;});
            $function = strtolower($statistic->calculation);

            $stat = new \stdClass();
            $stat->statistic = $statistic;
            $value = $player_statistic->$function(function($obj) { return $obj->value; });
            $stat->value = (is_int($value)) ? $value : number_format($value, 2);
            $item->players_stats->offsetSet(null, $stat);
        }

        // Teams stats
        $matches_team_statistics = \FMManager\Database\Models\MatchTeamStatistics::whereIn("match_id", $played_id)->where("team_id", "=", $team_id)->get();
        $matchdays_team_statistics = \FMManager\Database\Models\MatchdayTeamStatistics::whereIn("matchday_id", $matchdays_id)->where("team_id", "=", $team_id)->get();
        $team_statistics = $matches_team_statistics->union($matchdays_team_statistics);
        $statistics = $team_statistics->unique(function($obj) { return $obj->statistic->id; })->map(function($obj) { return $obj->statistic; });

        $item->team_stats = new \FootManager\Database\Eloquent\Collection();
        foreach ($statistics as $statistic)
        {
            $team_statistic = $team_statistics->filter(function($obj) use($statistic) { return $obj->statistic_id == $statistic->id;});
            $function = strtolower($statistic->calculation);

            $stat = new \stdClass();
            $stat->statistic = $statistic;
            $value = $team_statistic->$function(function($obj) { return $obj->value; });
            $stat->value = (is_int($value)) ? $value : number_format($value, 2);
            $item->team_stats->offsetSet(null, $stat);
        }

        return $item;
    }

    /**
     * @return \FootManager\Database\Eloquent\Collection
     * */
    public function getStatsOfPlayers($team = null, $withMatchday = false) {

        $result = new \FootManager\Database\Eloquent\Collection();

        // Played
        $played = $this->filter(function($obj) {  return $obj->played; });
        $played_id = $played->map(function($obj) { return $obj->id; });
        $matchdays_id = $played->map(function($obj) { return $obj->matchday_id; });

        $matches_players = \FMManager\Database\Models\MatchPlayers::with("person")->whereIn("match_id", $played_id);
        $matches_goals = \FMManager\Database\Models\MatchGoals::with(["striker", "passer"])->whereIn("match_id", $played_id);
        $players_statistics = \FMManager\Database\Models\MatchPlayerStatistics::with("person")->whereIn("match_id", $played_id);

        if(isset($team)) {
            $team_id = ($team instanceof \FMManager\Database\Models\Team) ? $team->id : $team;
            $matches_goals = $matches_goals->where("team_id", "=", $team_id);
            $players_statistics = $players_statistics->where("team_id", "=", $team_id);
        }

        $matches_players = $matches_players->get();
        $matches_goals = $matches_goals->get();
        $players_statistics = $players_statistics->get();

        if($withMatchday) {
            $matchdays_players_statistics = \FMManager\Database\Models\MatchdayPlayerStatistics::whereIn("matchday_id", $matchdays_id)->get();
            $players_statistics = $players_statistics->union($matchdays_players_statistics);
        }

        $persons = $matches_players->unique(function($obj) { return $obj->person_id; })->map(function($obj) { return $obj->person; });
        $strikers = $matches_goals->unique(function($obj) { return $obj->striker_id; })->map(function($obj) { return $obj->striker; });
        $passers = $matches_goals->unique(function($obj) { return $obj->passer_id; })->map(function($obj) { return $obj->passer; });
        $persons_with_stats = $players_statistics->unique(function($obj) { return $obj->person_id; })->map(function($obj) { return $obj->person; });
        $players = $persons->union($strikers)->union($passers)->union($persons_with_stats)->unique(function($obj) { return $obj->id; });

        foreach ($players as $player)
        {

            $matches_player = $matches_players->filter(function($obj) use($player) { return $obj->person_id == $player->id;});
            $player_goals = $matches_goals->filter(function($obj) use($player) { return $obj->striker_id == $player->id;});
            $player_assists = $matches_goals->filter(function($obj) use($player) { return $obj->passer_id == $player->id;});
            $player_statistics = $players_statistics->filter(function($obj) use($player) { return $obj->person_id == $player->id;});

            $statistics = $player_statistics->unique(function($obj) { return $obj->statistic->id; })->map(function($obj) { return $obj->statistic; });

            $player_stats = new \stdClass();
            $player_stats->person = $player;
            $player_stats->played = count($matches_player->filter(function($obj) { return $obj->state != \FMManager\Constants::NOT_PLAYED; }));
            $player_stats->in_first_team = count($matches_player->filter(function($obj) { return $obj->state == \FMManager\Constants::FIRST_TEAM_PLAYER; }));
            $player_stats->substitutes = count($matches_player->filter(function($obj) { return $obj->state == \FMManager\Constants::SUBSTITUTE; }));
            $player_stats->goals = count($player_goals);
            $player_stats->assists = count($player_assists);

            $player_stats->stats = new \FootManager\Database\Eloquent\Collection();
            foreach ($statistics as $statistic)
            {
                $player_statistic = $player_statistics->filter(function($obj) use($statistic) { return $obj->statistic_id == $statistic->id;});
                $function = strtolower($statistic->calculation);

                $stat = new \stdClass();
                $stat->statistic = $statistic;
                $value = $player_statistic->$function(function($obj) { return $obj->value; });
                $stat->value = (is_int($value)) ? $value : number_format($value, 2);
                $player_stats->stats->offsetSet(null, $stat);
            }

            $result->offsetSet(null, $player_stats);
        }

        return $result;
    }

    /**
     * @return \stdClass
     * */
    public function getStatsOfPlayer($player, $team = null) {

        $player_id = ($player instanceof \FMManager\Database\Models\Team) ? $player->id : $player;
        $result = new \stdClass();

        // Played
        $played = $this->filter(function($obj) {  return $obj->played; });
        $played_id = $played->map(function($obj) { return $obj->id; });
        $matchdays_id = $played->map(function($obj) { return $obj->matchday_id; });

        $matches = \FMManager\Database\Models\MatchPlayers::whereIn("match_id", $played_id)->where("person_id", "=", $player_id);
        $goals = \FMManager\Database\Models\MatchGoals::whereIn("match_id", $played_id)->where("striker_id", "=", $player_id);
        $assists = \FMManager\Database\Models\MatchGoals::whereIn("match_id", $played_id)->where("passer_id", "=", $player_id);
        $matches_statistics = \FMManager\Database\Models\MatchPlayerStatistics::whereIn("match_id", $played_id)->where("person_id", "=", $player_id);

        if(isset($team)) {
            $team_id = ($team instanceof \FMManager\Database\Models\Team) ? $team->id : $team;
            $matches = $matches->where("team_id", "=", $team_id);
            $goals = $goals->where("team_id", "=", $team_id);
            $assists = $assists->where("team_id", "=", $team_id);
            $matches_statistics = $matches_statistics->where("team_id", "=", $team_id);
        }

        $matches = $matches->get();
        $goals = $goals->get();
        $assists = $assists->get();
        $matches_statistics = $matches_statistics->get();
        $matchdays_statistics = \FMManager\Database\Models\MatchdayPlayerStatistics::whereIn("matchday_id", $matchdays_id)->where("person_id", "=", $player_id)->get();
        $stats = $matches_statistics->union($matchdays_statistics);

        $statistics = $stats->unique(function($obj) { return $obj->statistic->id; })->map(function($obj) { return $obj->statistic; });

        $result->played = count($matches->filter(function($obj) { return $obj->state != \FMManager\Constants::NOT_PLAYED; }));
        $result->in_first_team = count($matches->filter(function($obj) { return $obj->state == \FMManager\Constants::FIRST_TEAM_PLAYER; }));
        $result->substitutes = count($matches->filter(function($obj) { return $obj->state == \FMManager\Constants::SUBSTITUTE; }));
        $result->goals = count($goals);
        $result->assists = count($assists);

        $result->stats = new \FootManager\Database\Eloquent\Collection();
        foreach ($statistics as $statistic)
        {
            $player_statistic = $stats->filter(function($obj) use($statistic) { return $obj->statistic_id == $statistic->id;});
            $function = strtolower($statistic->calculation);

            $stat = new \stdClass();
            $stat->statistic = $statistic;
            $value = $player_statistic->$function(function($obj) { return $obj->value; });
            $stat->value = (is_int($value)) ? $value : number_format($value, 2);
            $result->stats->offsetSet(null, $stat);
        }

        return $result;
    }

    /**
     * Get competitions.
     * @return \FootManager\Database\Eloquent\Collection
     */
    public function getCompetitions() {
        $competitions = $this->map(function ($obj) { return $obj->matchday->competition;});
        $result = new \FootManager\Database\Eloquent\Collection();
        foreach ($competitions as $competition)
        {
        	$result->offsetSet($competition->id, $competition);
        }

        return $result;
    }

    /**
     * Filter by type.
     * @param mixed $type
     * @param mixed $team
     * @return Matches|\Illuminate\Support\Collection
     */
    public function filteredByType($type, $team) {
        switch ($type)
        {
            case \FMManager\Constants::HOME :
                return $this->filter(function($obj) use($team) {  return $obj->team1_id == $team->id && !$obj->neutral_stadium; });

            case \FMManager\Constants::AWAY :
                return $this->filter(function($obj) use($team) {  return $obj->team2_id == $team->id && !$obj->neutral_stadium; });

            case \FMManager\Constants::NEUTRAL :
                return $this->filter(function($obj) use($team) {  return ($obj->team1_id == $team->id || $obj->team2_id == $team->id) && $obj->neutral_stadium; });

        	default:
                return $this;
        }

    }

    /**
     * Gets the ranking
     * @param mixed $matches
     * @param mixed $type
     * @param mixed $sort
     * @param mixed $teams
     * @return mixed
     */
    public function getRanking($sort = array(), $teams = array(),  $type = \FMManager\Constants::GENERAL) {

        $ranking = new \FootManager\Database\Eloquent\Collection();

        foreach ($teams as $team)
        {

            $row = new \stdClass();
            $team_played = $this->filter(function($obj) use($team) {  return $obj->getResult($team) != \FMManager\Constants::NOT_PLAYED; })->filteredByType($type, $team);

            $team_victories = $team_played->filter(function($obj) use($team) {  return $obj->getResult($team) == \FMManager\Constants::VICTORY; });
            $team_victories_to_penalties = $team_played->filter(function($obj) use($team) {  return $obj->getResult($team) == \FMManager\Constants::VICTORY_TO_PENALTIES; });
            $team_draws = $team_played->filter(function($obj) use($team) {  return $obj->getResult($team) == \FMManager\Constants::DRAW; });
            $team_defeats = $team_played->filter(function($obj) use($team) {  return $obj->getResult($team) == \FMManager\Constants::DEFEAT; });
            $team_defeats_to_penalties = $team_played->filter(function($obj) use($team) {  return $obj->getResult($team) == \FMManager\Constants::DEFEAT_TO_PENALTIES; });
            $withdraws = $team_played->filter(function($obj) use($team) {  return $obj->isWithdraw($team); });
            $scored = $team_played->sum(function($obj) use($team) {  return $obj->getScored($team); });
            $conceded = $team_played->sum(function($obj) use($team) {  return $obj->getConceded($team); });
            $bonus = $team_played->sum(function($obj) use($team) {  return $obj->getBonus($team); });

            $row->team = $team;
            $row->matches = $team_played;
            $row->played = count($team_played);
            $row->victories = count($team_victories);
            $row->victories_to_penalties = count($team_victories_to_penalties);
            $row->draws = count($team_draws);
            $row->defeats = count($team_defeats);
            $row->defeats_to_penalties = count($team_defeats_to_penalties);
            $row->withdraws = count($withdraws);
            $row->scored = $scored;
            $row->conceded = $conceded;
            $row->difference = $scored - $conceded;
            $row->bonus = $bonus;

            $ranking[] = $row;
        }

        if($sort) {
            $directions = array_fill(0, count($sort), -1);
            $ranking = $ranking->sortMulti($sort, $directions);
        }

        $i = 1;

        foreach ($ranking as $row)
        {
        	$row->rank = $i;
            $i++;
        }

        return $ranking;

    }

}

?>