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
class FmmanagerModelOrganizationChart extends \FootManager\Model\Item
{

    protected function loadItem($pk) {
        $item = new stdClass();

        // Get the current season.
        $season = FMManager\Database\Models\Season::current();
        
        // Get the current season managers.
        $seasonmanagers = FMManager\Database\Models\SeasonManagers::with(["person.contacts", "_function"])->where("season_id", "=", $season->id)->get();

        $item->season = $season;
        $item->seasonmanagers = $seasonmanagers;
        
        return $item;
    }
}