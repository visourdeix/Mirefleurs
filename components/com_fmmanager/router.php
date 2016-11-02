<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use \FMManager\Database\Models;

// Include library
jimport("FMManager.library");

/**
 * Routing class from com_content
 *
 * @since  3.3
 */
class FmmanagerRouter extends \FootManager\Router\Base
{

    protected $component = FM_MANAGER_COMPONENT;

    protected function getSegments($component, $view, $id, $mComponent, $mView, $mId) {
        $segments = array();
        $addViewInSegments = true;
        $title = "";
        switch ($view)
        {
            case "stadium":
                $result = Models\Stadium::withoutGlobalScopes()->find($id);
                $title = isset($result) ? $result->name : "";
                break;

            case "person":
                $result = Models\Person::withoutGlobalScopes()->find($id);
                $title = isset($result) ? $result->name : "";
                break;

            case "roster":
            case "players":
            case "teamstats":
            case "playersstats":
            case "events":
                $addTitle = false;
                if($mComponent == $component && $mView == $view && $mId != $id) {
                    $addViewInSegments = false;
                    $addTitle = true;
                }
                elseif($mComponent == $component && ($mView == 'roster' || $mView == 'players' || $mView == 'teamstats' || $mView == 'playersstats' || $mView == 'events') && $mId == $id) {
                    $addViewInSegments = true;
                } else {
                    $addTitle = true;
                }

                if($addTitle) {
                    $result = Models\Roster::find($id);
                    $title = isset($result) ? $result->name : "";
                }

                break;

            case "matchday":
                $result = Models\Matchday::withoutGlobalScopes()->find($id);
                if($result) {
                    if($mView != "ranking" && $mView != "results")
                        $segments[] = JApplication::stringURLSafe($result->competition->name);
                    $title = $result->name;
                }
                break;

            case "match":
                $result = Models\Match::withoutGlobalScopes()->find($id);
                if($result) {
                    if($mView != "ranking" && $mView != "results")
                        $segments[] = JApplication::stringURLSafe($result->matchday->competition->name);
                    $segments[] = JApplication::stringURLSafe($result->matchday->name);
                    $title = $result->team1->small_name."-".$result->team2->small_name;
                }
                break;

            case "ranking":
            case "results":
                $addTitle = false;
                if($mComponent == $component && $mView == $view && $mId != $id) {
                    $addViewInSegments = false;
                    $addTitle = true;
                }
                elseif($mComponent == $component && ($mView == 'ranking' || $mView == 'results') && $mId == $id) {
                    $addViewInSegments = true;
                } else {
                    $addTitle = true;
                }

                if($addTitle) {
                    $result = Models\Competition::withoutGlobalScopes()->find($id);
                    $title = isset($result) ? $result->name : "";
                }
                break;

            case "managers":
            case "staff":
                $result = Models\Season::withoutGlobalScopes()->find($id);
                $title = isset($result) ? $result->label : "";
                break;

        }

        // Add view in segments
        if($addViewInSegments) $segments[] = $view;

        if($title) $segments[] = $id . ':' . JApplication::stringURLSafe($title);

        return $segments;
    }

}

/**
 * Content router functions
 *
 * These functions are proxys for the new router interface
 * for old SEF extensions.
 *
 * @param   array  &$query  An array of URL arguments
 *
 * @return  array  The URL arguments to use to assemble the subsequent URL.
 *
 * @deprecated  4.0  Use Class based routers instead
 */
function fmmanagerBuildRoute(&$query)
{
	$router = new FmmanagerRouter();

	return $router->build($query);
}

/**
 * Parse the segments of a URL.
 *
 * This function is a proxy for the new router interface
 * for old SEF extensions.
 *
 * @param   array  $segments  The segments of the URL to parse.
 *
 * @return  array  The URL attributes to be used by the application.
 *
 * @since   3.3
 * @deprecated  4.0  Use Class based routers instead
 */
function fmmanagerParseRoute($segments)
{
	$router = new FmmanagerRouter();

	return $router->parse($segments);
}