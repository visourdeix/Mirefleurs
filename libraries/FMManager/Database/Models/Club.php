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
class Club extends Model {

    /**
     * Main Table.
     * @var string
     */
    protected $table = "fm_clubs";

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function(\Illuminate\Database\Eloquent\Builder $builder) {
            $builder->orderBy("city");
        });
    }

    /**
     * Get the teams.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    /**
     * Get my club.
     *
     * @return Club
     */
    public static function myClub()
    {
        return self::find(\FMManager\Helper::getMyClubId());
    }

}

?>