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
class Contact extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $fillable = ['type', 'label', 'default', 'value'];

    /**
     * Main Table.
     * @var string
     */
    protected $table = "fm_person_contacts";

    /**
     * Get the diplomas.
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

}

?>