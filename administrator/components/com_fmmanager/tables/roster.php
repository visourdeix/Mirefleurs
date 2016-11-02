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
class FmmanagerTableRoster extends \FootManager\Table\Table
{

    function __construct(&$db)
    {
        parent::__construct(FMManager\Database\Models\Roster::class, $db);

        // Empty Fields
        $this->addNotEmptyFields("season_id", "team_id");

        // Unique Fields
        $this->addUniqueFields("season_id", "team_id");

        // References
        $this->addReference("players", FMManager\Database\Models\RosterPlayers::class, function($item) { return !empty($item["person_id"]) && !empty($item["category_id"]);});
        $this->addReference("staff", FMManager\Database\Models\RosterStaff::class, function($item) { return !empty($item["person_id"]) && !empty($item["function_id"]);});
        $this->addOnlyDeleteReference("trainings", FMManager\Database\Models\RosterTrainings::class);
    }

    /**
     * Method to load referenced data.
     * @return array
     */
    public function loadReference($property, $modelName, $foreignKey, $column = false, $id = null) {

        switch ($property)
        {
            case "players" :
                return FMManager\Database\Models\RosterPlayers::withoutGlobalScopes()->where("roster_id", "=", $id)->orderByPosition()->orderByName()->get()->toArray();

            case "staff" :
                return FMManager\Database\Models\RosterStaff::withoutGlobalScopes()->where("roster_id", "=", $id)->orderByFunction()->orderByName()->get()->toArray();

        	default:
                return parent::loadReference($property, $modelName, $foreignKey, $column, $id);
        }

    }

}
?>