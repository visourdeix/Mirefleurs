<?php
/**
 * @package     Fmmanager
 * @subpackage  mod_fmmanager_ranking
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Helper for this module.
 *
 * @since  1.5
 */
abstract class ModFmmanagerRankingHelper
{

    public static function getAjax() {
        jimport('FMManager.framework');

        $input  = JFactory::getApplication()->input;
        $params = (array)json_decode(base64_decode($input->get('params', "", 'BASE64')));

        $data = self::getRanking($params);

        if($data)
            return FootManager\Helpers\Layout::render('stats.ranking', array("ranking" => $data->ranking, "columns" => $data->columns, "params" => $params, "class" => "fm-small", "sortable" => false), '', array("component" => FM_MANAGER_COMPONENT));
        else
            return "";
    }

    /**
     * Get the data from module.
     *
     * @param   array &$params  The module parameters.
     *
     * @return  mixed  An array of articles, or false on error.
     */
	public static function getData(&$params)
	{
        $ajax_loading = JArrayHelper::getValue($params, "ajax_loading", false);
        $competition = JArrayHelper::getValue($params, "competition", 0);

        $data = new stdClass();
        $data->competition = FMManager\Database\Models\Competition::withoutGlobalScopes()->find($competition);

        if(!$ajax_loading) {
            $data->ranking = self::getRanking($params);
        }

        return $data;

	}

    /**
     * Get the ranking.
     *
     * @param   array  &$params  The module parameters.
     *
     * @return  mixed  An array of articles, or false on error.
     */
	private static function getRanking($params)
	{
        $id  = JArrayHelper::getValue($params, "competition", 0);

        if($id) {

            $type = JArrayHelper::getValue($params, "type", \FMManager\Constants::GENERAL);
            $rows = JArrayHelper::getValue($params, "rows", 0);
            $columns = JArrayHelper::getValue($params, "columns", \FMManager\Helper::$RANKING_COLUMNS);

            $competition = FMManager\Database\Models\Competition::find($id);

            if($competition) {

                $item = new stdClass();
                $item->columns = is_string($columns) ? json_decode($columns) : $columns;
                $item->ranking = $competition->getRanking($type);
                $rows = ($rows > count($item->ranking)) ? count($item->ranking) : $rows;

                if($rows > 0) {

                    $my_key = -1;
                    $start = 0;
                    foreach ($item->ranking as $row)
                    {
                        if(\FMManager\Helper::isMyClub($row->team->club_id)) {
                            $my_key = $row->rank - 1;
                            break;
                        }

                    }

                    if($my_key > -1) {
                        $rows_before = ceil(($rows - 1) / 2);
                        $start = (($my_key - $rows_before) >= 0) ? $my_key - $rows_before : 0;
                        $start = ($start + $rows > count($item->ranking)) ? (count($item->ranking) - $rows) : $start;
                    }

                    $item->ranking = $item->ranking->slice($start, $rows);
                }

                return $item;
            }
        }

        return null;
	}
}