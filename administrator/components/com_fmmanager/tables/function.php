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
class FmmanagerTableFunction extends FMManager\Table\Data
{

    function __construct(&$db)
    {
        parent::__construct(FMManager\Database\Models\_Function::class ,$db);

        $this->addReferenceIn(FMManager\Database\Models\RosterStaff::class, "function_id");
        $this->addReferenceIn(FMManager\Database\Models\SeasonManagers::class, "function_id");

    }
}
?>