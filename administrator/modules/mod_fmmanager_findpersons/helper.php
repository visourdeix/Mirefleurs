<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  mod_latest
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Helper for mod_latest
 *
 * @since  1.5
 */
abstract class ModFmmanagerFindpersonsHelper
{

	public static function getAjax() {

        jimport('FMManager.framework');

        $input  = JFactory::getApplication()->input;
        $params = (array)json_decode(base64_decode($input->get('params', "", 'BASE64')));

        $list = self::getData($params);

        return FootManager\Helpers\Layout::render('html.thumbnails', array("items" => $list, "layout" => "person.thumbnail", "params" => $params, "component" => FM_MANAGER_COMPONENT));
    }

	/**
     * Get a list of articles.
     *
     * @param   \Joomla\Registry\Registry  &$params  The module parameters.
     *
     * @return  mixed  An array of articles, or false on error.
     */
	public static function getData(&$params)
	{
        // Params
        $name = isset($params["name"]) ? $params["name"] : "";
        if($name) {
            $name = "%".$name."%";
            $items = \FMManager\Database\Models\Person::with(["contacts"])->where("last_name", "LIKE", $name)->orWhere("first_name", "LIKE", $name)->get();
            return $items;
        } else {
            return array();
        }
	}

}