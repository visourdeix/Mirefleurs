<?php
/**
 * @package      FMEvents
 * @subpackage   Calendar
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FMGallery\Database\Models;

defined('JPATH_PLATFORM') or die;

use FootManager\Database\Eloquent\Model;

/**
 * This class contains common methods and properties for a database item
 *
 * @package      FMEvents
 * @subpackage   Calendar
 */
class Photo extends Media {

    protected $table = "fmgallery_photos";

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('orderByDate', function(\Illuminate\Database\Eloquent\Builder $builder) {
            $builder->orderBy("date", "DESC");
        });
    }

    /**
     * Scope a query to only include specific team.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBetweenDates($query, $startdatetime = null, $enddatetime = null) {

        if(!empty($startdatetime)) {
            if(is_string($startdatetime)) $startdatetime = new \JDate($startdatetime);
            $start_date = $startdatetime->format("Y-m-d G:i:s");

            $query = $query->where($this->getTable().".date", ">", $start_date);
        }
        if(!empty($enddatetime)) {
            if(is_string($enddatetime)) $enddatetime = new \JDate($enddatetime);
            $end_date = $enddatetime->format("Y-m-d G:i:s");

            $query = $query->where($this->getTable().".date", "<", $end_date);
        }

        return $query;
    }

    public function toThumbnail($size, $category_type = "category") {
        return new \FMGallery\Medias\Photo($this, $size, $category_type);
    }
}

?>