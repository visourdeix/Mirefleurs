<?php
/**
 * @package      FMManager
 * @subpackage   Models
 * @author       St�phane ANDRE
 * @copyright    Copyright (C) 2015 St�phane ANDRE. All rights reserved.
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
class TacticPositions extends Model {

    /**
     * Main Table.
     * @var string
     */
    protected $table = "fm_tactic_positions";

    /**
     * Get the team.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tactic()
    {
        return $this->belongsTo(Tactic::class);
    }

    /**
     * Get the copetition.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function position()
    {
        return $this->belongsTo(Position::class);
    }

}

?>