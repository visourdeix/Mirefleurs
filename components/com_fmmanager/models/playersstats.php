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
class FmmanagerModelPlayersstats extends FMManager\Model\Frontend\Roster
{

    protected function loadItem($pk) {

        $item = parent::loadItem($pk);
        $item->competitions = $item->roster->competitions()->get();
        $item->types = FMManager\Helper::getTypes();

        return $item;
    }

    public function getData($id, &$params = array()) {
        $roster = $this->getRoster($id);
        $item = new stdClass();

        // Params
        $show_filters = JArrayHelper::getValue($params, "playersstats_show_filters", true);
        $order = JArrayHelper::getValue($params, "playersstats_order", "person.inverse_name");
        $show_podium_goals = JArrayHelper::getValue($params, "playersstats_show_podium_goals", true);
        $show_podium_assists = JArrayHelper::getValue($params, "playersstats_show_podium_assists", true);
        $competitions = JArrayHelper::getValue($params, "competitions", array());
        $type = JArrayHelper::getValue($params, "type", \FMManager\Constants::GENERAL);

        // Matches
        $matches = $roster->matches()->where("fm_matches.state", "=", FMManager\Constants::PLAYED);
        if($show_filters) $matches = $matches->whereIn("competition_id", $competitions);
        $matches = $matches->get()->filteredByType($type, $roster->team);
        $competitions = array_unique($matches->map(function($obj) { return $obj->matchday->competition_id; })->toArray());

        // Stats
        $stats = $matches->getStatsOfPlayers($roster->team, true);

        // Roster Positions
        $players = $roster->players->load("position");
        foreach ($stats as $stat)
        {
        	$player = $players->first(function($key, $obj) use($stat) { return $obj->person->id == $stat->person->id; });
            if(isset($player)) $stat->person->position = $player->position;
        }

        // Result
        $item->stats = $stats->sortBy($order);
        $item->allowed_statistics = FMManager\Database\Models\Statistic::isAllowed($competitions)->where("by_player", "=", 1)->get();
        $item->podium_goals = array();
        $item->podium_assists = array();

        if($show_podium_goals) $item->podium_goals = $stats->sortByDesc("goals")->slice(0, 3);
        if($show_podium_assists) $item->podium_assists = $stats->sortByDesc("assists")->slice(0, 3);

        return $item;
    }
}