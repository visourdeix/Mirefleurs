<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  mod_version
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Helper for mod_version
 *
 * @since  1.6
 */
abstract class ModFmmanagerVersionsHelper
{
    /**
     * Get a list of articles.
     *
     * @param   array  &$params  The module parameters.
     *
     * @return  mixed  An array of articles, or false on error.
     */
	public static function getData(&$params)
	{

        $data = new stdClass();
        $data->version = self::getVersion($params);
        $data->joomlaVersion = self::getJoomlaVersion($params);

        return $data;
	}

	/**
     * Get the member items of the submenu.
     *
     * @param   array  &$params  The parameters object.
     *
     * @return  string  String containing the current Joomla version based on the selected format.
     */
	private static function getVersion(&$params)
	{
        $format  = JArrayHelper::getValue($params, "format", "short");
        $product  = JArrayHelper::getValue($params, "product", 0);
        $method  = 'get' . ucfirst($format) . "Version";

		// Get the joomla version
		$instance = new FootManager\Version();
        $version  = call_user_func(array($instance, $method));

        if ($format == 'short' && !empty($product))
        {
            // Add the product name to short format only (in long format it's included)
            $version = $instance->product . ' ' . $version;
        }

		return $version;
	}

    /**
     * Get the member items of the submenu.
     *
     * @param   array  &$params  The parameters object.
     *
     * @return  string  String containing the current Joomla version based on the selected format.
     */
	private static function getJoomlaVersion(&$params)
	{
        $format  = JArrayHelper::getValue($params, "format", "short");
        $product  = JArrayHelper::getValue($params, "product", 0);
        $method  = 'get' . ucfirst($format) . "Version";

		// Get the joomla version
		$instance = new JVersion;
        $version  = call_user_func(array($instance, $method));

        if ($format == 'short' && !empty($product))
        {
            // Add the product name to short format only (in long format it's included)
            $version = $instance->PRODUCT . ' ' . $version;
        }

		return $version;
	}
}