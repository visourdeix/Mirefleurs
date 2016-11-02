<?php
/**
 * @package      FMActivity
 * @subpackage   Calendar
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FMActivity\Database\Models;

defined('JPATH_PLATFORM') or die;

use FootManager\Database\Eloquent\Model;

/**
 * This class contains common methods and properties for a database item
 *
 * @package      FMActivity
 * @subpackage   Calendar
 */
class Item extends Model {

    protected $table = "fmactivity_items";

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
         'metadata' => 'array'
    ];

    /**
     * Get the category.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(\FMActivity\Database\Models\Type::class);
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
    public function scopeJoinViewLevel($query)
    {
        return $query->join("viewlevels", $this->getTable().".access", "=", "viewlevels.id")->select($this->getTable().".*");
    }
}

?>