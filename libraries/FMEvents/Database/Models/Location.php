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
class Location extends Model {

    protected $table = "fmevents_locations";

    /**
     * Google Map Link
     * @return string
     */
    public function getGoogleMapAttribute() {
        return \FootManager\Helpers\Google::mapLink($this->attributes);
    }

    /**
     * Get the name.
     * @return string
     */
    public function getNameAndCityAttribute()
    {
        return $this->name.(($this->city) ? ", ".$this->city : "");
    }

    /**
     * Get the events of the location.
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    /**
     * Address and city.
     * @return string
     */
    public function address_and_city() {
        return $this->address.", ".$this->city;
    }

}

?>