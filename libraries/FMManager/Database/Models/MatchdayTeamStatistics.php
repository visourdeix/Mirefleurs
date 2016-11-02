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
class MatchdayTeamStatistics extends Model {

    /**
     * Main Table.
     * @var string
     */
    protected $table = "fm_matchday_team_statistics";

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('statistic', function(\Illuminate\Database\Eloquent\Builder $builder) {
            $builder->with(["statistic"])->join("fm_statistics", "fm_matchday_team_statistics.statistic_id", "=", "fm_statistics.id")->select("fm_matchday_team_statistics.*")->orderBy("fm_statistics.ordering");
        });
    }

    /**
     * Get the team.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * Get the stat.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function statistic()
    {
        return $this->belongsTo(Statistic::class);
    }

    /**
     * Get the match.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function matchday()
    {
        return $this->belongsTo(Matchday::class);
    }

}

?>