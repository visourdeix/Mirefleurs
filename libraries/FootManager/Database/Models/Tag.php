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
class Tag extends \FootManager\Database\Eloquent\Model {

    protected $table = "tags";

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
         'metadata' => 'array',
          'images' => 'array',
        'params' => 'array',
        'urls' => 'array'
    ];

    /**
     * Get the events of the location.
     */
    public function parent_tag()
    {
        return $this->belongsTo(Tag::class, "parent_id");
    }

}

?>