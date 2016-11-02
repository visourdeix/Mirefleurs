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
class Activity extends Model {

    protected $table = "fmactivity_activities";

    /**
     * Get the category.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event()
    {
        return $this->belongsTo(\FMActivity\Database\Models\Event::class);
    }

    /**
     * Get the category.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo(\FMActivity\Database\Models\Item::class);
    }

    /**
     * Get the category.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function created_user()
    {
        return $this->belongsTo(\FootManager\Database\Models\User::class, "created_by");
    }

    /**
     * Get the category.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modified_user()
    {
        return $this->belongsTo(\FootManager\Database\Models\User::class, "modified_by");
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

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeJoinItem($query)
    {
        return $query->join("fmactivity_items", $this->getTable().".item_id", "=", "fmactivity_items.id")->select($this->getTable().".*");
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeJoinType($query)
    {
        return $query->joinItem()->join("fmactivity_item_types", "fmactivity_items.type_id", "=", "fmactivity_item_types.id")->select($this->getTable().".*");
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeJoinEvent($query)
    {
        return $query->join("fmactivity_events", $this->getTable().".event_id", "=", "fmactivity_events.id")->select($this->getTable().".*");
    }

    public function getActivityModel() {
        static $cache = array();
        list($group, $plg) = explode(".", $this->item->type->plugin);
        $file  = JPATH_PLUGINS.DS.$group.DS.$plg.DS."activities".DS.$this->item->type->name.".php";
        $class = "plg".ucfirst($group).ucfirst($plg).ucfirst($this->item->type->name);

        if (is_null($file) || !file_exists($file)) return new \FMActivity\Activity\Activity($this);

        require_once $file;

        return new $class($this);
    }
}

?>