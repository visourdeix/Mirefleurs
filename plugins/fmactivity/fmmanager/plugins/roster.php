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
class plgFmactivityFmmanagerRoster
{

    private static function getItem($table) {
        return FMManager\Database\Models\Roster::withoutGlobalScopes()->where("id", "=", $table->id)->first();
    }

    /**
     * Summary of setData
     * @param mixed $data
     * @param mixed $table
     * @param mixed $eventType
     */
    public static function setData(&$data, $table, $eventType) {
        $item = self::getItem($table);

        $data->title = $item->name;
        $data->category = $item->category->label;

    }

}