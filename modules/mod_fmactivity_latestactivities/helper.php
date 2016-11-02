<?php
/**
 * @package     mod_fmactivity_latestactivities
 * @subpackage  helper.php
 *
 * @copyright   Copyright (C) 2016 Stéphane ANDRE. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Helper for mod_fmactivity_latestactivities.
 *
 */
abstract class ModFmactivityLatestactivitiesHelper
{

    /**
     * Get data by javascript.
     *
     * @return string
     */
    public static function getAjax() {

        $input  = JFactory::getApplication()->input;
        $paramsToArray = (array)json_decode(base64_decode($input->get('params', "", 'BASE64')));
        $page =  $input->getInt('page', 1);

        $data = self::getActivities($paramsToArray, $page);

        ob_start();
        include JModuleHelper::getLayoutPath('mod_fmactivity_latestactivities', 'content');
        $result = ob_get_contents();
        ob_end_clean();
        return $result;
    }

    /**
     * Get the data to load.
     *
     * @param   array  $params  The module parameters.
     *
     * @return  mixed  data to load.
     */
	public static function getData(&$params)
	{
        return self::getActivities($params, 1);
	}

    /**
     * Get the data.
     *
     * @param   array  $params  The module parameters.
     *
     * @return  mixed  data to load.
     */
	private static function getActivities($params, $page = 1)
	{
        jimport('FMActivity.library');

        $limit = JArrayHelper::getValue($params, "count_activities", 10);

        $start = ($page-1)*$limit;
        if($start < 0) $start = 0;

		$result = new stdClass();

        $user = JFactory::getUser();
        $groups = $user->getAuthorisedViewLevels();

		$activities = FMActivity\Database\Models\Activity::with(["item.type", "event"])
            ->joinType()
            ->joinEvent()
            ->where("fmactivity_activities.state", "=", FootManager\Constants::PUBLISHED)
            ->where("fmactivity_items.state", "=", FootManager\Constants::PUBLISHED)
            ->whereIn("fmactivity_activities.access", $groups)
            ->whereIn("fmactivity_items.access", $groups);

        // Filter by featured state
		$featured = JArrayHelper::getValue($params, "featured", 1);
        if($featured) {
            if($featured == -1)
                $activities = $activities->where('fmactivity_activities.featured', "=", FootManager\Constants::INACTIVE);
            else
                $activities = $activities->where('fmactivity_activities.featured', "=", FootManager\Constants::ACTIVE);
        }

        // Filter by published state
		$extensions = JArrayHelper::getValue($params, "extensions", array());

		if ($extensions) $activities = $activities->whereIn('fmactivity_item_types.extension', $extensions);

        // Filter by published state
		$events = JArrayHelper::getValue($params, "events", array());

		if ($events) $activities = $activities->whereIn('fmactivity_activities.event_id', $events);

		$result->count = $activities->count();

        if($start > 0) $activities = $activities->skip($start);
        if($limit > 0) $activities = $activities->take($limit);
        $result->activities = $activities->orderBy("date", "desc")->get()->map(function($obj) { return $obj->getActivityModel(); });

        return $result;
	}
}