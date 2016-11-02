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
class Content extends \FootManager\Database\Eloquent\Model {

    protected $table = "content";

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
        'attribs' => 'array',
        'urls' => 'array'
    ];

    /**
     * Get the events of the location.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, "catid");
    }

    /**
     * Get the name.
     * @return string
     */
    public function getTextAttribute()
    {
        return trim($this->fulltext) != '' ? $this->introtext . "<hr id=\"system-readmore\" />" . $this->fulltext : $this->introtext;
    }

}

?>