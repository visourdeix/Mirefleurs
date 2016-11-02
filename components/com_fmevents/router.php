<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include library
jimport("FMEvents.library");

/**
 * Routing class from com_content
 *
 * @since  3.3
 */
class FmeventsRouter extends \FootManager\Router\Base
{

    protected $component = FM_EVENTS_COMPONENT;

    protected function getSegments($component, $view, $id, $mComponent, $mView, $mId) {
        $segments = array();

        $title = "";

        switch ($view)
        {
            case"calendar":
                break;

            case "event":
                $event = FMEvents\Database\Models\Event::find($id);

                $categories = JCategories::getInstance('Fmevents');
                $category = $categories->get($event->catid);

                $path = $category->getPath();

                foreach ($path as $path_id)
                {
                    list($catid, $path_id) = explode(':', $path_id, 2);
                    $segments[] = $path_id;

                }

                $title = isset($event) ? $event->title : "";
                break;

        }

        if($mComponent != $component)
            $segments[] = $view;

        if($title)
            $segments[] = $id . ':' . JApplication::stringURLSafe($title);

        return $segments;
    }

    protected function getVars($segments, $mComponent, $mView, $mId) {
        $vars = array();
        $count = count($segments);

        if($mComponent == $this->component && $count == 1) {
            $segment = $segments[0];

            if(strpos($segment, ":") !== false) {
                list($id, $alias) = explode(':', $segment, 2);
                $vars['view'] = $mView;
                $vars['id'] = $id;
            } else {
                $vars['view'] = $segment;
                $vars['id'] = $mId;
            }

        } elseif($count > 1) {
            $vars['view'] = "event";
            if(strpos($segments[$count-1], ":") !== false) {
                list($id, $alias) = explode(':', $segments[$count-1], 2);
                $vars['id'] = $id;
            }
        }

        return $vars;
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
function fmeventsBuildRoute(&$query)
{
	$router = new FmeventsRouter();

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
function fmeventsParseRoute($segments)
{
	$router = new FmeventsRouter();

	return $router->parse($segments);
}