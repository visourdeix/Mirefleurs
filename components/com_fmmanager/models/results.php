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
class FmmanagerModelResults extends FMManager\Model\Frontend\Competition
{
    public function getData($id, &$params = array()) {
        $competition = parent::getCompetition($id);
        $item = new stdClass();

        if($competition->tournament->type->by_match) {
            $item->matches = $competition->matches()->with(["team1", "team2"])->get()->groupBy("matchday.name");
        } else {
            $item->matchdays = $competition->matchdays;
        }

        return $item;
    }

}