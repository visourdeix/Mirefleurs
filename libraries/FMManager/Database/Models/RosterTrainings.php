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
class RosterTrainings extends Model {

    /**
     * Main Table.
     * @var string
     */
    protected $table = "fm_roster_trainings";

    /**
     * Get the person.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function training()
    {
        return $this->belongsTo(Training::class);
    }

    /**
     * Get the roster.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function roster()
    {
        return $this->belongsTo(Roster::class);
    }
}

?>