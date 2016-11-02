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
class plgFmactivityFmmanagerTraining
{

    private static function getItem($table) {
        return FMManager\Database\Models\Training::withoutGlobalScopes()->where("id", "=", $table->id)->first();
    }

    /**
     * Summary of setData
     * @param mixed $data
     * @param mixed $table
     * @param mixed $eventType
     */
    public static function setData(&$data, $table, $eventType) {
        $item = self::getItem($table);

        $date = new JDate($table->date);

        $data->title = JText::sprintf("PLG_FMACTIVITY_FMMANAGER_TRAINING_TITLE", $date->format("d F Y"));
        $data->description = $item->rosters->implode("small_name", ", ");
        $data->category = $item->rosters->implode("small_name", ", ");

    }

}