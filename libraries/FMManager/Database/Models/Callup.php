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
class Callup extends Model {

    /**
     * Main Table.
     * @var string
     */
    protected $table = "fm_call_up";

    /**
     * Get the default foreign key name for the model.
     *
     * @return string
     */
    public function getForeignKey()
    {
        return "call_up_id";
    }

    /**
     * Get the name.
     * @return string
     */
    public function getDateAttribute()
    {
        if(\FootManager\Utilities\DateHelper::isValid($this->attributes['date'])) return new \JDate($this->attributes['date']);
        return null;
    }

    /**
     * Get the name.
     * @return string
     */
    public function getTimeAttribute()
    {
        if(\FootManager\Utilities\DateHelper::isValid($this->attributes['time'])) return new \JDate($this->attributes['time']);
        return null;
    }

    /**
     * Get the name.
     * @return string
     */
    public function getDatetimeAttribute()
    {
        if(\FootManager\Utilities\DateHelper::isValid($this->attributes['date'].' '.$this->attributes['time'])) return new \JDate($this->attributes['date'].' '.$this->attributes['time']);
        return null;
    }

    /**
     * Get the statistics.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function persons()
    {
        return $this->belongsToMany(Person::class, "fm_call_up_persons");
    }

    /**
     * Get the statistics.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function contacts()
    {
        return $this->belongsToMany(Person::class, "fm_call_up_contacts");
    }

    /**
     * Get the statistics.
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function stadium()
    {
        return $this->belongsTo(Stadium::class);
    }

}

?>