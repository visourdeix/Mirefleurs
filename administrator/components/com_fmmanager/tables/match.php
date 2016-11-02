<?php
/**
 * @package     Fmmanager
 * @subpackage  Positions
 *
 * @copyright   Copyright (C) 2015 STéphane ANDRE. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Positions Table.
 *
 */
class FmmanagerTableMatch extends FMManager\Table\Event
{

    function __construct(&$db)
    {

        parent::__construct(FMManager\Database\Models\Match::class, $db);

        $this->addNotEmptyFields("matchday_id", "date", "time", "team1_id", "team2_id");

        $this->addReference("playersStatistics", FMManager\Database\Models\MatchPlayerStatistics::class, function($item) { return !empty($item["person_id"]) && !empty($item["statistic_id"]);});
        $this->addReference("staffStatistics", FMManager\Database\Models\MatchStaffStatistics::class, function($item) { return !empty($item["person_id"]) && !empty($item["statistic_id"]);});
        $this->addReference("teamsStatistics", FMManager\Database\Models\MatchTeamStatistics::class);
        $this->addReference("players", FMManager\Database\Models\MatchPlayers::class, function($item) { return isset($item["state"]) && isset($item["person_id"]) && $item["state"] != \FMManager\Constants::NOT_IN_MATCH && !empty($item["person_id"]);});
        $this->addReference("staff", FMManager\Database\Models\MatchStaff::class, function($item) { return !empty($item["person_id"]);});
        $this->addReference("substitutions", FMManager\Database\Models\MatchSubstitutions::class, function($item) { return !empty($item["playerOut_id"]) && !empty($item["playerIn_id"]) && $item["playerOut_id"] != $item["playerIn_id"];});
        $this->addReference("goals", FMManager\Database\Models\MatchGoals::class, function($item) { return !empty($item["striker_id"]) && $item["striker_id"] != $item["passer_id"];});
    }

    /**
     * Method to load referenced data.
     * @return array
     */
    public function loadReference($property, $modelName, $foreignKey, $column = false, $id = null) {

        switch ($property)
        {
            case "substitutions" :
                return FMManager\Database\Models\MatchSubstitutions::withoutGlobalScopes()->where("match_id", "=", $id)->orderBy("minute")->get()->toArray();

            case "goals" :
                return FMManager\Database\Models\MatchGoals::withoutGlobalScopes()->where("match_id", "=", $id)->orderBy("minute")->get()->toArray();

            case "staffStatistics" :
                return FMManager\Database\Models\MatchStaffStatistics::withoutGlobalScopes()->where("match_id", "=", $id)->orderBy("minute")->get()->toArray();

            case "playersStatistics" :
                return FMManager\Database\Models\MatchPlayerStatistics::withoutGlobalScopes()->where("match_id", "=", $id)->orderBy("minute")->get()->toArray();

            case "players" :
                return FMManager\Database\Models\MatchPlayers::withoutGlobalScopes()->where("match_id", "=", $id)->orderBy("number")->get()->toArray();

        	default:
                return parent::loadReference($property, $modelName, $foreignKey, $column, $id);
        }

    }

    /**
     * Overloaded check function
     *
     * @return  boolean  True on success, false on failure
     *
     * @see JTable::check
     * @since 1.5
     */
	public function check()
	{

        /** check for valid name */
		if (trim($this->team1_id) == trim($this->team2_id))
		{
			$this->setError(JText::_('COM_FMMANAGER_ERROR_SAME_TEAMS'));

			return false;
		}

        if(count(array_unique(FootManager\Utilities\ArrayHelper::getColumn($this->players1, "person_id"))) < count($this->players1)) {
            $this->setError(JText::_('COM_FMMANAGER_ERROR_DOUBLE_PERSON'));

			return false;
        }

        if(count(array_unique(FootManager\Utilities\ArrayHelper::getColumn($this->players2, "person_id"))) < count($this->players2)) {
            $this->setError(JText::_('COM_FMMANAGER_ERROR_DOUBLE_PERSON'));

			return false;
        }

        $players1_ids = FootManager\Utilities\ArrayHelper::getColumn($this->players1, "person_id");
        foreach ($this->substitutions1 as $substitution)
        {
        	if(!in_array($substitution["playerOut_id"], $players1_ids) || !in_array($substitution["playerIn_id"], $players1_ids)) {
                $this->setError(JText::_('COM_FMMANAGER_ERROR_SUBSTITUTION_PLAYER_NOT_IN_PLAYERS'));
                return false;
            }
        }

        $players2_ids = FootManager\Utilities\ArrayHelper::getColumn($this->players2, "person_id");
        foreach ($this->substitutions2 as $substitution)
        {
        	if(!in_array($substitution["playerOut_id"], $players2_ids) || !in_array($substitution["playerIn_id"], $players2_ids)) {
                $this->setError(JText::_('COM_FMMANAGER_ERROR_SUBSTITUTION_PLAYER_NOT_IN_PLAYERS'));
                return false;
            }
        }

		return parent::check();
	}

    /**
     * Method to store a row in the database from the JTable instance properties.
     * If a primary key value is set the row with that primary key value will be
     * updated with the instance property values.  If no primary key value is set
     * a new row will be inserted into the database with the properties from the
     * JTable instance.
     *
     * @param   boolean  $updateNulls  True to update fields even if they are null.
     *
     * @return  boolean  True on success.
     *
     * @link    http://docs.joomla.org/JTable/store
     * @since   11.1
     */
	public function store($updateNulls = false)
	{
        $matchday = FMManager\Database\Models\Matchday::find($this->matchday_id);
        if($matchday && !$matchday->competition->tournament->type->by_match) {
            $this->date = $matchday->date->format("Y-m-d");
            $this->stadium_id = $matchday->stadium_id;
            $this->neutral_stadium = 1;
        }

        return parent::store($updateNulls);
	}

    public function invertTeams() {

        $team1 = $this->team1_id;
        $this->team1_id = $this->team2_id;
        $this->team2_id = $team1;

        $tactic1 = $this->tactic1_id;
        $this->tactic1_id = $this->tactic2_id;
        $this->tactic2_id = $tactic1;

        $properties = ["score", "penalties", "withdraw", "bonus"];
        foreach ($properties as $property)
        {
        	$prop1 = $property."1";
            $prop2 = $property."2";

            $temp = $this->$prop1;
            $this->$prop1 = $this->$prop2;
            $this->$prop2 = $temp;
        }

        $properties = ["players", "staff", "playersStatistics", "staffStatistics", "goals", "substitutions"];
        foreach ($properties as $property)
        {
        	$prop1 = $property."1";
            $prop2 = $property."2";
            $team1 = $this->team1_id;
            $team2 = $this->team2_id;

            $array1 = array_map(function($obj) use($team1) {
                $obj["team_id"] = $team1;
                return $obj;
            }, $this->$prop1);
            $array2 = array_map(function($obj) use($team2) {
                $obj["team_id"] = $team2;
                return $obj;
            }, $this->$prop2);
            $this->$property = array_merge($array1, $array2);
        }

        $this->updateStadium();

        return true;

    }

    public function updateStadium() {
        $matchday = FMManager\Database\Models\Matchday::find($this->matchday_id);
        if($matchday && $matchday->competition->tournament->type->by_match) {
            if(!$this->neutral_stadium) {
                $query = $this->_db->getQuery(true);

                $query->clear()
                        ->select("stadium_id")
                        ->from($this->_db->quoteName('#__fm_teams'))
                        ->where(' id = '.(int)$this->team1_id);
                $this->_db->setQuery($query);
                $this->stadium_id = $this->_db->loadResult();
            }
        } else {
            $this->stadium_id = $matchday->stadium_id;
            $this->neutral_stadium = 1;
        }
    }

    /**
     * Get a property.
     * @param mixed $name
     * @return mixed
     */
    public function __get($name) {

        foreach ($this->_references as $key => $reference)
        {
            if($name == $key."1" || $name == $key."2") {
                $team = ($name == $key."1") ? $this->team1_id : $this->team2_id;

                if(isset($this->$key))
                    return array_filter($this->$key, function($obj) use($team) { return $obj["team_id"] == $team; });
                else
                    return array();
            }
            if($name == $key && !isset($this->$key)) return array();
        }

        return $this->$name;
    }

}
?>