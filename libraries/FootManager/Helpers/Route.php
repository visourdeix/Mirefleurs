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
abstract class Route
{
    protected static $lookup = array();

    /**
     * Find an item ID.
     *
     * @param   array  $needles  An array of language codes.
     *
     * @return  mixed  The ID found or null otherwise.
     *
     * @since   1.5
     */
	public static function findItem($needles = null, $componentName, $default_itemid = 0)
	{
		$app      = \JFactory::getApplication();
		$menus    = $app->getMenu('site');

        $component  = \JComponentHelper::getComponent($componentName);

        $attributes = array('component_id');
        $values     = array($component->id);

        $items = $menus->getItems($attributes, $values);

        foreach ($items as $item)
        {
            if (isset($item->query) && isset($item->query['view']))
            {
                $view = $item->query['view'];

                if (!isset(self::$lookup[$view]))
                {
                    self::$lookup[$view] = array();
                }

                $menu_id = (isset($item->query['id']) ? $item->query['id'] : 0 );

                /**
                 * Here it will become a bit tricky
                 * language != * can override existing entries
                 * language == * cannot override existing entries
                 */
                if (!isset(self::$lookup[$view][$menu_id]) || $item->language != '*')
                {
                    self::$lookup[$view][$menu_id] = $item->id;
                }
            }

        }

		if ($needles)
		{
			foreach ($needles as $view => $ids)
			{
				if (isset(self::$lookup[$view]))
				{
					foreach ((array)$ids as $id)
					{
						if (isset(self::$lookup[$view][(int) $id]))
						{
							return self::$lookup[$view][(int) $id];
						}
					}
				}
			}
		}

		// Check if the active menuitem matches the requested language
		$active = $menus->getActive();
        $default = $menus->getDefault();

		if ($active && $active->id != $default->id)
		{
			return $active->id;
		}

        if($default_itemid > 0) return $default_itemid;

        // If not found, return language specific home link

		return !empty($default->id) ? $default->id : null;
	}

}