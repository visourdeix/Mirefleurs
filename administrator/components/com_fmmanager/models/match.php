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
class FmmanagerModelMatch extends \FMManager\Model\Backend\Event
{

    /**
     * Method to get a menu item.
     *
     * @param   integer  $pk  An optional id of the object to get, otherwise the id from the model state is used.
     *
     * @return  mixed  Menu item data object on success, false on failure.
     *
     * @since   1.6
     */
	public function getItem($pk = null)
	{

        if(!empty($this->_item)) return $this->_item;

		if($this->_item = parent::getItem($pk)) {

            $table = $this->getTable();

            $table->bind(JArrayHelper::fromObject($this->_item, false));

            $this->_item->matchday = FMManager\Database\Models\Matchday::with("competition.tournament.type")->find($this->_item->matchday_id);
            $this->_item->competition = $this->_item->matchday->competition;

            $statistics = FMManager\Database\Models\Statistic::where("by_match", "=", 1)->get();

            $properties = ["players", "staff", "playersStatistics", "staffStatistics", "substitutions", "goals"];
            for ($i = 1; $i <= 2; $i++)
            {
                foreach ($properties as $property)
                {
                    $prop = $property.$i;
                	$this->_item->$prop = call_user_func([$this, "map".ucfirst($property)],  $table->$prop, $statistics);
                }

                $prop = "playersEvents".$i;
                $otherProp = "playersStatistics".$i;
                $this->_item->$prop = $this->mapPlayersEvents($table->$otherProp, $statistics);

                $prop = "staffEvents".$i;
                $otherProp = "staffStatistics".$i;
                $this->_item->$prop = $this->mapStaffEvents($table->$otherProp, $statistics);

                $prop = "firstTeamPlayers".$i;
                $otherProp = "players".$i;
                $this->_item->$prop = $this->mapFirstTeamPlayers($table->$otherProp, $statistics);

                $prop = "substitutes".$i;
                $otherProp = "players".$i;
                $this->_item->$prop = $this->mapSubstitutes($table->$otherProp, $statistics);

                $prop = "roster".$i;
                $team = "team".$i."_id";
                $this->_item->$prop = FMManager\Database\Models\Roster::withoutGlobalScopes()->with("team")->where("team_id", "=", $this->_item->$team)->where("season_id", "=", $this->_item->matchday->competition->season_id)->first();

                $prop = "team".$i;
                $this->_item->$prop = FMManager\Database\Models\Team::find($this->_item->$team);

                $prop = "previousMatch".$i;
                $season_id = $this->_item->matchday->competition->season_id;
                $this->_item->$prop = FMManager\Database\Models\Match::previousMatches($this->_item->$team,  $this->_item->date.' '.$this->_item->time)
                    ->whereHas("matchday", function($query) use($season_id) {
                        $query->whereHas("competition", function($query) use($season_id) {
                            $query->where("season_id", "=", $season_id);
                        });
                    })
                    ->where("state", "=", FMManager\Constants::PLAYED)
                    ->orderBy("date", "DESC")
                    ->orderBy("time", "DESC")
                    ->first();
            }

            $this->_item->teamsStatistics = $this->mapTeamsStatistics($table->teamsStatistics, $statistics);

        }

        return $this->_item;
    }

    /**
     * Map Players property.
     * @param mixed $items
     * @param mixed $statistics
     * @return mixed
     */
    private function mapPlayers($items, $statistics) {
        $result = [];
        foreach ($items as $item)
        	$result[$item["person_id"]] = $item;
        return $result;
    }

    /**
     * Map Staff property.
     * @param mixed $items
     * @param mixed $statistics
     * @return mixed
     */
    private function mapStaff($items, $statistics) {
        $result = [];
        foreach ($items as $item) {
        	$result[$item["person_id"]] = $item;
            $result[$item["person_id"]]["state"] = FMManager\Constants::IN_MATCH;
        }
        return $result;
    }

    /**
     * Map Players Statistics property.
     * @param mixed $items
     * @param mixed $statistics
     * @return mixed
     */
    private function mapPlayersStatistics($items, $statistics) {
        $statistics_by_player = $statistics->filter(function($obj) { return $obj->by_player; });

        return $this->mapPersonStatistics($items, $statistics_by_player);
    }

    /**
     * Map Staff statistics property.
     * @param mixed $items
     * @param mixed $statistics
     * @return mixed
     */
    private function mapStaffStatistics($items, $statistics) {
        $statistics_by_staff = $statistics->filter(function($obj) { return $obj->by_staff; });

        return $this->mapPersonStatistics($items, $statistics_by_staff);
    }

    /**
     * Map Statistics property.
     * @param mixed $items
     * @param mixed $statistics
     * @return mixed
     */
    private function mapPersonStatistics($items, $statistics) {
        $statistics_by_person = $statistics->filter(function($obj) { return $obj->is_event != 1; })->getColumn("id")->toArray();
        $persons_stats = array_filter($items, function($obj) use($statistics_by_person) { return in_array($obj["statistic_id"], $statistics_by_person) ;});
        $person_ids = array_unique(FootManager\Utilities\ArrayHelper::getColumn($persons_stats, "person_id"));

        $results = array();
        foreach ($person_ids as $person_id)
        {
            $obj = [];
            $stats = array_filter($persons_stats, function($obj) use($person_id) { return $obj["person_id"] == $person_id; });
            $stats_by_stat = FootManager\Utilities\ArrayHelper::group($stats, "statistic_id");

            foreach ($stats_by_stat as $stat => $group)
            {
            	$obj["statistic_".$stat] = array_sum(FootManager\Utilities\ArrayHelper::getColumn($group, "value"));
            }

            $results[$person_id] = $obj;
        }

        return $results;
    }

    /**
     * Map Players Events property.
     * @param mixed $items
     * @param mixed $statistics
     * @return mixed
     */
    private function mapPlayersEvents($items, $statistics) {
        $events_by_players = $statistics->filter(function($obj) { return $obj->by_player; });

        return $this->mapPersonEvents($items, $events_by_players);
    }

    /**
     * Map Staff Events property.
     * @param mixed $items
     * @param mixed $statistics
     * @return mixed
     */
    private function mapStaffEvents($items, $statistics) {
        $events_by_staff = $statistics->filter(function($obj) { return $obj->by_staff; });

        return $this->mapPersonEvents($items, $events_by_staff);
    }

    /**
     * Map Events property.
     * @param mixed $items
     * @param mixed $statistics
     * @return mixed
     */
    private function mapPersonEvents($items, $statistics) {
        $events_by_person = $statistics->filter(function($obj) { return $obj->is_event == 1; })->getColumn("id")->toArray();
        $result = array_filter($items, function($obj) use($events_by_person) { return in_array($obj["statistic_id"], $events_by_person);});
        return $result;
    }

    /**
     * Map Goals property.
     * @param mixed $items
     * @param mixed $statistics
     * @return mixed
     */
    private function mapGoals($items, $statistics) {
        return $items;
    }

    /**
     * Map Substitutions property.
     * @param mixed $items
     * @param mixed $statistics
     * @return mixed
     */
    private function mapSubstitutions($items, $statistics) {
        return $items;
    }

    /**
     * Map First Team Players property.
     * @param mixed $items
     * @param mixed $statistics
     * @return mixed
     */
    private function mapFirstTeamPlayers($items, $statistics) {
        return array_filter($items, function($obj) { return $obj["state"] == FMManager\Constants::IN_MATCH || $obj["state"] == FMManager\Constants::FIRST_TEAM_PLAYER; });
    }

    /**
     * Map Substitutes property.
     * @param mixed $items
     * @param mixed $statistics
     * @return mixed
     */
    private function mapSubstitutes($items, $statistics) {
        return array_filter($items, function($obj) { return $obj["state"] == FMManager\Constants::SUBSTITUTE; });
    }

    /**
     * Map Statistics property.
     * @param mixed $items
     * @param mixed $statistics
     * @return mixed
     */
    private function mapTeamsStatistics($items, $statistics) {
        $statistics_by_team = $statistics->filter(function($obj) { return $obj->is_event != 1 && $obj->by_team == 1; })->getColumn("id")->toArray();
        $teams_stats = array_filter($items, function($obj) use($statistics_by_team) { return in_array($obj["statistic_id"], $statistics_by_team) ;});
        $team_ids = array_unique(FootManager\Utilities\ArrayHelper::getColumn($teams_stats, "team_id"));

        $results = array();
        foreach ($team_ids as $team_id)
        {
            $obj = [];
            $stats = array_filter($teams_stats, function($obj) use($team_id) { return $obj["team_id"] == $team_id; });
            $stats_by_stat = FootManager\Utilities\ArrayHelper::group($stats, "statistic_id");

            foreach ($stats_by_stat as $stat => $group)
            {
            	$obj["statistic_".$stat] = array_sum(FootManager\Utilities\ArrayHelper::getColumn($group, "value"));
            }

            $results[$team_id] = $obj;
        }

        return $results;
    }

    /**
     * Auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @return  void
     * @since    3.0
     */
    protected function preprocessForm(JForm $form, $data, $group = 'fmmanager') {
        if ($data) {
            $competition= $data->competition;
            $statistics = $competition->statistics;
            $players_statistics_allowed = $statistics->filter(function($obj) { return $obj->by_match == 1 && $obj->by_player == 1 && $obj->is_event == 0;});
            $staff_statistics_allowed = $statistics->filter(function($obj) { return $obj->by_match == 1 && $obj->by_staff == 1 && $obj->is_event == 0;});
            $players_events_allowed = $statistics->filter(function($obj) { return $obj->by_match == 1 && $obj->by_player == 1 && $obj->is_event == 1;});
            $staff_events_allowed = $statistics->filter(function($obj) { return $obj->by_match == 1 && $obj->by_staff == 1 && $obj->is_event == 1;});
            $teams_statistics_allowed = $statistics->filter(function($obj) { return $obj->by_match == 1 && $obj->by_team == 1 && $obj->is_event == 0;});

            for ($i = 1; $i <= 2; $i++)
            {
                $rosterProperty = "roster".$i;
                $roster = $data->$rosterProperty;

                if($roster) {

                    // Players
                    $prop = "players".$i;
                    $player_ids = FMManager\Database\Models\RosterPlayers::whereHas("roster", function($query) use($competition, $roster) {
                    $query->where("season_id", "=", $competition->season_id)
                        ->where(function($query) use($roster) {
                            $query->whereHas("team", function($query) use($roster) {
                                $query->where("category_id", "=", $roster->team->category_id)
                                    ->where("club_id", "=", $roster->team->club_id);
                            })
                                ->orWhere(function($query) use($roster) {
                                    $query->whereNotNull("team_id")
                                        ->where("team_id", "=", $roster->relation_team_id);
                                });
                        });
                })->get()->getColumn("person_id")->toArray();
                    $player_ids = array_merge($player_ids, (array)array_keys($data->$prop));
                    $form->setFieldAttribute($prop, "persons", implode(",",$player_ids));

                    // Staff
                    $prop = "staff".$i;
                    $staff_ids = FMManager\Database\Models\RosterStaff::whereHas("roster", function($query) use($competition, $roster) {
                    $query->where("season_id", "=", $competition->season_id)
                        ->where(function($query) use($roster) {
                            $query->whereHas("team", function($query) use($roster) {
                                $query->where("category_id", "=", $roster->team->category_id)
                                    ->where("club_id", "=", $roster->team->club_id);
                            })
                                ->orWhere(function($query) use($roster) {
                                    $query->whereNotNull("team_id")
                                        ->where("team_id", "=", $roster->relation_team_id);
                                });
                        });
                })->get()->getColumn("person_id")->toArray();
                    $staff_ids = array_merge($staff_ids, (array)array_keys($data->$prop));
                    $form->setFieldAttribute($prop, "persons", implode(",",$staff_ids));

                    // Tactic players
                    $prop = "tactic".$i."_id";
                    $form->setFieldAttribute("firstTeamPlayers".$i, "tactic", $data->$prop);
                    $form->setFieldAttribute("person_id", "allowed_options", implode(",",$player_ids), "firstTeamPlayers".$i."_list");
                    $form->setFieldAttribute("person_id", "allowed_options", implode(",",$player_ids), "substitutes".$i."_list");

                    // Substitutions
                    $form->setFieldAttribute("playerOut_id", "allowed_options", implode(",",$player_ids), "substitutions".$i."_list");
                    $form->setFieldAttribute("playerIn_id", "allowed_options", implode(",",$player_ids), "substitutions".$i."_list");

                    // Goals
                    $form->setFieldAttribute("striker_id", "allowed_options", implode(",",$player_ids), "goals".$i."_list");
                    $form->setFieldAttribute("passer_id", "allowed_options", implode(",",$player_ids), "goals".$i."_list");

                    // Players events
                    if(count($players_events_allowed)) {
                        $allowed_stats = $players_events_allowed->getColumn("id")->implode(",");
                        $form->setFieldAttribute("person_id", "allowed_options", implode(",",$player_ids), "playersEvents".$i."_list");
                        $form->setFieldAttribute("statistic_id", "allowed_options", $allowed_stats, "playersEvents".$i."_list");
                    } else {
                        $form->removeField("playersEvents".$i);
                    }

                    // Staff events
                    if(count($staff_events_allowed)) {
                        $allowed_stats = $staff_events_allowed->getColumn("id")->implode(",");
                        $form->setFieldAttribute("person_id", "allowed_options",implode(",",$staff_ids), "staffEvents".$i."_list");
                        $form->setFieldAttribute("statistic_id", "allowed_options", $allowed_stats, "staffEvents".$i."_list");
                    } else {
                        $form->removeField("staffEvents".$i);
                    }

                    // Players Stats
                    if (count($players_statistics_allowed)) {
                        $elements = array();
                        foreach ($players_statistics_allowed as $stat) {
                            $elements[] = new SimpleXMLElement('<field name="statistic_' . $stat->id . '"
														type="fmtouchspin"
                                                        max="1000"
														label="' . $stat->abbreviation . '"
														description="' . $stat->label . '" default="" />');
                        }

                        $form->setFieldAttribute("playersStatistics".$i, "persons", implode(",",$player_ids));

                        $form->setFields($elements, 'playersStatistics'.$i.'_list');
                    } else {
                        $form->removeField('playersStatistics'.$i);
                    }

                    // Staff Stats
                    if (count($staff_statistics_allowed)) {
                        $elements = array();
                        foreach ($staff_statistics_allowed as $stat) {
                            $elements[] = new SimpleXMLElement('<field name="statistic_' . $stat->id . '"
														type="fmtouchspin"
                                                        max="1000"
														label="' . $stat->abbreviation . '"
														description="' . $stat->label . '" default="" />');
                        }

                        $form->setFieldAttribute("staffStatistics".$i, "persons", implode(",",$staff_ids));

                        $form->setFields($elements, 'staffStatistics'.$i.'_list');
                    } else {
                        $form->removeField('staffStatistics'.$i);
                    }

                }
            }

            // Teams Stats
            if (count($teams_statistics_allowed)) {
                $elements = array();
                foreach ($teams_statistics_allowed as $stat) {
                    $elements[] = new SimpleXMLElement('<field name="statistic_' . $stat->id . '"
														type="fmtouchspin"
                                                        max="1000"
														label="' . $stat->abbreviation . '"
														description="' . $stat->label . '" default="" />');
                }

                $form->setFieldAttribute("teamsStatistics", "teams", implode(",",array($data->team1_id, $data->team2_id)));

                $form->setFields($elements, 'teamsStatistics_list');
            } else {
                $form->removeField('teamsStatistics');
            }

            /// Informations
            $referees = FMManager\Database\Models\Match::orderBy("referee")->get(["referee"])->getColumn("referee")->toArray();
            $form->setFieldAttribute("referee", "source", implode(",", (array)$referees));

            if (!$competition->tournament->type->by_match) {
                $form->setFieldAttribute("date", "readonly", true);
                $form->setFieldAttribute("stadium_id", "disabled", true);
                $form->setFieldAttribute("stadium_id", "editLink", "");
                $form->removeField('neutral_stadium');
            }

            if (!$competition->tournament->extra_time)
                $form->removeField('extra_time');

            if (!$competition->tournament->penalties) {
                $form->removeField('penalties1');
                $form->removeField('penalties2');
            }

            if (!$competition->tournament->type->has_ranking) {
                $form->removeField('bonus1');
                $form->removeField('bonus2');
            }
        }

        parent::preprocessForm($form, $data, $group);
    }

    /**
     * Method to save the form data.
     *
     * @param   array  $data  The form data.
     *
     * @return  boolean  True on success, False on error.
     *
     * @since   12.2
     */
    public function save($data) {

        for ($i = 1; $i <= 2; $i++)
        {
            $teamProp = "team".$i."_id";
            $tacticProp = "tactic".$i."_id";
            if(isset($data[$tacticProp]) && $data[$tacticProp] > 0) {

                // First Team
                $prop = "firstTeamPlayers".$i;
                if(isset($data[$prop])) {
                    $players = $this->unmapFirstTeamPlayers($data[$prop], $data[$teamProp]);
                    $data["players"] = isset($data["players"]) ? array_merge($data["players"], $players) : $players;
                    unset($data[$prop]);
                }

                // Substitutes
                $prop = "substitutes".$i;
                if(isset($data[$prop])) {
                    $players = $this->unmapSubstitutes($data[$prop], $data[$teamProp]);
                    $data["players"] = isset($data["players"]) ? array_merge($data["players"], $players) : $players;
                    unset($data[$prop]);
                }

            } else {

                // Players
                $prop = "players".$i;
                if(isset($data[$prop])) {
                    $players = $this->unmapPlayers($data[$prop], $data[$teamProp]);
                    $data["players"] = isset($data["players"]) ? array_merge($data["players"], $players) : $players;
                    unset($data[$prop]);
                }
            }

            // Staff
            $prop = "staff".$i;
            if(isset($data[$prop])) {
                $staff = $this->unmapStaff($data[$prop], $data[$teamProp]);
                $data["staff"] = isset($data["staff"]) ? array_merge($data["staff"], $staff) : $staff;
                unset($data[$prop]);
            }

            // Goals
            $prop = "goals".$i;
            if(isset($data[$prop])) {
                $goals = $this->unmapGoals($data[$prop], $data[$teamProp]);
                $data["goals"] = isset($data["goals"]) ? array_merge($data["goals"], $goals) : $goals;
                unset($data[$prop]);
            }

            // Substitutions
            $prop = "substitutions".$i;
            if(isset($data[$prop])) {
                $substitutions = $this->unmapSubstitutions($data[$prop], $data[$teamProp]);
                $data["substitutions"] = isset($data["substitutions"]) ? array_merge($data["substitutions"], $substitutions) : $substitutions;
                unset($data[$prop]);
            }

            // Players Events
            $prop = "playersEvents".$i;
            if(isset($data[$prop])) {
                $playersEvents = $this->unmapPlayersEvents($data[$prop], $data[$teamProp]);
                $data["playersStatistics"] = isset($data["playersStatistics"]) ? array_merge($data["playersStatistics"], $playersEvents) : $playersEvents;
                unset($data[$prop]);
            }

            // Players Statistics
            $prop = "playersStatistics".$i;
            if(isset($data[$prop])) {
                $playersStatistics = $this->unmapPlayersStatistics($data[$prop], $data[$teamProp]);
                $data["playersStatistics"] = isset($data["playersStatistics"]) ? array_merge($data["playersStatistics"], $playersStatistics) : $playersStatistics;
                unset($data[$prop]);
            }

            // Staff Events
            $prop = "staffEvents".$i;
            if(isset($data[$prop])) {
                $staffEvents = $this->unmapStaffEvents($data[$prop], $data[$teamProp]);
                $data["staffStatistics"] = isset($data["staffStatistics"]) ? array_merge($data["staffStatistics"], $staffEvents) : $staffEvents;
                unset($data[$prop]);
            }

            // Staff Statistics
            $prop = "staffStatistics".$i;
            if(isset($data[$prop])) {
                $staffStatistics = $this->unmapStaffStatistics($data[$prop], $data[$teamProp]);
                $data["staffStatistics"] = isset($data["staffStatistics"]) ? array_merge($data["staffStatistics"], $staffStatistics) : $staffStatistics;
                unset($data[$prop]);
            }
        }

        // Team Statistics
        if(isset($data["teamsStatistics"])) {
            $data["teamsStatistics"] = $this->unmapTeamsStatistics($data["teamsStatistics"]);
        }

        return parent::save($data);
    }

    /**
     * Map Players property.
     * @param mixed $items
     * @param mixed $statistics
     * @return mixed
     */
    private function unmapPlayers($items, $team) {
        $items = is_string($items) ? json_decode($items, true) : $items;
        $result = array_filter($items, function($obj) { return (!isset($obj["state"]) || $obj["state"] !== FMManager\Constants::NOT_IN_MATCH);});
        $result = array_map(function($obj) use($team) { unset($obj["goal"]); return array_merge($obj, ["team_id" => $team]); }, $result);
        return $result;
    }

    /**
     * Map Staff property.
     * @param mixed $items
     * @param mixed $statistics
     * @return mixed
     */
    private function unmapStaff($items, $team) {
        $items = is_string($items) ? json_decode($items, true) : $items;
        $result = array_filter($items, function($obj) { return $obj["state"] == FMManager\Constants::IN_MATCH;});
        $result = array_map(function($obj) use($team) { unset($obj["state"]); return array_merge($obj, ["team_id" => $team]); }, $result);
        return $result;
    }

    /**
     * Map Players property.
     * @param mixed $items
     * @param mixed $statistics
     * @return mixed
     */
    private function unmapFirstTeamPlayers($items, $team) {
        $items = is_string($items) ? json_decode($items, true) : $items;
        $result = array_filter($items, function($obj) { return !empty($obj["person_id"]) && (!isset($obj["state"]) || $obj["state"] == FMManager\Constants::FIRST_TEAM_PLAYER || $obj["state"] == FMManager\Constants::IN_MATCH);});
        $result = array_map(function($obj) use($team) { unset($obj["tactic_id"]); unset($obj["position_id"]); unset($obj["label"]); return array_merge($obj, ["state" => FMManager\Constants::FIRST_TEAM_PLAYER, "team_id" => $team]); }, $result);
        return $result;
    }

    /**
     * Map Players property.
     * @param mixed $items
     * @param mixed $statistics
     * @return mixed
     */
    private function unmapSubstitutes($items, $team) {
        $items = is_string($items) ? json_decode($items, true) : $items;
        $result = array_filter($items, function($obj) { return (!isset($obj["state"]) || $obj["state"] == FMManager\Constants::SUBSTITUTE);});
        $result = array_map(function($obj) use($team) { return array_merge($obj, ["state" => FMManager\Constants::SUBSTITUTE, "team_id" => $team]); }, $result);
        return $result;
    }

    /**
     * Map Goals property.
     * @param mixed $items
     * @param mixed $statistics
     * @return mixed
     */
    private function unmapGoals($items, $team) {
        $items = is_string($items) ? json_decode($items, true) : $items;
        return array_map(function($obj) use($team) {return array_merge($obj, ["team_id" => $team]); }, $items);
    }

    /**
     * Map Substitutions property.
     * @param mixed $items
     * @param mixed $statistics
     * @return mixed
     */
    private function unmapSubstitutions($items, $team) {
        $items = is_string($items) ? json_decode($items, true) : $items;
        return array_map(function($obj) use($team) { return array_merge($obj, ["team_id" => $team]); }, $items);
    }

    /**
     * Map Players Statistics property.
     * @param mixed $items
     * @param mixed $statistics
     * @return mixed
     */
    private function unmapPlayersStatistics($items, $team) {
        return $this->unmapPersonStatistics($items, $team);
    }

    /**
     * Map Staff statistics property.
     * @param mixed $items
     * @param mixed $statistics
     * @return mixed
     */
    private function unmapStaffStatistics($items, $team) {
        return $this->unmapPersonStatistics($items, $team);
    }

    /**
     * Map Statistics property.
     * @param mixed $items
     * @param mixed $statistics
     * @return mixed
     */
    private function unmapPersonStatistics($items, $team) {
        $items = is_string($items) ? json_decode($items, true) : $items;

        $result = array();

        foreach ($items as $row)
        {
            foreach ($row as $key => $value)
            {
            	if(strstr($key, "statistic_") !== false && $value != "") {
                    $statistic_id = (int)str_replace("statistic_", "", $key);
                    $result[] = ["person_id" => $row["person_id"], "team_id" => $team, "statistic_id" =>$statistic_id, "value" => $value, "minute" => 0];
                }
            }

        }

        return $result;
    }

    /**
     * Map Players Events property.
     * @param mixed $items
     * @param mixed $statistics
     * @return mixed
     */
    private function unmapPlayersEvents($items, $team) {
        return $this->unmapPersonEvents($items, $team);
    }

    /**
     * Map Staff Events property.
     * @param mixed $items
     * @param mixed $statistics
     * @return mixed
     */
    private function unmapStaffEvents($items, $team) {
        return $this->unmapPersonEvents($items, $team);
    }

    /**
     * Map Events property.
     * @param mixed $items
     * @param mixed $statistics
     * @return mixed
     */
    private function unmapPersonEvents($items, $team) {
        $items = is_string($items) ? json_decode($items, true) : $items;
        return array_map(function($obj) use($team) { return array_merge($obj, ["value" => 1, "team_id" => $team]); }, $items);
    }

    /**
     * Map Statistics property.
     * @param mixed $items
     * @param mixed $statistics
     * @return mixed
     */
    private function unmapTeamsStatistics($items) {
        $items = is_string($items) ? json_decode($items, true) : $items;

        $result = array();

        foreach ($items as $row)
        {
            foreach ($row as $key => $value)
            {
            	if(strstr($key, "statistic_") !== false && $value != "") {
                    $statistic_id = (int)str_replace("statistic_", "", $key);
                    $result[] = ["team_id" => $row["team_id"], "statistic_id" => $statistic_id, "value" => $value];
                }
            }

        }

        return $result;
    }

    /**
     * Method to invertTeam in the form data.
     *
     * @param   array  $data  The form data.
     *
     * @return  boolean  True on success, False on error.
     *
     * @since   12.2
     */
	public function invertTeams($event_id)
	{
        return $this->action($event_id, 'invertTeams');
    }

    /**
     * Method to invertTeam in the form data.
     *
     * @param   array  $data  The form data.
     *
     * @return  array  True on success, False on error.
     *
     * @since   12.2
     */
	public function saveMatches($matches)
	{
        $unsaved = array();
        $table      = $this->getTable();
        foreach ($matches as $match)
        {

            $table->reset();
            $table->load($match["id"]);

            $data = array_merge($table->getProperties(true), $match);

            // Bind the data.
            if (!$table->bind($data))
                $unsaved[$match["id"]] = $table->getError();

            // Check the data.
            if (!$table->check())
                $unsaved[$match["id"]] = $table->getError();

            // Store the data.
            if (!$table->store())
                $unsaved[$match["id"]] = $table->getError();
        }

        // Clean the cache.
        $this->cleanCache();

        return $unsaved;

    }

}