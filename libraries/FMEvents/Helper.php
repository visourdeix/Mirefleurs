<?php
/**FMClub
 * @package      pkg_foomanager
 * @subpackage   lib_FootManager
 *
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 */

namespace FMEvents;

defined('_JEXEC') or die();

/**
 * Get functions related to a person.
 *
 */
abstract class Helper {

    /**
     * Search data array
     *
     * @var array
     */
	protected static $_types = null;

    /**
     * Search data array
     *
     * @var array
     */
	protected static $_categories = null;

    /**
     * Gets the image full path.
     * @return mixed
     */
    public static function getEventPhoto($rel_path) {
        return self::getFullPath($rel_path, "empty_event_photo");
    }

    /**
     * Gets the image full path.
     * @return mixed
     */
    public static function getLocationPhoto($rel_path) {
        return self::getFullPath($rel_path, "empty_location_photo");
    }

    /**
     * Gets the image full path.
     * @return mixed
     */
    public static function getFullPath($rel_path, $default = "") {
        return \FootManager\Utilities\FileHelper::getFullPath($rel_path, $default, FM_EVENTS_COMPONENT);
    }

    /**
     * Method to get the search areas
     *
     * @return array
     *
     * @since 1.5
     */
	public static function getTypes()
	{
		// Load the Category data
		if (empty(self::$_types))
		{
			$types = array();

			\JPluginHelper::importPlugin('fmevents');
			$dispatcher  = \JEventDispatcher::getInstance();
			$searchtypes = $dispatcher->trigger('onGetType');

			foreach ($searchtypes as $type)
			{
				if (is_array($type))
				{
					$types = array_merge($types, $type);
				}
			}

			self::$_types = $types;
		}

		return self::$_types;
	}

    /**
     * Method to get the search areas
     *
     * @return array
     *
     * @since 1.5
     */
	public static function getCategories()
	{
		// Load the Category data
		if (empty(self::$_categories))
		{
			$categories = array();

			\JPluginHelper::importPlugin('fmevents');
			$dispatcher  = \JEventDispatcher::getInstance();
			$searchcategories = $dispatcher->trigger('onGetCategories', array(array_keys( self::getTypes())));

			foreach ($searchcategories as $category)
			{
				if (is_array($category))
				{
					$categories = array_merge($categories, $category);
				}
			}

			self::$_categories = $categories;
		}

		return self::$_categories;
	}

    /**
     * Get all events.
     *
     * @access public
     */
	public static function getEvents($start_date = "", $end_date = "", $types = array(), $categories  = array(), $start = 0, $limit = 0)
	{
        $counts = \FootManager\Helpers\Plugin::trigger(FM_EVENTS, "onGetCount", array($start_date, $end_date, $types, $categories));
        $results = \FootManager\Helpers\Plugin::trigger(FM_EVENTS, "onGetEvents", array($start_date, $end_date, $types, $categories, 0, $start + $limit));

        $events = new \Illuminate\Database\Eloquent\Collection();

        $count = array_sum($counts);

        foreach ($results as $result)
            foreach ($result as $item) {
                if($item instanceof \FootManager\Calendar\Event) {
                    $events->push($item);
                }
            }

        $result = new \stdClass();
        $result->events =$events->sortBy(function($obj) { return $obj->start; });

        if($start || $limit) {
            $result->events = $result->events->slice($start, $limit);
        }

        $result->count = $count;
        return $result;
	}

}

?>