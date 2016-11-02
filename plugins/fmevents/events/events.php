<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Content.Contact
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use FMEvents\Queries\Events;

/**
 * Contact Plugin
 *
 * @since  3.2
 */
class PlgFmeventsEvents extends JPlugin
{

    /**
     * Displays the voting area if in an article
     *
     * @param   string   $context  The context of the content being passed to the plugin
     * @param   object   &$row     The article object
     * @param   object   &$params  The article params
     * @param   integer  $page     The 'page' number
     *
     * @return  mixed  html string containing code for the votes if in com_content else boolean false
     *
     * @since   1.6
     */
	public function onContentPrepare($context, &$item, &$params)
	{
        if(FootManager\Helpers\Application::enabled('com_fmevents')) {
            jimport('FMEvents.framework');
        }

        return true;
    }

    /**
     * Determine areas searchable by this plugin.
     *
     * @return  array  An array of search areas.
     *
     * @since   1.6
     */
	public function onGetType()
	{
        jimport('FMEvents.library');
		return array(
        'com_fmevents.events' => array("title" => 'COM_FMEVENTS_FIELD_EVENTS', "icon" => "calendar")
		);
	}

    /**
     * Determine areas searchable by this plugin.
     *
     * @return  array  An array of search areas.
     *
     * @since   1.6
     */
	public function onGetCategories($types)
	{
        if(!FootManager\Helpers\Application::enabled('com_fmevents')) {
            return array();
        }

        jimport('FMEvents.library');
        $result = array();
        if(empty($types) || in_array(FM_EVENTS_COMPONENT.".events", $types) || in_array("all", $types)) {
            $categories = FootManager\Database\Models\Category::byExtension(FM_EVENTS_COMPONENT)->get();

            foreach ($categories as $category)
            {
                $children = $categories->filter(function ($obj) use($category) { return $category->id == $obj->parent_id; });

                if(count($children) > 0) continue;

                $parents = array();
                $cat = $category;
                $parent_id = $category->parent_id;

                while ($parent_id > 1)
                {
                    $cat = $categories->filter(function ($obj) use($parent_id) { return $obj->id == $parent_id; })->first();
                    $parents[] = $cat->title;
                    $parent_id = $cat->parent_id;
                }
                $parents = array_reverse($parents);
                $parents[] = $category->title;

                $result[FM_EVENTS_COMPONENT.".".$category->id] = array("title" => implode("/", $parents), "color" => $category->params["color"]);
            }
        }

		return $result;
	}

    /**
     * Plugin that retrieves contact information for contact
     *
     * @param   string   $context  The context of the content being passed to the plugin.
     * @param   mixed    &$row     An object with a "text" property
     * @param   mixed    $params   Additional parameters. See {@see PlgContentContent()}.
     * @param   integer  $page     Optional page number. Unused. Defaults to zero.
     *
     * @return  int	True on success.
     */
	public function onGetCount($start, $end, $types, $categories)
	{
        $query = $this->getQuery($start, $end, $types, $categories);
        return !empty($query) ? $query->count() : 0;
    }

    /**
     * Plugin that retrieves contact information for contact
     *
     * @param   string   $context  The context of the content being passed to the plugin.
     * @param   mixed    &$row     An object with a "text" property
     * @param   mixed    $params   Additional parameters. See {@see PlgContentContent()}.
     * @param   integer  $page     Optional page number. Unused. Defaults to zero.
     *
     */
	public function onGetEvents($start_date, $end_date, $types, $categories, $start = 0, $limit = 0)
	{
        $query = $this->getQuery($start_date, $end_date ,$types, $categories);

        if($query) {
            $query = $query->with(["location"])
                        ->orderBy("start_date")
                        ->orderBy("start_time");
            if($start) $query = $query->offset($start);
            if($limit) $query = $query->take($limit);

            $events = $query->get()->map(function($obj) { return $obj->toCalendar(); });

            return $events;
        }

        return array();
    }

	/**
     * Summary of getQuery
     * @param mixed $types
     * @param mixed $categories
     * @return mixed
     */
	protected function getQuery($start, $end, $types, $categories)
	{
        if(!FootManager\Helpers\Application::enabled('com_fmevents')) {
            return null;
        }

        jimport('FMEvents.library');
        if(in_array("all", $types) || in_array(FM_EVENTS_COMPONENT.'.events', $types)) {

            if(!in_array("all", $categories)) {
                $categories = array_filter($categories, function ($obj) {
                    if($obj != "all") {
                        $component = explode(".", $obj, 2)[0];
                        return $component == FM_EVENTS_COMPONENT;
                    }
                    return true;
    });
            } else {
                $categories = array_keys($this->onGetCategories($types));
            }

            $categories = array_map(function ($obj) {
                $id = explode(".", $obj, 2)[1];
                return $id;
            }, $categories);

            if($categories) {
                return FMEvents\Database\Models\Event::withoutGlobalScopes()
                        ->whereIn("catid", $categories)
                    ->betweenDates($start, $end)
                        ->where("state", "=", 1)
                        ->whereHas("category", function($query) {
                            $query->where("published", "=", 1);
                });
            }
        }
        return null;
    }

}