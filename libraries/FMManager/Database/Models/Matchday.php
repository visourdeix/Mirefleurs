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
class Matchday extends CompetitionEvent {

    /**
     * Main Table.
     * @var string
     */
    protected $table = "fm_matchdays";

    /**
     * Get the type.
     * @return string
     */
    public function getTypeAttribute() {
        return "matchday";
    }

    /**
     * Get the name.
     * @return string
     */
    public function getStateAttribute()
    {
        $state = $this->attributes["state"];
        if($state == \FMManager\Constants::NOT_PLAYED && \FootManager\Utilities\DateHelper::isBeforeToday($this->attributes["date"])) {
            $state = \FMManager\Constants::PLAYED;
        }
        return $state;
    }

    /**
     * Get the name.
     * @return string
     */
    public function getCategoryAttribute()
    {
        return $this->competition->tournament->category;
    }

    /**
     * Get the type.
     * @return string
     */
    public function isMyEvent() {
        return true;
    }

    /**
     * Get the competition.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    /**
     * Get the tactic 2.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function playersStatistics()
    {
        return $this->hasMany(MatchdayPlayerStatistics::class);
    }

    /**
     * Get the tactic 2.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function teamsStatistics()
    {
        return $this->hasMany(MatchdayTeamStatistics::class);
    }

    /**
     * Get the matches.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function matches()
    {
        return $this->hasMany(Match::class);
    }

    /**
     * Scope a query to only include specific team.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByTeam($query, $team) {
        return $query->whereHas("competition", function($query) use($team) {
                    $query->whereHas("competitionTeams", function($query) use($team) {
                                $query->where("team_id", "=", $team);
                    });
                });
    }

    /**
     * Get default stadium.
     */
    public function defaultStadium() {
        $competition = $this->competition;
        $stadium = Stadium::whereHas("teams", function($query) use($competition) {
            $query->whereHas("competitions", function($query) use($competition) {
                $query->where("competition_id", "=", $competition->id);
            })
                ->where("club_id", "=", \FMManager\Helper::getMyClubId());
        })->first();

        return ($stadium) ? $stadium : parent::defaultStadium();
    }

    /**
     * Get default contacts.
     */
    public function defaultContacts() {
        return $this->allContacts();
    }

    /**
     * Get all contacts.
     */
    public function allContacts() {
        $competition = $this->competition;
        return RosterStaff::whereHas("roster", function($query) use($competition) {
                    $query->where("season_id", "=", $competition->season_id)
                        ->whereHas("team", function($query) use($competition) {
                        $query->whereHas("competitions", function($query) use($competition) {
                            $query->where("competition_id", "=", $competition->id);
                        });
                    });
                    })->get();
    }

    /**
     * Get all callable persons.
     */
    public function allPersons() {

        $competition = $this->competition;
        return RosterPlayers::whereHas("roster", function($query) use($competition) {
                    $query->where("season_id", "=", $competition->season_id)
                        ->whereHas("team", function($query) use($competition) {
                        $query->whereHas("competitions", function($query) use($competition) {
                            $query->where("competition_id", "=", $competition->id);
                        });
                    });
                    })->get();
    }
}

?>