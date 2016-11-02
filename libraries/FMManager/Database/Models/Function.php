<?php
/**
 * @package      FMManager
 * @subpackage   Models
 * @author       St�phane ANDRE
 * @copyright    Copyright (C) 2015 St�phane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FMManager\Database\Models;

defined('JPATH_PLATFORM') or die;

use FootManager\Database\Models;

/**
 * This class contains common methods and properties for a database item
 *
 * @package      FMManager
 * @subpackage   Models
 */
class _Function extends Models\ByOrdering {

    /**
     * Main Table.
     * @var string
     */
    protected $table = "fm_functions";

}

?>