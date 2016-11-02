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
class Team extends Model {

    /**
     * Main Table.
     * @var string
     */
    protected $table = "fm_teams";

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('category', function(\Illuminate\Database\Eloquent\Builder $builder) {
            $builder->with(["category", "club"]);
        });
    }

    /**
     * Get the name.
     * @return string
     */
    public function getNameAttribute()
    {
        switch ($this->category->in_team_name)
        {
        	case 1:
                return $this->category->label.' - '.$this->small_name;

            case 2:
                return $this->small_name.' - '.$this->category->label;

            default:
                return $this->small_name;
        }
    }

    /**
     * Get the small name.
     * @return string
     */
    public function getSmallNameAttribute()
    {
        return $this->club->small_name.(($this->suffix !== "") ? (' '.$this->suffix) : "");
    }

    /**
     * Get the small name.
     * @return string
     */
    public function getCategoryNameAttribute()
    {
        return $this->category->label.(($this->suffix !== "") ? (' '.$this->suffix) : "");
    }

    /**
     * Get the abbreviation.
     * @return string
     */
    public function getAbbreviationAttribute()
    {
        return $this->club->abbreviation.(($this->suffix !== "") ? (' '.$this->suffix) : "");
    }

    /**
     * Get the abbreviation.
     * @return string
     */
    public function getLogoAttribute()
    {
        return $this->club->logo;
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
     * Get the club.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    /**
     * Get the stadium.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stadium()
    {
        return $this->belongsTo(Stadium::class);
    }

    /**
     * Get the stadium.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rosters()
    {
        return $this->hasMany(Roster::class);
    }

    /**
     * Get the competitions.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function competitions()
    {
        return $this->belongsToMany(Competition::class, "fm_competition_teams")->withPivot(["penalty"]);
    }

    /**
     * Get the competitions.
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function matchdays()
    {
        return $this->hasManyThrough(Matchday::class, Competition::class);
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeJoinCategory($query)
    {
        return $query->join("fm_categories", "fm_teams.category_id", "=", "fm_categories.id")->select($this->getTable().".*");
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeJoinClub($query)
    {
        return $query->join("fm_clubs", "fm_teams.club_id", "=", "fm_clubs.id")->select($this->getTable().".*");
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrderByCategory($query)
    {
        return $query->joinCategory()->joinClub()->orderBy("fm_categories.ordering")->orderBy("fm_clubs.small_name")->orderBy("fm_teams.suffix");
    }

}

?>