<?php
/**
 * @package      FMEvents
 * @subpackage   Calendar
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FootManager\Database\Models;

defined('JPATH_PLATFORM') or die;

use Illuminate\Database\Eloquent\Model;

/**
 * This class contains common methods and properties for a database item
 *
 * @package      FMEvents
 * @subpackage   Calendar
 */
class User extends \FootManager\Database\Eloquent\Model {

    protected $table = "users";

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

}

?>