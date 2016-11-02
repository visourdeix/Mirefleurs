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
class FmmanagerTableMatchday extends FMManager\Table\Event
{

    public $matchesToAdd = array();

    /**
     * Object constructor to set table and key fields.  In most cases this will
     * be overridden by child classes to explicitly set the table and key fields
     * for a particular database table.
     *
     * @param   string           $table  Name of the table to model.
     * @param   mixed            $key    Name of the primary key field in the table or array of field names that compose the primary key.
     * @param   JDatabaseDriver  $db     JDatabaseDriver object.
     *
     * @since   11.1
     */
    function __construct(&$db)
    {
        parent::__construct(FMManager\Database\Models\Matchday::class, $db);

        $this->addNotEmptyFields("competition_id", "name");

        $this->addReference("playersStatistics", FMManager\Database\Models\MatchdayPlayerStatistics::class);
        $this->addReference("teamsStatistics", FMManager\Database\Models\MatchdayTeamStatistics::class);
        $this->addReference("matches", FMManager\Database\Models\Match::class, function($item) { return !empty($item["team1_id"]) && !empty($item["team2_id"]);});

    }

    /**
     * Method to load referenced data.
     * @return array
     */
    public function loadReference($property, $modelName, $foreignKey, $column = false, $id = null) {

        switch ($property)
        {
            case "matches" :
                return FMManager\Database\Models\Match::withoutGlobalScopes()->where("matchday_id", "=", $id)->orderBy("date")->orderBy("time")->get()->toArray();

        	default:
                return parent::loadReference($property, $modelName, $foreignKey, $column, $id);
        }

    }

    /**
     * Method to bind referenced data.
     * @return bool
     */
    public function bindReferences($array = array()) {

        $this->setPropertyFromArray($array, "matchesToAdd", function($item) { return !empty($item["team1_id"]) && !empty($item["team2_id"]);});
        return parent::bindReferences($array);
    }

    /**
     * Stores items related to this.
     * @param string $property
     * @param string $referenceModel
     */
    protected function storeReference($property, $modelName, $foreignKey, $column = false) {
        switch ($property)
        {
            case "matches" :
                $array = array();
                if(isset($this->matches)) $array = $this->matches;
                if(isset($this->matchesToAdd)) $array = array_merge($array, $this->matchesToAdd);
                return $this->storeComplexReferences($array, "Match", "matchday_id", 'FmmanagerTable');

        	default:
                return parent::storeReference($property, $modelName, $foreignKey, $column);
        }
    }

    /**
     * Method to load referenced data.
     * @return boolean
     */
    protected function deleteReference($property, $modelName, $foreignKey, $id = null) {
        switch ($property)
        {
            case "matches" :
                return $this->deleteComplexReferences("Match", "matchday_id", 'FmmanagerTable', $id);

        	default:
                return parent::deleteReference($property, $modelName, $foreignKey, $id);
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
        $competition = FMManager\Database\Models\Competition::find($this->competition_id);
		if (!$competition->tournament->type->by_match && $this->date != '' && $this->time == '')
		{
			$this->setError(JText::_('COM_FMMANAGER_ERROR_EMPTY_TIME'));

			return false;
		}

        if(isset($this->matchesToAdd)) {
            foreach ($this->matchesToAdd as $match)
            {
                $table = JTable::getInstance("Match", "FmmanagerTable");
                $table->reset();
                $table->bind($match);
                if(!$table->check()) {
                    $this->setError($table->getError());
                    return false;
                }
            }
        }

        if(isset($this->matches)) {
            foreach ($this->matches as $match)
            {
                $table = JTable::getInstance("Match", "FmmanagerTable");
                $table->reset();
                $table->bind($match);
                if(!$table->check()) {
                    $this->setError($table->getError());
                    return false;
                }
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
        $competition = FMManager\Database\Models\Competition::find($this->competition_id);
        if($competition && $competition->tournament->type->by_match) {
            $this->time = "00:00:00";
            $this->stadium_id = 0;
        }

        return parent::store($updateNulls);
	}

    public function importMatches($matchday_id, $invertTeams = false, $resetMatchesBefore = true) {
        if($resetMatchesBefore) $this->matches = array();

        $query = $this->_db->getQuery(true);

        $query->clear()
             ->select("m.*, 0 as id, 0 as state, 0 as score1, 0 as score2, 0 as penalties1, 0 as penalties2, 0 as withdraw1, 0 as withdraw2, 0 as bonus1, 0 as bonus2, 0 as call_up_id, '' as referee, 0 as tactic1_id, 0 as tactic2_id, '' as summary")
             ->from($this->_db->quoteName('#__fm_matches').' m')
             ->where($this->_db->quoteName('matchday_id') . ' = ' . (int) $matchday_id)
             ->order($this->_db->quoteName('date'). ' ASC,'.$this->_db->quoteName('time').' ASC');
        $this->_db->setQuery($query);
        $this->matchesToAdd = $this->_db->loadAssocList();

        if($invertTeams) {
            $competition = FMManager\Database\Models\Matchday::find($matchday_id)->competition;
            foreach ($this->matchesToAdd as $key => $match)
            {
        	    $team1 = $match["team1_id"];
                $this->matchesToAdd[$key]["team1_id"] = $match["team2_id"];
                $this->matchesToAdd[$key]["team2_id"] = $team1;

                if($competition->tournament->type->by_match) {
                    if(!$match->neutral_stadium) {
                        $query = $this->_db->getQuery(true);

                        $query->clear()
                                ->select("stadium_id")
                                ->from($this->_db->quoteName('#__fm_teams'))
                                ->where(' id = '.(int)$this->matchesToAdd[$key]["team1_id"]);
                        $this->_db->setQuery($query);
                        $this->matchesToAdd[$key]["stadium_id"] = $this->_db->loadResult();
                    }
                    $this->matchesToAdd[$key]["date"] = $this->date;
                } else {
                    $this->matchesToAdd[$key]["stadium_id"] = 0;
                    $this->matchesToAdd[$key]["date"] = '0000-00-00';
                }
            }
        }

        return true;

    }

}
?>