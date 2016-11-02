<?php
/**
 * @package     Fmmanager
 * @subpackage  Positions
 *
 * @copyright   Copyright (C) 2015 STéphane ANDRE. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

jimport('joomla.database.table');

/**
 * Positions Table.
 *
 */
class FmmanagerTableStatistic extends FMManager\Table\Data
{

    function __construct(&$db)
    {
        parent::__construct(FMManager\Database\Models\Statistic::class ,$db);

        $this->addNotEmptyFields("abbreviation");

        $this->addReferenceIn(FMManager\Database\Models\CompetitionStatistics::class);
        $this->addReferenceIn(FMManager\Database\Models\MatchdayPlayerStatistics::class);
        $this->addReferenceIn(FMManager\Database\Models\MatchdayTeamStatistics::class);
        $this->addReferenceIn(FMManager\Database\Models\MatchPlayerStatistics::class);
        $this->addReferenceIn(FMManager\Database\Models\MatchTeamStatistics::class);
        $this->addReferenceIn(FMManager\Database\Models\MatchStaffStatistics::class);

    }
}
?>