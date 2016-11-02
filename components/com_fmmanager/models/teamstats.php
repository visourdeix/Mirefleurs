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
class FmmanagerModelTeamstats extends FMManager\Model\Frontend\Roster
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

        $show_filters = JArrayHelper::getValue($params, "teamstats_show_filters", true);
        $count_in_series = JArrayHelper::getValue($params, "teamstats_count_in_series", 10);
        $competitions = JArrayHelper::getValue($params, "competitions", array());
        $type = JArrayHelper::getValue($params, "type", \FMManager\Constants::GENERAL);

        $matches = $roster->matches()->where("fm_matches.state", "=", FMManager\Constants::PLAYED);

        if($show_filters) $matches = $matches->whereIn("competition_id", $competitions);

        $matches = $matches->get()->filteredByType($type, $roster->team);

        $item->stats = $matches->getStatsOfTeam($roster->team);
        $item->serie = $matches->sortBy(function($obj) { return $obj->datetime; })->slice(count($matches) - $count_in_series, $count_in_series);
        $item->team = $roster->team_id;

        return $item;
    }

}