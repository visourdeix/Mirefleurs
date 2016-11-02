<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Content Component Article Model
 *
 * @since  1.5
 */
class FmmanagerModelAbout extends \FootManager\Model\Item
{

    protected function loadItem($pk) {
        $item = new stdClass();

        // Get my club.
        $club = \FMManager\Database\Models\Club::myClub();

        // Get the club's teams
        $teams = FMManager\Database\Models\Team::where("club_id", "=", $club->id)->orderByCategory()->get();

        $item->club = $club;

        $item->contacts = FMManager\Database\Models\Contact::where("person_id", "=", $club->person_id)->get();

        if(isset($teams)) {
            // Get the most valuable team.
            $team = $teams->first();

            // Get the current season.
            $seasonId = FMManager\Database\Models\Season::current()->id;

            // Competitions
            $competitions = FMManager\Database\Models\Competition::where("season_id", "=", $seasonId)
                                                            ->whereHas("competitionTeams", function($query) use($team) {
                                                                $query->where("team_id", "=", $team->id);
                                                                })
                                                            ->joinTournamentType()
                                                            ->orderBy("fm_tournament_types.ordering")
                                                            ->orderBy("fm_tournaments.ordering")
                                                            ->get();

            $item->tournament = $competitions->where("tournament.type.has_ranking", 1)->last()->tournament;
            $item->team = $team;
            $item->stadium = FMManager\Database\Models\Stadium::where("id", "=", $team->stadium_id)->first();
        }


        return $item;
    }
}