<?php
/**
 * @package     Fmmanager
 * @subpackage  Positions
 *
 * @copyright   Copyright (C) 2015 STéphane ANDRE. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\Registry\Registry;

/**
 * Positions Table.
 *
 */
class FmactivityTableItem extends FootManager\Table\Table
{

    function __construct(&$db)
    {
        parent::__construct(FMActivity\Database\Models\Item::class, $db);
    }

}
?>