<?php
/**
 * @package      FMManager
 * @subpackage   Models
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
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
class Season extends Models\ByOrdering {

    /**
     * Main Table.
     * @var string
     */
    protected $table = "fm_seasons";

    /**
     * Scope a query to only include specific team.
     *
     * @return Season
     */
    public static function current() {
        $now = date("Y-m-d");
        return self::where("start_date", "<=", $now)->where("end_date", ">=", $now)->first();
    }

    /**
     * Get the staff.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function managers()
    {
        return $this->hasMany(SeasonManagers::class);
    }

}

?>