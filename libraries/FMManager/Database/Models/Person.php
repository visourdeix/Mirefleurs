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
class Person extends Model {

    /**
     * Main Table.
     * @var string
     */
    protected $table = "fm_persons";

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function(\Illuminate\Database\Eloquent\Builder $builder) {
            $builder->orderBy("last_name")->orderBy("first_name");
        });
    }

    /**
     * Get the name.
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->attributes["first_name"].' '.$this->last_name;
    }

    /**
     * Get the inverse name.
     * @return string
     */
    public function getInverseNameAttribute()
    {
        return $this->last_name.' '.$this->attributes["first_name"];
    }

    /**
     * Get the name.
     * @return string
     */
    public function getLastNameAttribute()
    {
        return strtoupper($this->attributes["last_name"]);
    }

    /**
     * Get the name.
     * @return string
     */
    public function getBirthdateAttribute()
    {
        if(\FootManager\Utilities\DateHelper::isValid($this->attributes['birthdate'])) return new \JDate($this->attributes['birthdate']);
        return null;
    }

    /**
     * Get the name.
     * @return string
     */
    public function getLicenseAttribute()
    {

        if($this->attributes['license'] && is_double((double)$this->attributes['license']))
            return  number_format($this->attributes['license'], 0, "", " ");
        else
            return $this->attributes['license'];
    }

    /**
     * Get the diploma.
     * @return string
     */
    public function getDiplomaAttribute()
    {
        return $this->diplomas->first();
    }

    /**
     * Get is Manager.
     * @return string
     */
    public function isManager()
    {
        $currentSeason = Season::current();
        return (count(SeasonManagers::where("season_id",$currentSeason->id)->where("person_id", "=", $this->id)->get()) > 0);
    }

    /**
     * Get is Manager.
     * @return string
     */
    public function isStaff()
    {
        $currentSeason = Season::current();
        return (count(RosterStaff::whereHas("roster", function($query) use($currentSeason) {
            $query->where("season_id", "=", $currentSeason->id);
        })->where("person_id", "=", $this->id)->get()) > 0);
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
     * Get the position.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    /**
     * Get the position.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get the diplomas.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function diplomas()
    {
        return $this->belongsToMany(Diploma::class, "fm_person_diplomas");
    }

    /**
     * Get the diplomas.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    /**
     * Get the rosters.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rosterStaff()
    {
        return $this->hasMany(RosterStaff::class);
    }

    /**
     * Get the rosters.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rosterPlayers()
    {
        return $this->hasMany(RosterPlayers::class);
    }

    /**
     * Get the rosters.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seasonManagers()
    {
        return $this->hasMany(SeasonManagers::class);
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeJoinCategory($query)
    {
        return $query->leftJoin("fm_categories", "fm_persons.category_id", "=", "fm_categories.id")->select("fm_persons.*");
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeJoinPosition($query)
    {
        return $query->leftJoin("fm_positions", "fm_persons.position_id", "=", "fm_positions.id")->select("fm_persons.*");
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrderByCategory($query)
    {
        return $query->joinCategory()->orderBy( "fm_categories.ordering")->select("fm_persons.*");
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrderByPosition($query)
    {
        return $query->joinPosition()->orderBy( "fm_positions.ordering")->select("fm_persons.*");
    }
}

?>