<?php
/**
 * @package      FMEvents
 * @subpackage   Calendar
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FootManager\Database\Models;

defined('JPATH_PLATFORM') or die;

use Illuminate\Database\Eloquent\Model;

/**
 * This class contains common methods and properties for a database item
 *
 * @package      FMEvents
 * @subpackage   Calendar
 */
class Category extends \FootManager\Database\Eloquent\Model {

    protected $table = "categories";

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
         'params' => 'array'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the name.
     * @return string
     */
    public function getAllSubCategoriesAttribute()
    {
        return self::allSubCategories($this)->get();
    }

    /**
     * Get the events of the location.
     */
    public function parent_category()
    {
        return $this->belongsTo(Category::class, "parent_id");
    }

    /**
     * Get the events of the location.
     */
    public function subcategories()
    {
        return $this->hasMany(Category::class, "parent_id");
    }

    /**
     * Scope a query to only include specific team.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByExtension($query, $extension, $published = 1) {
        return $query->where("extension", "=", $extension)->where("published", "=", $published);
    }

    /**
     * Scope a query to only include specific team.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAllSubCategories($query, $category) {
        return $query->scopeCategories($category->lft, $category->rgt);
    }

    /**
     * Scope a query to only include specific team.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCategories($query, $lft, $rgt) {
        return $query->where('lft', ">=", (int) $lft)->where('rgt', "<=", (int) $rgt);
    }

}

?>