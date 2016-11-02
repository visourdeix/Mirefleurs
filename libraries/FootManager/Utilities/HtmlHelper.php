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
 * This is a class that provides functionality for managing html.
 *
 * @package      FootManager\Utilities
 * @subpackage   Html
 */
abstract class HtmlHelper
{
    /**
     * Convert Attribs array to string value.
     * @param mixed $array
     * @param mixed $prefix
     * @return mixed
     */
    static public function attribs($array, $prefix = "") {

        $elements = array();

		foreach ($array as $k => $v)
		{
			// Don't encode either of these types
			if (is_null($v) || is_resource($v))
			{
				continue;
			}

			// Safely encode as a Javascript string
			$key = $prefix.$k;

			if (is_bool($v))
			{
				$elements[] = $key . '="' . ($v ? 'true' : 'false').'"';
			}
			elseif (is_numeric($v))
			{
				$elements[] = $key . '="' . ($v + 0).'"';
			}
			else
			{
				$elements[] = $key . '=' . json_encode($v);
			}
		}

		return ' '.implode(' ', $elements) ;

    }

    /**
     * Internal method to get a JavaScript object notation string from an array
     *
     * @param   array  $array  The array to convert to JavaScript object notation
     *
     * @return  string  JavaScript object notation representation of the array
     *
     * @deprecated 4.0 use json_encode or JRegistry::toString('json')
     *
     * @since   3.0
     */
	public static function getJSObject(array $array = array())
	{
		$elements = array();

		foreach ($array as $k => $v)
		{
			// Don't encode either of these types
			if (is_null($v) || is_resource($v))
			{
				continue;
			}

			// Safely encode as a Javascript string
			$key = json_encode((string) $k);

			if (is_bool($v))
			{
				$elements[] = $key . ': ' . ($v ? 'true' : 'false');
			}
			elseif (is_numeric($v))
			{
				$elements[] = $key . ': ' . ($v + 0);
			}
			elseif (is_string($v))
			{
				if (strpos($v, '\\') === 0)
				{
					// Items such as functions and JSON objects are prefixed with \, strip the prefix and don't encode them
					$elements[] = $key . ': ' . substr($v, 1);
				}
				else
				{
					// The safest way to insert a string
					$elements[] = $key . ': ' . json_encode((string) $v);
				}
			}
			else
			{
				$elements[] = $key . ': ' . static::getJSObject(is_object($v) ? get_object_vars($v) : $v);
			}
		}

		return '{' . implode(',', $elements) . '}';
	}
}