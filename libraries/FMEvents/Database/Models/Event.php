<?php
/**
 * @package      FMEvents
 * @subpackage   Calendar
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FMEvents\Database\Models;

defined('JPATH_PLATFORM') or die;

use FootManager\Database\Eloquent\Model;

/**
 * This class contains common methods and properties for a database item
 *
 * @package      FMEvents
 * @subpackage   Calendar
 */
class Event extends Model implements \FootManager\Calendar\ICalendar {

    protected $table = "fmevents_events";

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('category', function(\Illuminate\Database\Eloquent\Builder $builder) {
            $builder->with(["category"]);
        });
    }

    /**
     * Get the name.
     * @return string
     */
    public function getColorAttribute()
    {
        return $this->category->params["color"];
    }

    /**
     * Get the name.
     * @return string
     */
    public function getStartDateAttribute()
    {
        if(\FootManager\Utilities\DateHelper::isValid($this->attributes['start_date'])) return new \JDate($this->attributes['start_date']);
        return new \JDate();
    }

    /**
     * Get the name.
     * @return string
     */
    public function getStartTimeAttribute()
    {
        if(\FootManager\Utilities\DateHelper::isValid($this->attributes['start_time'])) return new \JDate($this->attributes['start_time']);
        return new \JDate();
    }

    /**
     * Get the name.
     * @return string
     */
    public function getStartDateTimeAttribute()
    {
        if(\FootManager\Utilities\DateHelper::isValid($this->attributes['start_date'].' '.$this->attributes['start_time'])) return new \JDate($this->attributes['start_date'].' '.$this->attributes['start_time']);
        return null;
    }

    /**
     * Get the name.
     * @return string
     */
    public function getEndDateAttribute()
    {
        if(\FootManager\Utilities\DateHelper::isValid($this->attributes['end_date'])) return new \JDate($this->attributes['end_date']);
        return null;
    }

    /**
     * Get the name.
     * @return string
     */
    public function getEndTimeAttribute()
    {
        if(\FootManager\Utilities\DateHelper::isValid($this->attributes['end_time'])) return new \JDate($this->attributes['end_time']);
        return null;
    }

    /**
     * Get the name.
     * @return string
     */
    public function getEndDateTimeAttribute()
    {
        if(\FootManager\Utilities\DateHelper::isValid($this->attributes['end_date'].' '.$this->attributes['end_time'])) return new \JDate($this->attributes['end_date'].' '.$this->attributes['end_time']);
        return null;
    }

    /**
     * Get the location.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get the category.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(\FootManager\Database\Models\Category::class, "catid");
    }

    /**
     * Get the category.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function viewLevel()
    {
        return $this->belongsTo(\FootManager\Database\Models\ViewLevel::class, "access");
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
                        $query->where($this->getTable().".start_date", ">", $start_date)
                            ->orWhere(function($query) use($start_date, $start_time) {
                                $query->where($this->getTable().".start_date", "=", $start_date)
                                    ->where($this->getTable().".start_time", ">", $start_time);
                            });
                    });
        }
        if(!empty($enddatetime)) {
            if(is_string($enddatetime)) $enddatetime = new \JDate($enddatetime);
            $end_date = $enddatetime->format("Y-m-d");
            $end_time = $enddatetime->format("G:i:s");

            $query = $query->where(function($query) use($end_date, $end_time) {
                $query->where($this->getTable().".end_date", "<", $end_date)
                    ->orWhere(function($query) use($end_date, $end_time) {
                        $query->where($this->getTable().".end_date", "=", $end_date)
                            ->where($this->getTable().".end_time", "<", $end_time);
                    });
            });
        }

        return $query;
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeJoinCategory($query)
    {
        return $query->join("categories", "fmevents_events.catid", "=", "categories.id")->select($this->getTable().".*");
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeJoinViewLevel($query)
    {
        return $query->join("viewlevels", "fmevents_events.access", "=", "viewlevels.id")->select($this->getTable().".*");
    }

    /**
     *
     */
    public function toCalendar() {
        return new \FMEvents\Calendar\Event($this);
    }
}

?>