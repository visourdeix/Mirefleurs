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
class FmmanagerTableTraining extends FMManager\Table\Event
{

    function __construct(&$db)
    {
        parent::__construct(FMManager\Database\Models\Training::class, $db);

        $this->addNotEmptyFields("start_time", "stadium_id", "end_time");
        $this->addColumnReference("rosters", FMManager\Database\Models\RosterTrainings::class);
    }

}
?>