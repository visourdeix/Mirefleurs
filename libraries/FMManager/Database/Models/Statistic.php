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
class Statistic extends Models\ByOrdering {

    /**
     * Main Table.
     * @var string
     */
    protected $table = "fm_statistics";

    /**
     * Get the statistics.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function competitions()
    {
        return $this->belongsToMany(Competition::class, "fm_competition_statistics");
    }

    public function scopeIsAllowed($query, $competitions) {
        return $query->whereHas("competitions", function($query) use($competitions) {
            $query->whereIn("competition_id", $competitions);
        });
    }

}

?>