<?php
/**
 * @package      pkg_useractivity
 * @subpackage   plg_useractivity_content
 *
 * @author       Tobias Kuhn (eaxs)
 * @copyright    Copyright (C) 2013 Tobias Kuhn. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 */

defined('_JEXEC') or die();

jimport("FMActivity.library");
jimport("FMManager.library");

/**
 * Content User Activity plugin
 *
 */
class plgFmactivityFmmanagerPerson
{

    private static function getItem($table) {
        return FMManager\Database\Models\Person::withoutGlobalScopes()->where("id", "=", $table->id)->first();
    }

    /**
     * Summary of setData
     * @param mixed $data
     * @param mixed $table
     * @param mixed $eventType
     */
    public static function setData(&$data, $table, $eventType) {

        $item = self::getItem($table);

        $data->title = $item->first_name." ".$item->last_name;

        if($item->category) {
            $data->category = $item->category->label;
            $data->metadata->set("color", $item->category->color);
        }

    }

    /**
     * Summary of isFeatured
     * @param mixed $table
     * @param mixed $eventType
     * @return mixed
     */
    public static function isFeatured($table, $eventType) {
        return $eventType == FMActivity\Constants::SAVE_NEW;
    }

}