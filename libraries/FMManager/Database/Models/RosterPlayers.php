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
class RosterPlayers extends Model {

    /**
     * Main Table.
     * @var string
     */
    protected $table = "fm_roster_players";

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
     * Get the position.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    /**
     * Get the category.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrderByPosition($query)
    {
        return $query->leftJoin("fm_positions", "fm_roster_players.position_id", "=", "fm_positions.id")->orderBy( "fm_positions.ordering")->select("fm_roster_players.*");
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrderByCategory($query)
    {
        return $query->leftJoin("fm_categories", "fm_roster_players.category_id", "=", "fm_categories.id")->orderBy( "fm_categories.ordering")->select("fm_roster_players.*");
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrderByName($query)
    {
        return $query->join("fm_persons", "fm_roster_players.person_id", "=", "fm_persons.id")->orderBy( "fm_persons.last_name")->orderBy( "fm_persons.first_name")->select("fm_roster_players.*");
    }

}

?>