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
class Training extends Event {

    /**
     * Main Table.
     * @var string
     */
    protected $table = "fm_trainings";

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('orderByTime', function(\Illuminate\Database\Eloquent\Builder $builder) {
            $builder->orderBy("start_time");
        });
    }

    /**
     * Get the type.
     * @return string
     */
    public function getTypeAttribute() {
        return "training";
    }

    /**
     * Get the name.
     * @return string
     */
    public function getTimeAttribute()
    {
        if(\FootManager\Utilities\DateHelper::isValid($this->attributes['start_time'])) return new \JDate($this->attributes['start_time']);
        return new \JDate();
    }

    /**
     * Get the name.
     * @return string
     */
    public function getEndTimeAttribute()
    {
        if(\FootManager\Utilities\DateHelper::isValid($this->attributes['end_time'])) return new \JDate($this->attributes['end_time']);
        return new \JDate();
    }

    /**
     * Get the name.
     * @return string
     */
    public function getEndDateAttribute()
    {
        return new \JDate($this->attributes['date'].' '.$this->attributes['end_time']);
    }

    /**
     * Get the name.
     * @return string
     */
    public function getCategoryAttribute()
    {
        return $this->rosters->first()->team->category;
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
     * Get the rosters.
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function rosters()
    {
        return $this->belongsToMany(Roster::class, "fm_roster_trainings");
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeJoinStadium($query)
    {
        return $query->join("fm_stadiums", "fm_trainings.stadium_id", "=", "fm_stadiums.id")->select($this->getTable().".*");
    }

    /**
     * Scope a query to only include specific team.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBetweenDates($query, $startdatetime = null, $enddatetime = null) {

        if(!empty($startdatetime)) {
            if(is_string($startdatetime)) $startdatetime = new \JDate($startdatetime);
            $start_date = $startdatetime->format("Y-m-d");
            $start_time = $startdatetime->format("G:i:s");

            $query = $query->where(function($query) use($start_date, $start_time) {
                        $query->where($this->getTable().".date", ">", $start_date)
                            ->orWhere(function($query) use($start_date, $start_time) {
                                $query->where($this->getTable().".date", "=", $start_date)
                                    ->where($this->getTable().".start_time", ">", $start_time);
                            });
                    });
        }
        if(!empty($enddatetime)) {
            if(is_string($enddatetime)) $enddatetime = new \JDate($enddatetime);
            $end_date = $enddatetime->format("Y-m-d");
            $end_time = $enddatetime->format("G:i:s");

            $query = $query->where(function($query) use($end_date, $end_time) {
                $query->where($this->getTable().".date", "<", $end_date)
                    ->orWhere(function($query) use($end_date, $end_time) {
                        $query->where($this->getTable().".date", "=", $end_date)
                            ->where($this->getTable().".end_time", "<", $end_time);
                    });
            });
        }

        return $query;
    }

    /**
     * Get the type.
     * @return string
     */
    public function isMyEvent() {
        return true;
    }

    /**
     * @return \FootManager\Calendar\Event
     */
    public function toCalendar() {
        return new \FMManager\Calendar\Training($this);
    }

}

?>