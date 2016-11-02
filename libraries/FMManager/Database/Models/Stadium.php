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
class Stadium extends Model {

    /**
     * Main Table.
     * @var string
     */
    protected $table = "fm_stadiums";

    /**
     * Get the name.
     * @return string
     */
    public function getNameAndCityAttribute()
    {
        return $this->name.(($this->city) ? ", ".$this->city : "");
    }

    /**
     * Get the name.
     * @return string
     */
    public function getNameAndAddressAttribute()
    {
        return $this->name.(($this->city) ? ", ".$this->address." ".$this->postal_code." ".$this->city : "");
    }

    /**
     * Google Map Link
     * @return string
     */
    public function getGoogleMapAttribute() {
        return \FootManager\Helpers\Google::mapLink($this->attributes);
    }

    /**
     * Get the ground.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ground()
    {
        return $this->belongsTo(Ground::class);
    }

    /**
     * Get the ground.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeJoinGround($query)
    {
        return $query->leftJoin("fm_grounds", "fm_stadiums.ground_id", "=", "fm_grounds.id")->select("fm_stadiums.*");
    }

}

?>