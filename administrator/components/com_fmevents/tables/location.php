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
class FmeventsTableLocation extends FootManager\Table\Table
{

    function __construct(&$db)
    {
        parent::__construct(FMEvents\Database\Models\Location::class ,$db);

        $this->addNotEmptyFields("name");

        $this->addReferenceIn(FMEvents\Database\Models\Event::class);

    }
}
?>