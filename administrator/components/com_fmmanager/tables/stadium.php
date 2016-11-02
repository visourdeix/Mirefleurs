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
class FmmanagerTableStadium extends \FootManager\Table\Table
{

    function __construct(&$db)
    {
        parent::__construct(FMManager\Database\Models\Stadium::class ,$db);

        $this->addNotEmptyFields("name", "ground_id");

        $this->addReferenceIn(FMManager\Database\Models\Callup::class);
        $this->addReferenceIn(FMManager\Database\Models\Matchday::class);
        $this->addReferenceIn(FMManager\Database\Models\Match::class);
        $this->addReferenceIn(FMManager\Database\Models\Team::class);
        $this->addReferenceIn(FMManager\Database\Models\Training::class);

    }

}
?>