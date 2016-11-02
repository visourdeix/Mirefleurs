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
class Match extends CompetitionEvent {

    /**
     * Main Table.
     * @var string
     */
    protected $table = "fm_matches";

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('tournamenttype', function(\Illuminate\Database\Eloquent\Builder $builder) {
            $builder->with(["matchday.competition.tournament.type"]);
        });
    }

    /**
     * Get the name.
     * @return string
     */
    public function getDateAttribute()
    {
        if($this->matchday->competition->tournament->type->by_match) {
            return parent::getDateAttribute();
        } else {
            return $this->matchday->date;
        }
    }

    /**
     * Get the type.
     * @return string
     */
    public function getCompetitionAttribute() {
        return $this->matchday->competition;
    }

    /**
     * Get the type.
     * @return string
     */
    public function getCategoryAttribute() {
        return $this->matchday->competition->tournament->category;
    }

    /**
     * Get the type.
     * @return string
     */
    public function getTypeAttribute() {
        return "match";
    }

    public function getScore1Attribute() {
        return $this->played ? $this->attributes["score1"] : "";
    }

    public function getScore2Attribute() {
        return $this->played ? $this->attributes["score2"] : "";
    }

    public function getPenalties1Attribute() {
        return ($this->played && $this->matchday->competition->tournament->penalties && $this->score1 == $this->score2) ? $this->attributes["penalties1"] : "";
    }

    public function getPenalties2Attribute() {
        return ($this->played && $this->matchday->competition->tournament->penalties && $this->score1 == $this->score2) ? $this->attributes["penalties2"] : "";
    }

    public function getScoreAttribute() {
        return $this->played ? $this->score1.\JText::_("COM_FMMANAGER_SCORE_SEPARATOR").$this->score2 : \JText::_("COM_FMMANAGER_SCORE_SEPARATOR");
    }

    public function getPenaltiesAttribute() {
        return ($this->played && $this->matchday->competition->tournament->penalties && $this->score1 == $this->score2 && $this->penalties1 !== $this->penalties2) ? $this->score1.\JText::_("COM_FMMANAGER_SCORE_SEPARATOR").$this->score2 : "";
    }

    /**
     * Get the roster 1.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getRoster1Attribute()
    {
        return Roster::where("team_id", "=", $this->team1_id)->where("season_id", "=", $this->matchday->competition->season_id)->first();
    }

    /**
     * Get the roster 2.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getRoster2Attribute()
    {
        return Roster::where("team_id", "=", $this->team2_id)->where("season_id", "=", $this->matchday->competition->season_id)->first();
    }

    /**
     * Get the tactic 2.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getPlayers1Attribute()
    {
        return $this->playersOfTeam($this->team1_id);
    }

    /**
     * Get the tactic 2.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getPlayers2Attribute()
    {
        return $this->playersOfTeam($this->team2_id);
    }

    /**
     * Get the tactic 2.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getStaff1Attribute()
    {
        return $this->staffOfTeam($this->team1_id);
    }

    /**
     * Get the tactic 2.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getStaff2Attribute()
    {
        return $this->staffOfTeam($this->team2_id);
    }

    /**
     * Get the tactic 2.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getGoals1Attribute()
    {
        return $this->goalsOfTeam($this->team1_id);
    }

    /**
     * Get the tactic 2.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getGoals2Attribute()
    {
        return $this->goalsOfTeam($this->team2_id);
    }

    /**
     * Get the tactic 2.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getSubstitutions1Attribute()
    {
        return $this->substitutionsOfTeam($this->team1_id);
    }

    /**
     * Get the tactic 2.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getSubstitutions2Attribute()
    {
        return $this->substitutionsOfTeam($this->team2_id);
    }

    /**
     * Get the tactic 2.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getPlayersStatistics1Attribute()
    {
        return $this->playersStatisticsOfTeam($this->team1_id);
    }

    /**
     * Get the tactic 2.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getPlayersStatistics2Attribute()
    {
        return $this->playersStatisticsOfTeam($this->team2_id);
    }

    /**
     * Get the tactic 2.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getStaffStatistics1Attribute()
    {
        return $this->staffStatisticsOfTeam($this->team1_id);
    }

    /**
     * Get the tactic 2.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getStaffStatistics2Attribute()
    {
        return $this->staffStatisticsOfTeam($this->team2_id);
    }

    /**
     * Get the tactic 2.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function playersOfTeam($team_id)
    {
        return $this->players->where("team_id", $team_id);
    }

    /**
     * Get the tactic 2.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function staffOfTeam($team_id)
    {
        return $this->staff->where("team_id", $team_id);
    }

    /**
     * Get the tactic 2.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function goalsOfTeam($team_id)
    {
        return $this->goals->where("team_id", $team_id);
    }

    /**
     * Get the tactic 2.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function substitutionsOfTeam($team_id)
    {
        return $this->substitutions->where("team_id", $team_id);
    }

    /**
     * Get the tactic 2.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function playersStatisticsOfTeam($team_id)
    {
        return $this->playersStatistics->where("team_id", $team_id);
    }

    /**
     * Get the tactic 2.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function staffStatisticsOfTeam($team_id)
    {
        return $this->staffStatistics->where("team_id", $team_id);
    }

    /**
     * Fet difference.
     * @param mixed $team
     * @return mixed
     */
    public function getDifference($team) {
        return $this->getScored($team) - $this->getConceded($team);
    }

    /**
     * Get scred..
     * @param mixed $team
     * @return mixed
     */
    public function getScored($team) {
        $id = ($team instanceof Team) ? $team->id : $team;
        if($this->played) {
            if($this->team1_id == $id) return $this->score1;
            if($this->team2_id == $id) return $this->score2;
        }

        return 0;

    }

    /**
     * Get conceded.
     * @param mixed $team
     * @return mixed
     */
    public function getConceded($team) {
        $id = ($team instanceof Team) ? $team->id : $team;
        if($this->played) {
            if($this->team1_id == $id) return $this->score2;
            if($this->team2_id == $id) return $this->score1;
        }

        return 0;

    }

    /**
     * Get bonus.
     * @param mixed $team
     * @return mixed
     */
    public function getBonus($team) {
        $id = ($team instanceof Team) ? $team->id : $team;
        if($this->played) {
            if($this->team1_id == $id) return $this->bonus1;

            if($this->team2_id == $id) return $this->bonus2;
        }

        return 0;

    }

    /**
     * Is withdraw ?
     * @param mixed $team
     * @return mixed
     */
    public function isWithdraw($team) {
        $id = ($team instanceof Team) ? $team->id : $team;
        if($this->played) {
            if($this->team1_id == $id) return $this->withdraw1;
            if($this->team2_id == $id) return $this->withdraw2;

        }

        return false;

    }

    /**
     * Get the type.
     * @return string
     */
    public function isWinner($team) {
        $result = $this->getResult($team);
        return ($result == \FMManager\Constants::VICTORY) || ($result == \FMManager\Constants::VICTORY_TO_PENALTIES);
    }

    /**
     * Get the type.
     * @return string
     */
    public function isLooser($team) {
        $result = $this->getResult($team);
        return ($result == \FMManager\Constants::DEFEAT) || ($result == \FMManager\Constants::DEFEAT_TO_PENALTIES);
    }

    /**
     * SGet the result.
     * @param mixed $team
     * @return mixed
     */
    public function getResult($team) {

        $id = ($team instanceof Team) ? $team->id : $team;
        if($this->team1_id != $id && $this->team2_id != $id) return \FMManager\Constants::NOT_PLAYED;

        if($this->state == \FMManager\Constants::PLAYED) {
            if($this->score1 == $this->score2) {
                if($this->matchday->competition->tournament->penalties) {
                    if($this->team1_id == $id) {
                        if($this->penalties1 > $this->penalties2) return \FMManager\Constants::VICTORY_TO_PENALTIES;
                        if($this->penalties1 < $this->penalties2) return \FMManager\Constants::DEFEAT_TO_PENALTIES;
                    } else if($this->team2_id == $id) {
                        if($this->penalties2 > $this->penalties1) return \FMManager\Constants::VICTORY_TO_PENALTIES;
                        if($this->penalties2 < $this->penalties1) return \FMManager\Constants::DEFEAT_TO_PENALTIES;
                    }
                }

                return \FMManager\Constants::DRAW;
            } else {
                if($this->team1_id == $id) {
                    if($this->score1 > $this->score2) return \FMManager\Constants::VICTORY;
                    if($this->score1 < $this->score2) return \FMManager\Constants::DEFEAT;
                } else if($this->team2_id == $id) {
                    if($this->score2 > $this->score1) return \FMManager\Constants::VICTORY;
                    if($this->score2 < $this->score1) return \FMManager\Constants::DEFEAT;
                }
            }
        }

        return \FMManager\Constants::NOT_PLAYED;
    }

    /**
     * Get the type.
     * @return string
     */
    public function isMyEvent() {
        return ($this->team1->club_id == \FMManager\Helper::getMyClubId() || $this->team2->club_id == \FMManager\Helper::getMyClubId());
    }

    /**
     * Get the type.
     * @return string
     */
    public function isInEvent($team) {
        return ($this->team1_id == $team->id || $this->team2_id == $team->id);
    }

    /**
     * Get the matchday.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function matchday()
    {
        return $this->belongsTo(Matchday::class);
    }

    /**
     * Get the team1.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team1()
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * Get the team2.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team2()
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * Get the tactic 1.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tactic1()
    {
        return $this->belongsTo(Tactic::class);
    }

    /**
     * Get the tactic 2.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tactic2()
    {
        return $this->belongsTo(Tactic::class);
    }

    /**
     * Get the tactic 2.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function goals()
    {
        return $this->hasMany(MatchGoals::class);
    }

    /**
     * Get the tactic 2.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function players()
    {
        return $this->hasMany(MatchPlayers::class);
    }

    /**
     * Get the tactic 2.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function playersStatistics()
    {
        return $this->hasMany(MatchPlayerStatistics::class);
    }

    /**
     * Get the tactic 2.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function staffStatistics()
    {
        return $this->hasMany(MatchStaffStatistics::class);
    }

    /**
     * Get the tactic 2.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function teamsStatistics()
    {
        return $this->hasMany(MatchTeamStatistics::class);
    }

    /**
     * Get the tactic 2.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function staff()
    {
        return $this->hasMany(MatchStaff::class);
    }

    /**
     * Get the tactic 2.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function substitutions()
    {
        return $this->hasMany(MatchSubstitutions::class);
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeJoinMatchday($query)
    {
        return $query->join("fm_matchdays", "fm_matches.matchday_id", "=", "fm_matchdays.id")->select("fm_matches.*");
    }

    /**
     * Scope a query to only include popular users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeJoinCompetition($query)
    {
        return $query->joinMatchday()->join("fm_competitions", "fm_matchdays.competition_id", "=", "fm_competitions.id")->select($this->getTable().".*");
    }

    /**
     * Scope a query to only include specific team.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByTeam($query, $team) {
        return $query->where(function($query) use($team) {
                $query->where("team1_id", "=", $team)
                    ->orWhere("team2_id", "=", $team);
            });
    }

    /**
     * Scope a query to only include specific team.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePreviousMatches($query, $team, $datetime = null) {

        if(empty($datetime)) $datetime = new \JDate();

        return \FMManager\Database\Models\Match::byTeam($team)->betweenDates(null, $datetime);
    }

    /**
     * Get default stadium.
     */
    public function defaultStadium() {
        if(\FMManager\Helper::isMyClub($this->team1->club_id)) return $this->team1->stadium;

        if(\FMManager\Helper::isMyClub($this->team2->club_id)) return $this->team2->stadium;

        return parent::defaultStadium();
    }

    /**
     * Get default contacts.
     */
    public function defaultContacts() {
        $staff = new \FootManager\Database\Eloquent\Collection();

        if($this->roster1) {
            $roster = $this->roster1;
            $staff = RosterStaff::where("roster_id", "=", $roster->id)->get();
        }

        if($this->roster2) {
            $roster = $this->roster2;
            $staff_temp = RosterStaff::where("roster_id", "=", $roster->id)->get();

            $staff = $staff->union($staff_temp);
        }

        return $staff;
    }

    /**
     * Get all contacts.
     */
    public function allContacts() {
        $staff = new \FootManager\Database\Eloquent\Collection();

        $competition = $this->matchday->competition;
        if($this->roster1) {
            $roster = $this->roster1;
            $staff = RosterStaff::whereHas("roster", function($query) use($competition, $roster) {
                        $query->where("season_id", "=", $competition->season_id)
                            ->where(function($query) use($roster) {
                                $query->whereHas("team", function($query) use($roster) {
                                    $query->where("category_id", "=", $roster->team->category_id)
                                        ->where("club_id", "=", $roster->team->club_id);
                                })
                                    ->orWhere(function($query) use($roster) {
                                        $query->whereNotNull("team_id")
                                            ->where("team_id", "=", $roster->relation_team_id);
                                    });
                            });
                        })->get();
        }

        if($this->roster2) {
            $roster = $this->roster2;
            $staff_temp = RosterStaff::whereHas("roster", function($query) use($competition, $roster) {
                        $query->where("season_id", "=", $competition->season_id)
                            ->where(function($query) use($roster) {
                                $query->whereHas("team", function($query) use($roster) {
                                    $query->where("category_id", "=", $roster->team->category_id)
                                        ->where("club_id", "=", $roster->team->club_id);
                                })
                                    ->orWhere(function($query) use($roster) {
                                        $query->whereNotNull("team_id")
                                            ->where("team_id", "=", $roster->relation_team_id);
                                    });
                            });
                        })->get();

            $staff = $staff->union($staff_temp);
        }

        return $staff;
    }

    /**
     * Get all callable persons.
     */
    public function allPersons() {

        $players = new \FootManager\Database\Eloquent\Collection();

        $competition = $this->matchday->competition;
        if($this->roster1) {
            $roster = $this->roster1;
            $players = RosterPlayers::whereHas("roster", function($query) use($competition, $roster) {
                        $query->where("season_id", "=", $competition->season_id)
                            ->where(function($query) use($roster) {
                                $query->whereHas("team", function($query) use($roster) {
                                    $query->where("category_id", "=", $roster->team->category_id)
                                        ->where("club_id", "=", $roster->team->club_id);
                                })
                                    ->orWhere(function($query) use($roster) {
                                        $query->whereNotNull("team_id")
                                            ->where("team_id", "=", $roster->relation_team_id);
                                    });
                            });
                        })->get();
        }

        if($this->roster2) {
            $roster = $this->roster2;
            $players_temp = RosterPlayers::whereHas("roster", function($query) use($competition, $roster) {
                        $query->where("season_id", "=", $competition->season_id)
                            ->where(function($query) use($roster) {
                                $query->whereHas("team", function($query) use($roster) {
                                    $query->where("category_id", "=", $roster->team->category_id)
                                        ->where("club_id", "=", $roster->team->club_id);
                                })
                                    ->orWhere(function($query) use($roster) {
                                        $query->whereNotNull("team_id")
                                            ->where("team_id", "=", $roster->relation_team_id);
                                    });
                            });
                        })->get();

            $players = $players->union($players_temp);

        }

        return $players;
    }

    /**
     * Create a new Eloquent Collection instance.
     *
     * @param  array  $models
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function newCollection(array $models = [])
    {
        return new \FMManager\Database\Collections\Matches($models);
    }
}

?>