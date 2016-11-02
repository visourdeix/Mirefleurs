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
 * Summary of Season.
 */
abstract class Season extends \FootManager\Model\Ajax
{
    protected function loadItem($pk) {
        $item = new \stdClass();

        $seasons = \FMManager\Database\Models\Season::all();
        $item->season = $seasons->find($pk);
        $item->seasons = $seasons->except($pk);

        return $item;
    }

    /**
     * Get the current season.
     * @param int $id
     * @return \FMManager\Database\Models\Season
     */
    public function getSeason($id = null) {
        $id = (!$id) ? $this->getState($this->getName().".id", 0) : $id;

        return \FMManager\Database\Models\Season::find($id);
    }

}