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
class Competition extends Model {

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
         'ranking_legend' => 'array',
          'ranking_sort' => 'array',
        'attribs' => 'array',
    ];

    /**
     * Main Table.
     * @var string
     */
    protected $table = "fm_competitions";

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('category', function(\Illuminate\Database\Eloquent\Builder $builder) {
            $builder->with(["tournament.category", "season"]);
        });

        static::addGlobalScope('type', function(\Illuminate\Database\Eloquent\Builder $builder) {
            $builder->with(["tournament.type"]);
        });
    }

    /**
     * Get the name.
     * @return string
     */
    public function getNameAttribute()
    {
        switch ($this->category->in_team_name)
        {
        	case 1:
                return $this->category->label.' - '.$this->small_name;

            case 2:
                return $this->small_name.' - '.$this->category->label;

            default:
                return $this->small_name;
        }
    }

    /**
     * Get the name.
     * @return string
     */
    public function getMediumNameAttribute()
    {
        switch ($this->category->in_team_name)
        {
        	case 1:
                return $this->category->label.' - '.$this->tournament->name;

            case 2:
                return $this->tournament->name.' - '.$this->category->label;

            default:
                return $this->tournament->name;
        }
    }

    /**
     * Get the small name.
     * @return string
     */
    public function getSmallNameAttribute()
    {
        return $this->tournament->name.' '.$this->season->label;
    }

    /**
     * Get the small name.
     * @return string
     */
    public function getCategoryAttribute()
    {
        return $this->tournament->category;
    }

    /**
     * Get the abbreviation.
     * @return string
     */
    public function getAbbreviationAttribute()
    {
        return $this->tournament->small_name.' '.$this->season->label;
    }

    /**
     * Get the has ranking.
     * @return string
     */
    public function getHasRankingAttribute()
    {
        return $this->tournament->type->has_ranking;
    }

    /**
     * Get the has ranking.
     * @return string
     */
    public function getRankingLegendAttribute()
    {
        return array_map(function($obj) {
            $res = new \stdClass();
            $res->color = $obj["color"];
            $res->label = $obj["label"];
            $res->range = explode(",", $obj["range"]);
            return $res;
        }, (array)json_decode($this->attributes["ranking_legend"], true));
    }

    /**
     * Get the logo.
     * @return string
     */
    public function getLogoAttribute()
    {
        return $this->tournament->logo;
    }

    /**
     * Get the logo.
     * @return string
     */
    public function getRankingAttribute()
    {
        return $this->getRanking();
    }

    /**
     * Get the tournament.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
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
     * Get the matchdays.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function matchdays()
    {
        return $this->hasMany(Matchday::class);
    }

    /**
     * Get the matchdays.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function competitionTeams()
    {
        return $this->hasMany(CompetitionTeams::class);
    }

    /**
     * Get the statistics.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function statistics()
    {
        return $this->belongsToMany(Statistic::class, "fm_competition_statistics");
    }

    /**
     * Get the ranking.
     * @return \FootManager\Database\Eloquent\Builder
     */
    public function matches()
    {
        return Match::joinCompetition()->where("competition_id", "=", $this->id);
    }

    /**
     * Get the ranking.
     * @return \FootManager\Database\Eloquent\Collection
     */
    public function getRanking($type = \FMManager\Constants::GENERAL, $date = null)
    {
        $matches = $this->matches()->with(["team1", "team2"])->get();

        if($date) $matches = $matches->filter(function($obj) use($date) { return \FootManager\Utilities\DateHelper::isBefore($obj->datetime, $date);});

        $teams = $this->competitionTeams()->with("team")->get()->map(function($obj) { return $obj->team; });
        $ranking = $matches->getRanking(array(), $teams, $type);

        foreach ($ranking as $row)
        {
            $row->points = ($row->victories * $this->victory_points) + ($row->victories_to_penalties * $this->victory_to_penalties_points) + ($row->draws * $this->draw_points) + ($row->defeats * $this->defeat_points) + ($row->defeats_to_penalties * $this->defeat_to_penalties_points) + $row->bonus;

            if(isset($row->team->penalty)) $row->points = $row->points + $row->team->penalty;
        }

        $sort = $this->ranking_sort;
        if(is_string($sort)) $sort = json_decode($sort);
        $sort = ($sort) ? $sort : \FMManager\Helper::$RANKING_SORT;

        if($sort) {
            $directions = array_fill(0, count($sort), -1);
            $ranking = $ranking->sortMulti($sort, $directions);
        }

        $i = 1;
        foreach ($ranking as $row)
        {
        	$row->rank = $i;
            $i++;
        }

        return $ranking;
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeJoinTournament($query)
    {
        return $query->join("fm_tournaments", "fm_competitions.tournament_id", "=", "fm_tournaments.id")->select($this->getTable().".*");
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
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeJoinSeason($query)
    {
        return $query->join("fm_seasons", "fm_competitions.season_id", "=", "fm_seasons.id")->select($this->getTable().".*");
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeJoinCategory($query)
    {
        return $query->join("fm_categories", "fm_tournaments.category_id", "=", "fm_categories.id")->select($this->getTable().".*");
    }
}

?>