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
class FmmanagerModelRanking extends \FMManager\Model\Frontend\Competition
{

    public function loadItem($pk) {
        $item = parent::loadItem($pk);
        $item->types = FMManager\Helper::getTypes(false);

        return $item;
    }

    public function getData($id, &$params = array()) {
        $competition = parent::getCompetition($id);
        $item = new stdClass();

        // Params
        $type = JArrayHelper::getValue($params, "type", \FMManager\Constants::GENERAL);
        $show_logo = JArrayHelper::getValue($params, "ranking_show_logo", true);
        $show_name = JArrayHelper::getValue($params, "ranking_show_name", "small_name");
        $show_legend = JArrayHelper::getValue($params, "ranking_show_legend", true);
        $count_in_series = JArrayHelper::getValue($params, "ranking_count_in_series", 3);
        $columns = JArrayHelper::getValue($params, "ranking_columns", "");
        if(is_string($columns)) $columns = json_decode($columns);

        $item->legend = $competition->ranking_legend;
        $item->columns = $columns ? $columns : FMManager\Helper::$RANKING_COLUMNS;
        $item->ranking = $competition->getRanking($type);

        $params["show_logo"] = $show_logo;
        $params["show_name"] = $show_name;
        $params["show_legend"] = $show_legend;
        $params["count_in_series"] = $count_in_series;

        return $item;
    }
}