<?php
/**
 * @package      FootManager
 * @subpackage   Helpers
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FootManager\Helpers;

defined('JPATH_PLATFORM') or die;
/**
 * This class contains common methods and properties for a database item
 *
 * @package      FootManager
 * @subpackage   Helpers
 */
abstract class Application
{
    /**
     * Holds the FootManager related components
     *
     * @var    array
     */
    protected static $components;

    /**
     * URL routing cache
     *
     * @var    array
     */
    protected static $routes;

    /**
     * Method to get all FootManager related components
     * (starting with com_pf)
     *
     * @return    array
     */
    public static function getComponents()
    {
        if (is_array(self::$components)) {
            return self::$components;
        }

        $db = \JFactory::getDbo();
        $query = $db->getQuery(true);

        $query->select('extension_id, element, client_id, enabled, access, protected')
              ->from('#__extensions')
              ->where('type = ' . $db->quote('component'))
              ->order('extension_id ASC');

        $db->setQuery($query);
        $items = (array) $db->loadObjectList();
        $com   = array();

        foreach ($items AS $item)
        {
            $el = $item->element;

            $com[$el] = $item;
        }

        self::$components = $com;

        return self::$components;
    }

    /**
     * Method to check if a component exists or not
     *
     * @param     string     $name    The name of the component
     *
     * @return    boolean
     */
    public static function exists($name)
    {
        $components = self::getComponents();

        if (!array_key_exists($name, $components)) {
            return false;
        }

        return true;
    }

    /**
     * Method to check if a component is enabled or not
     *
     * @param     string    $name    The name of the component
     *
     * @return    mixed              Returns True if enabled, False if not, and NULL if not found.
     */
    public static function enabled($name)
    {
        $components = self::getComponents();

        if (!array_key_exists($name, $components)) {
            return null;
        }

        if ($components[$name]->enabled == '0') {
            return false;
        }

        return true;
    }

    /**
     * Get the component parameters.
     * @param mixed $component
     * @return \Joomla\Registry\Registry
     */
    public static function getConfiguration($component = "") {

		if(empty($component))
			$component = self::getActiveComponent();

        return \JComponentHelper::getParams($component);
    }

    /**
     * Get the component parameters.
     * @param mixed $component
     * @return \Joomla\Registry\Registry
     */
    public static function getActiveComponent() {
	    return  \JFactory::getApplication()->input->get('option');
    }

    /**
     * Method to get the menu items for the component.
     *
     * @return  array  	An array of menu items.
     *
     * @since   1.6
     */
	public static function &getMenus($component)
	{
		static $items;

		// Get the menu items for this component.
		if (!isset($items))
		{
			$app   = \JFactory::getApplication();
			$menu  = $app->getMenu();
			$com   = \JComponentHelper::getComponent($component);
			$items = $menu->getItems('component_id', $com->id);

			// If no items found, set to empty array.
			if (!$items)
			{
				$items = array();
			}
		}

		return $items;
	}

    /**
     * Method to get a route configuration for the login view.
     *
     * @return  mixed  	Integer menu id on success, null on failure.
     *
     * @since   1.6
     * @static
     */
	public static function getMenuId($component, $view, $id = null)
	{
        static $menus = array();

        $saveId = ($id == null) ? 0 : $id;
        $itemid = "";

        if(isset($menus[$view][$saveId]))
            $itemid = $menus[$view][$saveId];
        else {

            // Get the items.
            $items  = self::getMenus($component);

            // Search for a suitable menu id.
            foreach ($items as $item)
            {
                if (isset($item->query['view']) && $item->query['view'] === $view && ($id == null || (isset($item->query['id']) && $item->query['id'] === $id)))
                {
                    $itemid = $item->id;
                    $menus[$view][$saveId] = $itemid;
                    break;
                }
            }

        }

		return $itemid;
	}

    /**
     * Method to get a route configuration for the login view.
     *
     * @return  mixed  	Integer menu id on success, null on failure.
     *
     * @since   1.6
     * @static
     */
	public static function getActiveMenu()
	{
        // Get active menu.
        $app   = \JFactory::getApplication();
        $menu  = $app->getMenu();

        return $menu->getActive();
	}

    /**
     * Method to get a route configuration for the login view.
     *
     * @return  mixed  	Integer menu id on success, null on failure.
     *
     * @since   1.6
     * @static
     */
	public static function getActiveMenuId()
	{
        $active = self::getActiveMenu();
        if($active)
            return $active->id;

        return 0;
	}

}