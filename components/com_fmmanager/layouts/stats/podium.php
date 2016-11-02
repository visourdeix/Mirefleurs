<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

$statistics = JArrayHelper::getValue($displayData, "statistics", array());
$value = JArrayHelper::getValue($displayData, "value", "");
$params = JArrayHelper::getValue($displayData, "params", array());
$ajax = JArrayHelper::getValue($params, "ajax_loading", false);

if($value) {
    $data = array("params" =>$params);

    $i = 1;
    foreach ($statistics as $statistic)
    {
        if($statistic->$value)
            $data["item_".$i] = FootManager\Helpers\Layout::render("person.thumbnail", array("item" => $statistic->person, "value" => $statistic->$value, "class" => "fm-small fm-thumbnail", "params" => $params));
        if($i >= 3) break;
        $i++;
    }

    echo FootManager\Helpers\Layout::render("charts.podium", $data);
}

?>