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
 * Summary of Roster.
 */
abstract class Roster extends \FootManager\Model\Ajax
{
    protected function loadItem($pk) {

        $item = new \stdClass();

        $item->roster = \FMManager\Database\Models\Roster::find($pk);
        $item->season_rosters = \FMManager\Database\Models\Roster::where("team_id", "=", $item->roster->team_id)->where("fm_rosters.id", "<>", $pk)->orderBySeason()->get();
        $item->team_rosters = \FMManager\Database\Models\Roster::where("season_id", "=", $item->roster->season_id)->where("fm_rosters.id", "<>", $pk)->orderByCategory()->get();

        return $item;
    }

    /**
     * Get the current roster.
     * @param int $id
     * @return \FMManager\Database\Models\Roster
     */
    public function getRoster($id = null) {
        $id = (!$id) ? $this->getState($this->getName().".id", 0) : $id;

        return \FMManager\Database\Models\Roster::find($id);
    }

}