<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
jimport("FMEvents.library");

/**
 * Content Component Route Helper.
 *
 * @since  1.5
 */
abstract class FmeventsHelperRoute
{
    /**
     * Get the category route.
     *
     * @param   integer  $catid     The category ID.
     * @param   integer  $language  The language code.
     *
     * @return  string  The article route.
     *
     * @since   1.5
     */
	public static function calendar($language = 0)
	{
        return self::route("calendar", 0);
	}

    /**
     * Get the article route.
     *
     * @param   integer  $id        The route of the content item.
     * @param   integer  $catid     The category ID.
     * @param   integer  $language  The language code.
     *
     * @return  string  The article route.
     *
     * @since   1.5
     */
	public static function event($item)
	{
        $needles["calendar"] = 0;
        return self::route('event', $item, $needles);
	}

    /**
     * Route an item.
     * @param string $view
     * @param mixed $item
     * @param array $needles
     * @return string
     */
	public static function route($view, $item, $needles = array())
	{

        $id = ($item instanceof Illuminate\Database\Eloquent\Model) ? $item->id : $item;
        $needles               = array_merge(array($view => $id), $needles);
        $link = 'index.php?';
        $params["option"] = FM_EVENTS_COMPONENT;
        $params["view"] = $view;
        if($id) $params["id"] = $id;

        if ($item = FootManager\Helpers\Route::findItem($needles, FM_EVENTS_COMPONENT))
            $params["Itemid"] = $item;

        $link = $link.FootManager\Utilities\UrlHelper::prepareParameters($params);

		return JRoute::_($link);
	}
}