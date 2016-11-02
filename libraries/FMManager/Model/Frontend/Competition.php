<?php
/**
 * @package     FMManager
 * @subpackage  Models
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace FMManager\Model\Frontend;

defined('_JEXEC') or die;

/**
 * Summary of Competition
 */
abstract class Competition extends \FootManager\Model\Ajax
{
    /**
     * Load the item.
     * @param int $pk
     * @return \stdClass
     */
    protected function loadItem($pk) {

        $item = new \stdClass();

        $item->competition = $this->getCompetition($pk);

        $teams = $item->competition->competitionTeams->getColumn("team_id")->toArray();
        $item->competitions = \FMManager\Database\Models\Competition::joinTournamentType()
            ->joinSeason()
            ->where("fm_competitions.id", "<>", $pk)
            ->whereHas("competitionTeams", function($query) use($teams) {
                    $query->whereIn("team_id", $teams)
                        ->whereHas("team", function($query) {
                            $query->where("club_id", "=", \FMManager\Helper::getMyClubId());
                    });
            })
            ->orderBy("fm_seasons.ordering")
            ->orderBy("fm_tournament_types.ordering")
            ->orderBy("fm_tournaments.ordering")
            ->get();

        return $item;
    }

    /**
     * Get the current competition.
     * @param int $id
     * @return \FMManager\Database\Models\Competition
     */
    public function getCompetition($id = null) {
        $id = (!$id) ? $this->getState($this->getName().".id", 0) : $id;

        return \FMManager\Database\Models\Competition::find($id);
    }

}