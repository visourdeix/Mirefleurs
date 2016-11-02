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
class FmmanagerModelMatchday extends \FMManager\Model\Backend\Event
{
    /**
     * Auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @return  void
     *
     * @since   1.6
     */
	protected function populateState()
	{
		$app = JFactory::getApplication('administrator');

		$competition = $app->getUserState(FM_MANAGER_COMPONENT.'.edit.matchday.competition');

		if ($app->input->getInt('competition', 0))
		{
			$competition = $app->input->getInt('competition', 0);
		}

		$this->setState('matchday.competition', $competition);

        parent::populateState();
	}

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

            if (empty($this->_item->id)) $this->_item->competition_id = $this->getState('matchday.competition');

            $this->_item->competition = FMManager\Database\Models\Competition::find($this->_item->competition_id);

            if($this->_item->id) {

                $this->_item->matches = array_map(function($obj) {
                    if($obj["time"] && $obj["time"] instanceof JDate) $obj["time"] = $obj["time"]->format("G:i:s");
                    if($obj["date"] && $obj["date"] instanceof JDate) $obj["date"] = $obj["date"]->format("Y-m-d");
                    return $obj;
                }, $this->_item->matches);

                $statistics = FMManager\Database\Models\Statistic::where("by_matchday", "=", 1)->get();

                $this->_item->teamsStatistics = $this->mapTeamsStatistics($this->_item->teamsStatistics, $statistics);
                $this->_item->playersStatistics = $this->mapPlayersStatistics($this->_item->playersStatistics, $statistics);

            } else {
                $this->_item->time = $this->_item->competition->default_time;
                $this->_item->state = \FMManager\Constants::NOT_PLAYED;
                $this->_item->matches = array();
            }
        }

        return $this->_item;
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
            $matchdays = \FMManager\Database\Models\Matchday::get(["name"])->implode(",");
            $form->setFieldAttribute("name", "source", $matchdays);

            $statistics = $competition->statistics;
            $players_statistics_allowed = $statistics->filter(function($obj) { return $obj->by_matchday == 1 && $obj->by_player == 1 && $obj->is_event == 0;});
            $teams_statistics_allowed = $statistics->filter(function($obj) { return $obj->by_matchday == 1 && $obj->by_team == 1 && $obj->is_event == 0;});

            $teams_id = $competition->competitionTeams->getColumn("team_id");
            $form->setFieldAttribute("team1_id", "allowed_options", $teams_id->implode(","), "matchesToAdd_list");
            $form->setFieldAttribute("team2_id", "allowed_options", $teams_id->implode(","), "matchesToAdd_list");
            $form->setFieldAttribute("date", "default", $data->date, "matchesToAdd_list");

            if ($competition->tournament->type->by_match) {
                $form->removeField('time');
                $form->removeField('stadium_id');
                $form->setFieldAttribute("time", "default", $competition->default_time, "matchesToAdd_list");
            } else {
                $form->removeField('date', 'matchesToAdd_list');
                $form->removeField('stadium_id', 'matchesToAdd_list');
                $form->setFieldAttribute("time", "default", $data->time, "matchesToAdd_list");
            }

            // Players Stats
            if (count($players_statistics_allowed)) {
                $players_id = FMManager\Database\Models\RosterPlayers::whereHas("roster", function($query) use($competition, $teams_id) {
                    $query->where("season_id", "=", $competition->season_id)
                        ->where(function($query) use($teams_id) {
                            $query->whereIn("team_id", $teams_id)
                                ->orWhereIn("relation_team_id", $teams_id);
                    });
                })->get()->getColumn("person_id")->toArray();
                $players_id = array_unique(array_merge($players_id, array_keys((array)$data->playersStatistics)));
                $elements = array();
                foreach ($players_statistics_allowed as $stat) {
                    $elements[] = new SimpleXMLElement('<field name="statistic_' . $stat->id . '"
														type="fmtouchspin"
                                                        max="1000"
														label="' . $stat->abbreviation . '"
														description="' . $stat->label . '" default="" />');
                }

                $form->setFieldAttribute("playersStatistics", "persons", implode(",",$players_id));

                $form->setFields($elements, 'playersStatistics_list');
            } else {
                $form->removeField('playersStatistics');
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

                $form->setFieldAttribute("teamsStatistics", "teams", $teams_id->implode(","));

                $form->setFields($elements, 'teamsStatistics_list');
            } else {
                $form->removeField('teamsStatistics');
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

        // PLayers Statistics
        if(isset($data["playersStatistics"])) {
            $data["playersStatistics"] = $this->unmapPlayersStatistics($data["playersStatistics"]);
        }

        // Team Statistics
        if(isset($data["teamsStatistics"])) {
            $data["teamsStatistics"] = $this->unmapTeamsStatistics($data["teamsStatistics"]);
        }

        return parent::save($data);
    }

    /**
     * Map Players Statistics property.
     * @param mixed $items
     * @param mixed $statistics
     * @return mixed
     */
    private function unmapPlayersStatistics($items) {
        return $this->unmapPersonStatistics($items);
    }

    /**
     * Map Staff statistics property.
     * @param mixed $items
     * @param mixed $statistics
     * @return mixed
     */
    private function unmapStaffStatistics($items) {
        return $this->unmapPersonStatistics($items);
    }

    /**
     * Map Statistics property.
     * @param mixed $items
     * @param mixed $statistics
     * @return mixed
     */
    private function unmapPersonStatistics($items) {
        $items = is_string($items) ? json_decode($items, true) : $items;

        $result = array();

        foreach ($items as $row)
        {
            foreach ($row as $key => $value)
            {
            	if(strstr($key, "statistic_") !== false && $value != "") {
                    $statistic_id = (int)str_replace("statistic_", "", $key);
                    $result[] = ["person_id" => $row["person_id"], "statistic_id" =>$statistic_id, "value" => $value];
                }
            }

        }

        return $result;
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
     * Method to add several matchdays.
     *
     * @param   array    $pks    The ids of the items to toggle.
     * @param   integer  $value  The value to toggle to.
     *
     * @return  array  True on success.
     */
	public function addmultiple($data, $competition, $invert_teams)
	{
        $inserted = 0;
        $row = 0;
        $errors = array();
        foreach ($data as $matchday)
        {
            $row += 1;

            $table = $this->getTable();
            $table->reset();

            $table->competition_id = $competition;
            if (!$table->bind($matchday))
            {
                $errors[$row] = $matchday["name"].' - '.$table->getError();
                continue;
            }

            if (!$table->check())
            {
                $errors[$row] = $matchday["name"].' - '.$table->getError();
                continue;
            }

            if($matchday["matchday_copy"]) {
                if (!$table->importMatches($matchday["matchday_copy"], $invert_teams))
                {
                    $errors[$row] = $matchday["name"].' - '.$table->getError();
                    continue;
                }
            }

            if (!$table->store())
            {
                $errors[$row] = $matchday["name"].' - '.$table->getError();
                continue;
            }
            $inserted += 1;
        }

		$this->cleanCache();

		return $errors;
	}

}