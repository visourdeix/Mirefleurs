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
class FmmanagerTableCompetition extends \FootManager\Table\Table
{
    function __construct(&$db)
    {
        parent::__construct(FMManager\Database\Models\Competition::class ,$db);

        // Empty Fields
        $this->addNotEmptyFields("tournament_id", "season_id");

        // References
        $this->addReference("competitionTeams", FMManager\Database\Models\CompetitionTeams::class, function($item) { return !empty($item["team_id"]);});
        $this->addColumnReference("statistics", FMManager\Database\Models\CompetitionStatistics::class);
        $this->addOnlyDeleteReference("matchdays", FMManager\Database\Models\Matchday::class);
    }

    /**
     * Method to load referenced data.
     * @return boolean
     */
    protected function deleteReference($property, $modelName, $foreignKey, $id = null) {
        switch ($property)
        {
            case "matchdays" :
                return $this->deleteComplexReferences("Matchday", "competition_id", "FmmanagerTable", $id);

        	default:
                return parent::deleteReference($property, $modelName, $foreignKey, $id);
        }
    }
}
?>