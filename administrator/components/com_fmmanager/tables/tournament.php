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
class FmmanagerTableTournament extends \FootManager\Table\Table
{

    function __construct(&$db)
    {
        parent::__construct(FMManager\Database\Models\Tournament::class ,$db);

        $this->addNotEmptyFields("name", "small_name");

        $this->addReferenceIn(FMManager\Database\Models\Competition::class);
    }

}
?>