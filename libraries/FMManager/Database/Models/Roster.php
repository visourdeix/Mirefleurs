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
class Roster extends Model {

    /**
     * Main Table.
     * @var string
     */
    protected $table = "fm_rosters";

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('category', function(\Illuminate\Database\Eloquent\Builder $builder) {
            $builder->with(["team.category", "season"]);
        });
    }

    /**
     * Get the category.
     * @return \FMManager\Database\Models\Category
     */
    public function getCategoryAttribute()
    {
        return $this->team->category;
    }

    /**
     * Get the name.
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->category->label.(($this->team->suffix !== "") ? (' '.$this->team->suffix) : "").' '.$this->season->label;
    }

    /**
     * Get the small name.
     * @return string
     */
    public function getSmallNameAttribute()
    {
        return $this->category->label.(($this->team->suffix !== "") ? (' '.$this->team->suffix) : "");
    }

    /**
     * Get the season.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function season()
    {
        return $this->belongsTo(Season::class);
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
     * Get the relation team.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function relationTeam()
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * Get the players.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function players()
    {
        return $this->hasMany(RosterPlayers::class);
    }

    /**
     * Get the staff.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function staff()
    {
        return $this->hasMany(RosterStaff::class);
    }

    /**
     * Get the rosters.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function trainings()
    {
        return $this->belongsToMany(Training::class, "fm_roster_trainings");
    }

    /**
     * Get the matches.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function matches($by_match = -1)
    {
        if($by_match > -1)
            $matches = Match::byMatch($by_match);
        else
            $matches = Match::joinCompetition();

        return $matches->with(["matchday.competition.tournament", "team1", "team2"])->where('season_id', "=", $this->season_id)->byTeam($this->team_id);
    }

    /**
     * Get the matches.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function matchdays($by_match = -1)
    {

        if($by_match > -1)
            $matchdays = Matchday::byMatch($by_match);
        else
            $matchdays = Matchday::joinCompetition();

        return $matchdays->with(["competition.tournament"])->where('season_id', "=", $this->season_id)->byTeam($this->team_id);
    }

    /**
     * Get the competitions.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function competitions()
    {
        $team = $this->team_id;
        return Competition::joinTournamentType()
            ->whereHas("competitionTeams", function($query) use($team) {
                $query->where("team_id", "=", $team);
            })
            ->where("season_id", "=", $this->season_id)
            ->orderBy("fm_tournament_types.ordering")
            ->orderBy("fm_tournaments.ordering");
    }

    /**
     * Get the matches.
     * @return \Illuminate\Support\Collection
     */
    public function events()
    {
        $events = new \FootManager\Database\Eloquent\Collection($this->matches(1)->get());
        $events = $events->merge($this->matchdays(0)->get());
        return $events->filter(function($obj) { return \FootManager\Utilities\DateHelper::isValid($obj->date);})->sortBy("datetime");
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeJoinCategory($query)
    {
        return $query->join("fm_teams", "fm_rosters.team_id", "=", "fm_teams.id")->join("fm_categories", "fm_teams.category_id", "=", "fm_categories.id")->select("fm_rosters.*");
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeJoinSeason($query)
    {
        return $query->join("fm_seasons", "fm_rosters.season_id", "=", "fm_seasons.id")->select("fm_rosters.*");
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeJoinClub($query)
    {
        return $query->joinCategory()->join("fm_clubs", "fm_teams.club_id", "=", "fm_clubs.id")->select("fm_rosters.*");
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrderByCategory($query)
    {
        return $query->joinCategory()->orderBy( "fm_categories.ordering")->orderBy( "fm_teams.suffix")->select("fm_rosters.*");
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrderBySeason($query)
    {
        return $query->joinSeason()->orderBy( "fm_seasons.ordering")->select("fm_rosters.*");
    }
}

?>