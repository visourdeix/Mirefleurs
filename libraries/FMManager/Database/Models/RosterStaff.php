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

use FootManager\Database\Eloquent\Model;

/**
 * This class contains common methods and properties for a database item
 *
 * @package      FMManager
 * @subpackage   Models
 */
class RosterStaff extends Model {

    /**
     * Main Table.
     * @var string
     */
    protected $table = "fm_roster_staff";

    /**
     * Get the person.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    /**
     * Get the roster.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function roster()
    {
        return $this->belongsTo(Roster::class);
    }

    /**
     * Get the function.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function _function()
    {
        return $this->belongsTo(_Function::class, "function_id");
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrderByFunction($query)
    {
        return $query->leftJoin("fm_functions", "fm_roster_staff.function_id", "=", "fm_functions.id")->orderBy( "fm_functions.ordering")->select("fm_roster_staff.*");
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrderByName($query)
    {
        return $query->join("fm_persons", "fm_roster_staff.person_id", "=", "fm_persons.id")->orderBy( "fm_persons.last_name")->orderBy( "fm_persons.first_name")->select("fm_roster_staff.*");
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrderByTeam($query)
    {
        return $query->join("fm_rosters", "fm_roster_staff.roster_id", "=", "fm_rosters.id")
                     ->join("fm_teams", "fm_rosters.team_id", "=", "fm_teams.id")
                     ->join("fm_categories", "fm_teams.category_id", "=", "fm_categories.id")
                     ->orderBy("fm_categories.ordering")
                     ->orderBy("fm_teams.suffix")
                     ->select("fm_roster_staff.*");
    }
}

?>