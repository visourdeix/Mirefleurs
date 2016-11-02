<?php
/**
 * @package     mod_fmevents_nextevents
 * @subpackage  helper.php
 *
 * @copyright   Copyright (C) 2016 Stéphane ANDRE. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Helper for mod_fmevents_nextevents.
 *
 */
abstract class ModFmeventsNexteventsHelper
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

        $data = self::getEvents($paramsToArray, $page);

        ob_start();
        include JModuleHelper::getLayoutPath('mod_fmevents_nextevents', 'content');
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
        return self::getEvents($params, 1);
	}

    /**
     * Get the data.
     *
     * @param   array  $params  The module parameters.
     *
     * @return  mixed  data to load.
     */
	private static function getEvents($params, $page = 1)
	{
        jimport('FMEvents.library');

        $categories = JArrayHelper::getValue($params, "categories", array());
        $types = JArrayHelper::getValue($params, "types", array());
        $limit = JArrayHelper::getValue($params, "count_events", 10);
        $group = JArrayHelper::getValue($params, "group_by", "");

        if(in_array("all", $categories)) $categories = array_keys(FMEvents\Helper::getCategories());
        if(in_array("all", $types)) $types = array_keys(FMEvents\Helper::getTypes());

        $start = ($page-1)*$limit;
        if($start < 0) $start = 0;

        $result = \FMEvents\Helper::getEvents(date("Y-m-d H:i"), null, $types, $categories, $start, $limit);

        if($group) {
            $result->events = $result->events->groupBy(function($obj) use($group) {
                $format = "";
                switch ($group)
                {
                    case "day" :
                        $date = date('Y-m-d', strtotime($obj->start));
                        $today = date('Y-m-d');
                        $tomorrow = date('Y-m-d', strtotime('tomorrow'));

                        if($date == $today) {
                            return JText::_("MOD_FMEVENTS_NEXTEVENTS_TODAY");
                        } elseif($date == $tomorrow) {
                            return JText::_("MOD_FMEVENTS_NEXTEVENTS_TOMORROW");
                        } else {
                            $format = "l d F";
                        }
                        break;

                    default :
                        $format = "F";
                }

                if($format) {
                    $date = new JDate($obj->start);
                    return $date->format($format);
                }

                return "";
            });
        }

        return $result;
	}
}