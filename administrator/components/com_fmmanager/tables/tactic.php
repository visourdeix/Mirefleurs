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
class FmmanagerTableTactic extends FMManager\Table\Data
{
    function __construct(&$db)
    {
        parent::__construct(FMManager\Database\Models\Tactic::class ,$db);

        $this->_unique_fields = [];

        $this->addReferenceIn(FMManager\Database\Models\Match::class, "tactic1_id");
        $this->addReferenceIn(FMManager\Database\Models\Match::class, "tactic2_id");

        $this->addReference("tacticPositions", FMManager\Database\Models\TacticPositions::class, function($item) { return !empty($item["row"]) && !empty($item["column"]);});

    }
}
?>