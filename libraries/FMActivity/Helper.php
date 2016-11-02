<?php
/**FMClub
 * @package      pkg_foomanager
 * @subpackage   lib_FootManager
 *
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 */

namespace FMActivity;

defined('_JEXEC') or die();

/**
 * Get functions related to a person.
 *
 */
abstract class Helper {

    /**
     * Method to get the event id from an item state
     *
     * @param     integer    $state    The item state
     *
     * @return    integer              The event id
     */
    public static function getEventFromState($state)
    {
        switch ((int) $state)
        {
            case 0:
                return \FMActivity\Constants::UNPUBLISH;

            case 1:
                return \FMActivity\Constants::PUBLISH;

            case 2:
                return \FMActivity\Constants::ARCHIVE;

            case -2:
                return \FMActivity\Constants::TRASH;
        }

        return 0;
    }

    /**
     * Method to get the event id from an item state
     *
     * @param     integer    $state    The item state
     *
     * @return    integer              The event id
     */
    public static function getEventId($event)
    {
        return (int)Database\Models\Event::where("name", "=", $event)->first()->id;
    }
}

?>