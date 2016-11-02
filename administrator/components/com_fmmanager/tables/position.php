<?php
/**
 * @package     Fmmanager
 * @subpackage  Positions
 *
 * @copyright   Copyright (C) 2015 ST�phane ANDRE. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

jimport('joomla.database.table');

/**
 * Positions Table.
 *
 */
class FmmanagerTablePosition extends FMManager\Table\Data
{

    function __construct(&$db)
    {
        parent::__construct(FMManager\Database\Models\Position::class ,$db);

        $this->addReferenceIn(FMManager\Database\Models\Person::class);
        $this->addReferenceIn(FMManager\Database\Models\RosterPlayers::class);
        $this->addReferenceIn(FMManager\Database\Models\MatchPlayers::class);

    }

}
?>