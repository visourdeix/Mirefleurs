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
class FmmanagerModelRoster extends FMManager\Model\Frontend\Roster
{
    protected function loadItem($pk) {
        $item = parent::loadItem($pk);

        // Params
        $params = $this->getState("params", array())->toArray();
        $show_function = JArrayHelper::getValue($params, "roster_show_function", true);
        $show_diploma = JArrayHelper::getValue($params, "roster_show_diploma", true);
        $show_contacts = JArrayHelper::getValue($params, "roster_show_contacts", true);

        $roster = $item->roster;
        // Staff
        $staff = $roster->staff;

        // Relation team
        if($roster->relation_team_id) {
            $relation_roster = \FMManager\Database\Models\Roster::where([["season_id", "=", $roster->season_id], ["team_id", "=", $roster->relation_team_id]])->first();
            if($relation_roster) {
                $relation_staff = $relation_roster->staff;
                $staff = $staff->union($relation_staff);
            }
        }

        // Load attributes
        $attributes = ["person", "_function"];
        if($show_diploma) $attributes[] = "person.diplomas";
        if($show_contacts) $attributes[] = "person.contacts";

        $staff->load($attributes);

        $staff = $staff->sortMulti(["_function.ordering", "person.inverse_name"]);

        // Define attributes
        $staff->each(function ($obj) use($roster, $show_function) {
                    if($show_function)  $obj->person->_function = $obj->_function;
                   if($roster->id !== $obj->roster->id) $obj->person->team = $obj->roster->team;
                });
        $item->staff = $staff->map(function ($obj) { return $obj->person;})->unique("id");

        // Competitions
        $item->competitions = FMManager\Database\Models\Competition::where("season_id", "=", $roster->season_id)
                                                        ->whereHas("competitionTeams", function($query) use($roster) {
                                                            $query->where("team_id", "=", $roster->team_id);
                                                            })
                                                        ->joinTournamentType()
                                                        ->orderBy("fm_tournament_types.ordering")
                                                        ->orderBy("fm_tournaments.ordering")
                                                        ->get();

        // Events
        $events = $roster->events();
        $previous_events = $events->filter(function($obj) { return FootManager\Utilities\DateHelper::isBeforeToday($obj->datetime); });
        $next_events = $events->filter(function($obj) { return FootManager\Utilities\DateHelper::isAfterToday($obj->datetime); });
        $item->previous_events = $previous_events->slice(count($previous_events) - 1, 1);
        $item->next_events = $next_events->slice(0, 1);

        // Trainings
        $today = new JDate();
        $roster->load(["trainings" => function ($query) use($today) {
            $query->where("date", ">", $today->format("y-m-d"));
        }]);
        $item->trainings = $roster->trainings;

        return $item;
    }

    public function getData($id, &$params = array()) {
        $item = new stdClass();

        return $item;
    }
}