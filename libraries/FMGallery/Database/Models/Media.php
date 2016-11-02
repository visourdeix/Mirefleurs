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
abstract class Media extends Model implements \FootManager\Medias\IThumbnail {

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
    public function getDateAttribute()
    {
        if(\FootManager\Utilities\DateHelper::isValid($this->attributes['date'])) return new \JDate($this->attributes['date']);
        return null;
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
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeJoinCategory($query)
    {
        return $query->join("categories", $this->getTable().".catid", "=", "categories.id")->select($this->getTable().".*");
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeJoinViewLevel($query)
    {
        return $query->join("viewlevels", $this->getTable().".access", "=", "viewlevels.id")->select($this->getTable().".*");
    }

    public abstract function toThumbnail($size, $category_type = "category");
}

?>