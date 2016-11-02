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
abstract class Event extends Model implements \FootManager\Calendar\ICalendar {

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('orderByDate', function(\Illuminate\Database\Eloquent\Builder $builder) {
            $builder->orderBy("date");
        });
    }

    /**
     * Get the name.
     * @return string
     */
    public function getDateAttribute()
    {
        if(\FootManager\Utilities\DateHelper::isValid($this->attributes['date'])) return new \JDate($this->attributes['date']);
        return new \JDate();
    }

    /**
     * Get the name.
     * @return string
     */
    public function getTimeAttribute()
    {
        if(\FootManager\Utilities\DateHelper::isValid($this->attributes['time'])) return new \JDate($this->attributes['time']);
        return new \JDate();
    }

    /**
     * Get the name.
     * @return string
     */
    public function getDatetimeAttribute()
    {
        return new \JDate($this->date->format("y-m-d").' '.$this->time->format("G:i:s"));
    }

    /**
     * Get the type.
     * @return string
     */
    public abstract function getTypeAttribute();

    /**
     * Get the type.
     * @return string
     */
    public abstract function getCategoryAttribute();

    /**
     * Get the type.
     * @return string
     */
    public abstract function isMyEvent();

    /**
     * @return \FootManager\Calendar\Event
     */
    public abstract function toCalendar();

}

?>