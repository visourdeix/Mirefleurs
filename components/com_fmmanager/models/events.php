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
class FmmanagerModelEvents extends FMManager\Model\Frontend\Roster
{

    protected function loadItem($pk) {

        $item = parent::loadItem($pk);
        $item->competitions = $item->roster->competitions()->get();

        return $item;
    }

    public function getData($id, &$params = array()) {

        $item = new stdClass();

        // Params
        $show_events = JArrayHelper::getValue($params, "events_show_events", "all");
        $show_name = JArrayHelper::getValue($params, "events_show_name", "small_name");
        $show_tournament = JArrayHelper::getValue($params, "events_show_tournament", true);
        $show_date = JArrayHelper::getValue($params, "events_show_date", true);
        $competitions = JArrayHelper::getValue($params, "competitions", array());

        // Gets the events
        $roster = parent::getRoster($id);
        $events = new \FootManager\Database\Eloquent\Collection($roster->matches(1)->whereIn("competition_id", $competitions)->get());
        $events = $events->merge($roster->matchdays(0)->whereIn("competition_id", $competitions)->get());
        $events = $events->filter(function($obj) { return \FootManager\Utilities\DateHelper::isValid($obj->date);})->sortBy("datetime");

        switch ($show_events)
        {
            case "passed" :
                $events = $events->filter(function($obj) { return FootManager\Utilities\DateHelper::isBeforeToday($obj->datetime); });
                break;

            case "future" :
                $events = $events->filter(function($obj) { return FootManager\Utilities\DateHelper::isAfterToday($obj->datetime); });
                break;

        }

        $events = $events->groupBy(function($obj) { return $obj->datetime->format("F y");});

        $item->events = $events;

        $params["myteam"] = $roster->team_id;
        $params["show_name"] = $show_name;
        $params["show_tournament"] = $show_tournament;
        $params["show_date"] = $show_date;

        return $item;
    }
}