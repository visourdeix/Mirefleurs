<?php
/**
 * @package      FootManager
 * @subpackage   Utilities
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FootManager\Utilities;

defined('JPATH_PLATFORM') or die;

/**
 * This is a class that provides functionality for managing urls.
 *
 * @package      FootManager\Utilities
 * @subpackage   Urls
 */
abstract class UrlHelper
{
    /**
     * Generate URI string from additional parameters.
     *
     * @param array $options
     *
     * @return string
     */
    public static function prepareParameters(array $params)
    {
        $str_params = array();

        foreach ($params as $key => $value) {
            $str_params[] = $key . '=' . $value;
        }

        return implode("&", $str_params);
    }
}