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
abstract class CompetitionEvent extends Event implements \FMManager\Interfaces\ICallable {

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('orderByTime', function(\Illuminate\Database\Eloquent\Builder $builder) {
            $builder->orderBy("time");
        });
    }

    /**
     * Get the type.
     * @return string
     */
    public function getPlayedAttribute() {
        return $this->state == \FMManager\Constants::PLAYED;
    }

    /**
     * Get the stadium.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stadium()
    {
        return $this->belongsTo(Stadium::class);
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeJoinCompetition($query)
    {
        return $query->join("fm_competitions", "fm_matchdays.competition_id", "=", "fm_competitions.id")->select($this->getTable().".*");
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeJoinTournament($query)
    {
        return $query->joinCompetition()->join("fm_tournaments", "fm_competitions.tournament_id", "=", "fm_tournaments.id")->select($this->getTable().".*");
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeJoinTournamentType($query)
    {
        return $query->joinTournament()->join("fm_tournament_types", "fm_tournaments.type_id", "=", "fm_tournament_types.id")->select($this->getTable().".*");
    }

    /**
     * Scope a query to only include specific by match.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByMatch($query, $by_match)
    {
        return $query->joinTournamentType()->where('by_match', "=", $by_match);
    }

    /**
     * Scope a query to only include specific team.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public abstract function scopeByTeam($query, $team);

    /**
     * Scope a query to only include specific team.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBetweenDates($query, $startdatetime = null, $enddatetime = null) {

        if(!empty($startdatetime)) {
            if(is_string($startdatetime)) $startdatetime = new \JDate($startdatetime);
            $start_date = $startdatetime->format("Y-m-d");
            $start_time = $startdatetime->format("G:i:s");

            $query = $query->where(function($query) use($start_date, $start_time) {
                        $query->where($this->getTable().".date", ">", $start_date)
                            ->orWhere(function($query) use($start_date, $start_time) {
                                $query->where($this->getTable().".date", "=", $start_date)
                                    ->where($this->getTable().".time", ">", $start_time);
                            });
                    });
        }
        if(!empty($enddatetime)) {
            if(is_string($enddatetime)) $enddatetime = new \JDate($enddatetime);
            $end_date = $enddatetime->format("Y-m-d");
            $end_time = $enddatetime->format("G:i:s");

            $query = $query->where(function($query) use($end_date, $end_time) {
                $query->where($this->getTable().".date", "<", $end_date)
                    ->orWhere(function($query) use($end_date, $end_time) {
                        $query->where($this->getTable().".date", "=", $end_date)
                            ->where($this->getTable().".time", "<", $end_time);
                    });
            });
        }

        return $query;
    }

    /**
     * Get the call up.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function call_up()
    {
        return $this->belongsTo(Callup::class, "call_up_id");
    }

    /**
     * Get default date.
     */
    public function defaultDate() {
        return $this->date;
    }

    /**
     * Get default date.
     */
    public function type() {
        return $this->type;
    }

    /**
     * Get all callable persons.
     */
    public function category() {
        return $this->category;
    }

    /**
     * Get default end time.
     */
    public function defaultStartTime() {
        $gap = strtotime(\FootManager\Helpers\Application::getConfiguration(FM_MANAGER_COMPONENT)->get('default_time_gap_call_up'));
        $time = strtotime($this->time->format("G:i:s"));

        if($gap && $time) return new \JDate(gmdate("H:i:s", $time - $gap));

        return new \JDate();
    }

    /**
     * Get default start time.
     */
    public function defaultEndTime() {
        return null;
    }

    /**
     * Get default stadium.
     */
    public function defaultStadium() {
        return $this->stadium;
    }

    /**
     * Get default contacts.
     */
    public abstract function defaultContacts();

    /**
     * Get all contacts.
     */
    public abstract function allContacts();

    /**
     * Get all callable persons.
     */
    public abstract function allPersons();

    /**
     * @return \FootManager\Calendar\Event
     */
    public function toCalendar() {
        return new \FMManager\Calendar\Event($this);
    }
}

?>