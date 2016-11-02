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
class CallupPersons extends Model {

    /**
     * Main Table.
     * @var string
     */
    protected $table = "fm_call_up_persons";

    /**
     * Get the team.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function call_up()
    {
        return $this->belongsTo(Callup::class, "call_up_id");
    }

    /**
     * Get the copetition.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

}

?>