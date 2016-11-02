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
class SeasonManagers extends Model {

    /**
     * Main Table.
     * @var string
     */
    protected $table = "fm_season_managers";

    /**
     * Get the person.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    /**
     * Get the season.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function season()
    {
        return $this->belongsTo(Season::class);
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
        return $query->leftJoin("fm_functions", "fm_season_managers.function_id", "=", "fm_functions.id")->orderBy( "fm_functions.ordering")->select("fm_season_managers.*");
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrderByName($query)
    {
        return $query->join("fm_persons", "fm_season_managers.person_id", "=", "fm_persons.id")->orderBy( "fm_persons.last_name")->orderBy( "fm_persons.first_name")->select("fm_season_managers.*");
    }
}

?>