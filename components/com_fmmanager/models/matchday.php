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
class FmmanagerModelMatchday extends \FootManager\Model\Item
{

    protected function loadItem($pk) {
        $item = new stdClass();

        $item->matchday = \FMManager\Database\Models\Matchday::withoutGlobalScopes()->find($pk);
        $item->matchdays = \FMManager\Database\Models\Matchday::withoutGlobalScopes()->where("competition_id", "=", $item->matchday->competition_id)->orderBy("date")->orderBy("time")->get();

        $stats = $item->matchday->matches->getStatsOfPlayers(null, true);

        return $item;
    }

    public function getCallUp($id, $params = array()) {
        $matchday = FMManager\Database\Models\Matchday::withoutGlobalScopes()->with(["call_up.contacts.contacts"])->find($id);

        return $matchday->call_up;

    }

    public function getMatches($id, $params = array()) {
        $matchday = FMManager\Database\Models\Matchday::withoutGlobalScopes()->find($id);
        return $matchday->matches;
    }

    public function getStats($id, &$params = array()) {
        $matchday = \FMManager\Database\Models\Matchday::withoutGlobalScopes()->find($id);
        $item = new stdClass();

        $item->allowed_statistics = FMManager\Database\Models\Statistic::isAllowed((array)$matchday->competition->id)->where("by_player", "=", 1)->where("by_matchday", "=", 1)->get();

        $item->stats = $matchday->matches->getStatsOfPlayers(null, true);

        return $item;
    }
}