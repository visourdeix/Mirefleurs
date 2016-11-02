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
jimport("FMGallery.library");

/**
 * Routing class from com_content
 *
 * @since  3.3
 */
class FmgalleryRouter extends \FootManager\Router\Base
{

    protected $component = FM_GALLERY_COMPONENT;

    protected function getSegments($component, $view, $id, $mComponent, $mView, $mId) {
        $segments = array();

        //if($mComponent != $component && $mView != $view)
        //    $segments[] = $view;

        switch ($view)
        {
            case "photos":
            case "videos":
            case "files":

                $categories = JCategories::getInstance('Fmgallery');
                $category = $categories->get($id);

                // We couldn't find the category we were given.  Bail.
                if (!$category) return $segments;

                $path = $category->getPath();

                foreach ($path as $path_id)
                {
                    list($catid, $path_id) = explode(':', $path_id, 2);

                    if ((int) $catid != $mId && $catid != $category->id)
                        $segments[] = $path_id;

                }

                $segments[] = $catid . ':' . $path_id;

                if($view != "category") $segments[] = $view;

                break;

            case "video":
                $video = FMGallery\Database\Models\Video::find($id);
                $categories = JCategories::getInstance('Fmgallery');
                $category = $categories->get($video->catid);

                // We couldn't find the category we were given.  Bail.
                if (!$category) return $segments;

                $path = $category->getPath();

                foreach ($path as $path_id)
                {
                    list($catid, $path_id) = explode(':', $path_id, 2);

                    if ((int) $catid != $mId)
                        $segments[] = $path_id;

                }

                $segments[] = $id . ':' . JApplication::stringURLSafe($video->title);
                $segments[] = $view;

                break;

        }

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
            $vars['view'] = ($mComponent == $this->component) ? $mView : "photos";
            if(strpos($segments[$count-1], ":") !== false) {
                list($id, $alias) = explode(':', $segments[$count-1], 2);
                $vars['id'] = $id;
            } else {
                list($id, $alias) = explode(':', $segments[$count-2], 2);
                $vars['id'] = $id;
                $vars['view'] = $segments[$count-1];
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
function fmgalleryBuildRoute(&$query)
{
	$router = new FmgalleryRouter();

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
function fmgalleryParseRoute($segments)
{
	$router = new FmgalleryRouter();

	return $router->parse($segments);
}