<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$competition = JArrayHelper::getValue($displayData, "competition");
$active = JArrayHelper::getValue($displayData, "active", "");

$links = array();

if($competition->has_ranking) $links[] = array("view" => "ranking", "icon" => "fa fa-bars");
$links[] = array("view" => "results", "icon" => "fa fa-calendar");

$tabs = array();

foreach ($links as $link)
{
    $class = "";
    $url = FmmanagerHelperRoute::competition($competition, $link["view"]);
    if($active == $link["view"]) {
        $class = 'active';
        $url = "#";
    }
	$tabs[] = array("label" => JText::_(strtoupper(FM_MANAGER_COMPONENT.'_'.$link["view"])), "icon" => $link["icon"], "class" => $class, "link" => $url);
}

echo FootManager\Helpers\Layout::render('html.links.tabs', array("tabs" => $tabs))

?>