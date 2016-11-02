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
class FmmanagerTableTeam extends \FootManager\Table\Table
{

    function __construct(&$db)
    {
        parent::__construct(FMManager\Database\Models\Team::class ,$db);

        $this->addNotEmptyFields("category_id", "club_id");
        $this->addUniqueFields("club_id", "category_id", "suffix");

        $this->addReferenceIn(FMManager\Database\Models\Match::class, "team1_id");
        $this->addReferenceIn(FMManager\Database\Models\Match::class, "team2_id");
        $this->addReferenceIn(FMManager\Database\Models\MatchPlayers::class);
        $this->addReferenceIn(FMManager\Database\Models\MatchPlayerStatistics::class);
        $this->addReferenceIn(FMManager\Database\Models\MatchStaff::class);
        $this->addReferenceIn(FMManager\Database\Models\MatchStaffStatistics::class);
        $this->addReferenceIn(FMManager\Database\Models\MatchSubstitutions::class);
        $this->addReferenceIn(FMManager\Database\Models\MatchTeamStatistics::class);
        $this->addReferenceIn(FMManager\Database\Models\Roster::class);
        $this->addReferenceIn(FMManager\Database\Models\Roster::class, "relation_team_id");
        $this->addReferenceIn(FMManager\Database\Models\MatchdayTeamStatistics::class);
        $this->addReferenceIn(FMManager\Database\Models\MatchGoals::class);

        $this->addOnlyDeleteReference("competitions", FMManager\Database\Models\CompetitionTeams::class);
    }

}
?>