<?php
/**
 * @package      FootManager
 * @subpackage   Router
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FootManager\Router;

defined('JPATH_PLATFORM') or die;
/**
 * This class contains common methods and properties fo route item
 *
 * @package      FootManager
 * @subpackage   Router
 */
abstract class Base extends \JComponentRouterBase
{

    protected $component = "";

	/**
     * Build the route for the com_content component
     *
     * @param   array  &$query  An array of URL arguments
     *
     * @return  array  The URL arguments to use to assemble the subsequent URL.
     *
     * @since   3.3
     */
	public function build(&$query)
	{
		$segments = array();
		// We need a menu item.  Either the one specified in the query, or the current active one if none specified
		if (empty($query['Itemid']))
		{
            $menuItem = isset($this->menu->active) ? $this->menu->active : null;
			$menuItemGiven = false;
		}
		else
		{
			$menuItem = $this->menu->getItem($query['Itemid']);
			$menuItemGiven = true;
		}

		// if the menu item doesn't concern this component
        if ($menuItemGiven && isset($menuItem) && $menuItem->component != $this->component)
        {
            $menuItemGiven = false;
            unset($query['Itemid']);
        }

        $mComponent = (empty($menuItem->query['option'])) ? null : $menuItem->query['option'];
        $mView = (empty($menuItem->query['view'])) ? null : $menuItem->query['view'];
		$mId   = (empty($menuItem->query['id'])) ? null : $menuItem->query['id'];
        $id   = (empty($query['id'])) ? null : $query['id'];
        $view   = (empty($query['view'])) ? null : $query['view'];
        $component   = (empty($query['option'])) ? null : $query['option'];

        // We need to have a view and id in the query or it is an invalid URL
        if(!isset($view) || !isset($id))
            return $segments;

		// Are we dealing with an item that is attached to a menu item?
		if (isset($menuItem)
            && $mComponent == $component
			&& $mView == $view
			&& $mId == (int) $id)
		{
			unset($query['view']);

			if (isset($query['layout']))
			{
				unset($query['layout']);
			}

			unset($query['id']);

			return $segments;
		}

        $segments = array_merge($segments, $this->getSegments($component, $view, $id, $mComponent, $mView, $mId));

        unset($query['view']);
        unset($query['id']);

		/*
         * If the layout is specified and it is the same as the layout in the menu item, we
         * unset it so it doesn't go into the query string.
         */
		if (isset($query['layout']))
		{
			if ($menuItemGiven && isset($menuItem->query['layout']))
			{
				if ($query['layout'] == $menuItem->query['layout'])
				{
					unset($query['layout']);
				}
			}
			else
			{
				if ($query['layout'] == 'default')
				{
					unset($query['layout']);
				}
			}
		}

		$total = count($segments);

		for ($i = 0; $i < $total; $i++)
		{
			$segments[$i] = str_replace(':', '-', $segments[$i]);
		}

		return $segments;
	}

	/**
     * Parse the segments of a URL.
     *
     * @param   array  &$segments  The segments of the URL to parse.
     *
     * @return  array  The URL attributes to be used by the application.
     *
     * @since   3.3
     */
	public function parse(&$segments)
	{
		$total = count($segments);
		$vars = array();
        $menuItem = $this->menu->getActive();

		for ($i = 0; $i < $total; $i++)
		{
			$segments[$i] = preg_replace('/-/', ':', $segments[$i], 1);
		}

		// Count route segments
		$count = count($segments);

        if(!isset($menuItem) && $count > 1) {
            $vars["view"] = $segments[$count - 2];//$segments[0];
            if(strpos($segments[$count - 1], ":")) {
                list($id, $alias) = explode(':', $segments[$count - 1], 2);
                $vars['id'] = $id;
            }
            return $vars;
        }

        if(isset($menuItem) && $count > 0) {
            $mComponent = (empty($menuItem->query['option'])) ? null : $menuItem->query['option'];
            $mView = (empty($menuItem->query['view'])) ? null : $menuItem->query['view'];
            $mId   = (empty($menuItem->query['id'])) ? null : $menuItem->query['id'];

            $vars = $this->getVars($segments, $mComponent, $mView, $mId);
        }

		return $vars;
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

            $vars['view'] = $segments[$count - 2];
            if(strpos($segments[$count-1], ":") !== false) {
                list($id, $alias) = explode(':', $segments[$count-1], 2);
                $vars['id'] = $id;
            }
        }

        return $vars;
    }

    protected abstract function getSegments($component, $view, $id, $mComponent, $mView, $mId);
}