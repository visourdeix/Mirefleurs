<?php
/**
 * @package     Fmmanager
 * @subpackage  Position
 *
 * @copyright   Copyright (C) 2015 STéphane ANDRE. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Methods supporting a list of positions records.
 *
 */
class FmmanagerModelData extends JModelLegacy {

    public function getTournament($id) {
        return \FMManager\Database\Models\Tournament::with("type")->find($id);
    }

    public function getPerson($id) {
        return \FMManager\Database\Models\Person::find($id);
    }

    public function getTeam($id) {
        return \FMManager\Database\Models\Team::find($id);
    }

    public function getCategoryFromBirthdate($birthdate) {

        if($birthdate && strtotime($birthdate)) {
            $date = new JDate($birthdate);
            $year = $date->format("Y");
            $category = FMManager\Database\Models\Category::where("year", ">=", (int)$year)->orderBy("year", "ASC")->first();
            if($category) return $category->id;
        }

        return 0;
    }

    public function getCityFromPostalCode($postal_code) {
        $item = FMManager\Database\Models\Person::where("postal_code", "=", $postal_code)->where("city", "<>", "")->first();
        if($item) return $item->city;
        return "";
    }

    public function getPostalCodeFromCity($city) {
        $item = FMManager\Database\Models\Person::where("city", "=", $city)->where("postal_code", "<>", "")->first();
        if($item) return $item->postal_code;
        return "";
    }

    public function getTacticPositions($id) {
        $positions = \FMManager\Database\Models\TacticPositions::where("tactic_id", "=", $id)->get()->toArray();
        return array_map(function($obj) {
            return array_merge($obj, ["state" => FMManager\Constants::FIRST_TEAM_PLAYER]);
        }, $positions);
    }

    public function getPreviousMatchTactic($match_id, $team_id) {
        $match = FMManager\Database\Models\Match::find($match_id);
        $season_id = $match->matchday->competition->season_id;
        $prevMatch = FMManager\Database\Models\Match::previousMatches($team_id,  $match->datetime)
            ->whereHas("matchday", function($query) use($season_id) {
                $query->whereHas("competition", function($query) use($season_id) {
                    $query->where("season_id", "=", $season_id);
                });
            })
            ->where("state", "=", FMManager\Constants::PLAYED)
            ->orderBy("date", "DESC")
                    ->orderBy("time", "DESC")
            ->first();
        $tactic = 0;
        $players = array();
        $staff = array();

        if($prevMatch) {
            $tactic = ($prevMatch->team1_id == $team_id) ? $prevMatch->tactic1_id : $prevMatch->tactic2_id;
            $players = FMManager\Database\Models\MatchPlayers::where("match_id", "=", $prevMatch->id)->where("team_id", "=", $team_id)->get();
            $staff = FMManager\Database\Models\MatchStaff::where("match_id", "=", $prevMatch->id)->where("team_id", "=", $team_id)->get();
        }
        return array("tactic" => $tactic, "players" => $players, "staff" => $staff);
    }

    public function getCallUpPersons($call_up_id) {
        $players = FMManager\Database\Models\CallupPersons::where("call_up_id", "=", $call_up_id)->get();
        $staff = FMManager\Database\Models\CallupContacts::where("call_up_id", "=", $call_up_id)->get();

        return array("players" => $players, "staff" => $staff);
    }
}