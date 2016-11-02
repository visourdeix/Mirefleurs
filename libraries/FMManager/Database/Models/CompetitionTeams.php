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
class CompetitionTeams extends Model {

    /**
     * Main Table.
     * @var string
     */
    protected $table = "fm_competition_teams";

    /**
     * Get the team.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * Get the copetition.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    /**
     * Get the copetition.
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function matchdays()
    {
        return $this->hasManyThrough(Matchday::class, Competition::class);
    }

}

?>