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
class Tournament extends Model {

    /**
     * Main Table.
     * @var string
     */
    protected $table = "fm_tournaments";

    /**
     * Get the category.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the type.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(TournamentType::class);
    }

    /**
     * Get the competitions.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function competitions()
    {
        return $this->hasMany(Competition::class);
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeJoinTournamentType($query)
    {
        return $query->join("fm_tournament_types", "fm_tournaments.type_id", "=", "fm_tournament_types.id")->select($this->getTable().".*");
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeJoinCategory($query)
    {
        return $query->join("fm_categories", "fm_tournaments.category_id", "=", "fm_categories.id")->select($this->getTable().".*");
    }

}

?>