<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$roster = JArrayHelper::getValue($displayData, "roster");
$active = JArrayHelper::getValue($displayData, "active", "");
$user = JFactory::getUser();

$links = array();
$links[] = array("view" => "roster", "icon" => "fa fa-info-circle");
$links[] = array("view" => "players", "icon" => "fa fa-users");
$links[] = array("view" => "events", "icon" => "fa fa-calendar");
$links[] = array("view" => "teamstats", "icon" => "fm-icon-pie-chart");

if($user->authorise( "stats.view", FM_MANAGER_COMPONENT.".category." . $roster->category->id ))
    $links[] = array("view" => "playersstats", "icon" => "fm-icon-podium");

$tabs = array();

foreach ($links as $link)
{
    $class = "";
    $url = FmmanagerHelperRoute::roster($roster, $link["view"]);
    if($active == $link["view"]) {
        $class = 'active';
        $url = "#";
    }
	$tabs[] = array("label" => JText::_(strtoupper(FM_MANAGER_COMPONENT.'_'.$link["view"])), "icon" => $link["icon"], "class" => $class, "link" => $url);
}

echo FootManager\Helpers\Layout::render('html.links.tabs', array("tabs" => $tabs))

?>