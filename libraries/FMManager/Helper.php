<?php
/**FMClub
 * @package      pkg_foomanager
 * @subpackage   lib_FootManager
 *
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 */

namespace FMManager;

defined('_JEXEC') or die();

/**
 * Get functions related to a person.
 *
 */
abstract class Helper {

    static $RANKING_COLUMNS = array("points", "played", "victories", "victories_to_penalties", "draws", "defeats", "defeats_to_penalties", "withdraws", "bonus", "scored", "conceded", "difference", "serie");

    static $RANKING_SORT = array("points", "difference", "scored", "victories", "victories_to_penalties");

    /**
     * Get types.
     * @param mixed $withNeutral
     * @return mixed
     */
    public static function getTypes($withNeutral = true) {

        $types = array(
    array("label" => \JText::_("FM_GENERAL"), "value" => Constants::GENERAL, "icon" => "star"),
    array("label" => \JText::_("FM_HOME"), "value" => Constants::HOME, "icon" => "home"),
    array("label" => \JText::_("FM_AWAY"), "value" => Constants::AWAY, "icon" => "bus")
    );

        if($withNeutral) $types[] = array("label" => \JText::_("FM_NEUTRAL"), "value" => Constants::NEUTRAL, "icon" => "circle");

        return $types;
    }

    /**
     * Gets the image full path.
     * @return mixed
     */
    public static function getClubLogo($rel_path) {
        return self::getFullPath($rel_path, "empty_club_logo");
    }

    /**
     * Gets the image full path.
     * @return mixed
     */
    public static function getPersonPhoto($rel_path) {
        return self::getFullPath($rel_path, "empty_person_photo");
    }

    /**
     * Gets the image full path.
     * @return mixed
     */
    public static function getStadiumPhoto($rel_path) {
        return self::getFullPath($rel_path, "empty_stadium_photo");
    }

    /**
     * Gets the image full path.
     * @return mixed
     */
    public static function getTournamentLogo($rel_path) {
        return self::getFullPath($rel_path, "empty_tournament_logo");
    }

    /**
     * Gets the image full path.
     * @return mixed
     */
    public static function getRosterPhoto($rel_path) {
        return self::getFullPath($rel_path, "empty_roster_photo");
    }

    /**
     * Gets the image full path.
     * @return mixed
     */
    public static function getStatisticImage($rel_path) {
        return self::getFullPath($rel_path, "empty_statistic_image");
    }

    /**
     * Gets the image full path.
     * @return mixed
     */
    public static function getGroundImage($rel_path) {
        return self::getFullPath($rel_path, "empty_ground_image");
    }

    /**
     * Gets the image full path.
     * @return mixed
     */
    public static function getFullPath($rel_path, $default = "") {
        return \FootManager\Utilities\FileHelper::getFullPath($rel_path, $default, FM_MANAGER_COMPONENT);
    }

    /**
     * Gets my club Id.
     * @param mixed $person_id
     * @return mixed
     */
    public static function getMyClubId() {
        $id = \FootManager\Helpers\Application::getConfiguration(FM_MANAGER_COMPONENT)->get("my_club");

        return ($id) ? $id : 0;
    }

    /**
     * Gets the table instance of my club.
     * @return mixed
     */
    public static function isMyClub($club_id) {
        return $club_id == self::getMyClubId();
    }

}

?>