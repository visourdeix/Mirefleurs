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
 * This is a class that provides functionality for managing arrays.
 *
 * @package      FootManager\Utilities
 * @subpackage   Utilities
 */
abstract class ArrayHelper
{

    /**
     * Option to perform case-sensitive sorts.
     *
     * @var    mixed  Boolean or array of booleans.
     * @since  11.3
     */
	protected static $sortCase;

	/**
     * Option to set the sort direction.
     *
     * @var    mixed  Integer or array of integers.
     * @since  11.3
     */
	protected static $sortDirection;

	/**
     * Option to set the object key to sort on.
     *
     * @var    string
     * @since  11.3
     */
	protected static $sortKey;

	/**
     * Option to perform a language aware sort.
     *
     * @var    mixed  Boolean or array of booleans.
     * @since  11.3
     */
	protected static $sortLocale;

    /**
     * Utility function to map an array to a stdClass object.
     *
     * @param   array    &$array     The array to map.
     * @param   string   $class      Name of the class to create
     * @param   boolean  $recursive  Convert also any array inside the main array
     *
     * @return  object   The object mapped from the given array
     *
     * @since   11.1
     * @deprecated  4.0 Use Joomla\Utilities\ArrayHelper::toObject instead
     */
	public static function toObject($array, $recursive = true)
	{
        return \JArrayHelper::toObject($array, 'stdClass', $recursive);

	}

    /**
     * Utility function to map an array to a string.
     *
     * @param   array    $array         The array to map.
     * @param   string   $inner_glue    The glue (optional, defaults to '=') between the key and the value.
     * @param   string   $outer_glue    The glue (optional, defaults to ' ') between array elements.
     * @param   boolean  $keepOuterKey  True if final key should be kept.
     *
     * @return  string   The string mapped from the given array
     *
     * @since   11.1
     * @deprecated  4.0 Use Joomla\Utilities\ArrayHelper::toString instead
     */
	public static function toString($array = null, $inner_glue = '=', $outer_glue = ' ', $keepOuterKey = false)
	{
		return \JArrayHelper::toString($array, $inner_glue, $outer_glue, $keepOuterKey);
	}

    /**
     * Utility function to map an object to an array
     *
     * @param   object   $p_obj    The source object
     * @param   boolean  $recurse  True to recurse through multi-level objects
     * @param   string   $regex    An optional regular expression to match on field names
     *
     * @return  array    The array mapped from the given object
     *
     * @since   11.1
     * @deprecated  4.0 Use Joomla\Utilities\ArrayHelper::fromObject instead
     */
	public static function fromObject($p_obj, $recurse = true, $regex = null)
	{
		if (is_object($p_obj))
		{
			return \JArrayHelper::fromObject($p_obj, $recurse, $regex);
		}
		else
		{
			return (array)$p_obj;
		}
	}

    /**
     * Group Array.
     * @param mixed $array
     * @param mixed $groupKey
     * @return mixed
     */
    public static function group($array, $groupKey, $nullValue = 0, $nullInLast = true) {
        $result = array();

        foreach ($array as $key => $subArray) {

            if(is_array($subArray))
                $new_key = $subArray[$groupKey];
            elseif(is_object($subArray))
                $new_key = $subArray->$groupKey;
            else
                $new_key = $key;

            if(!$new_key)
                $new_key = $nullValue;

            $result[$new_key][] = $subArray;
        }

        if($nullInLast and isset($result[$nullValue])) {
            $null_group = array($nullValue => $result[$nullValue]);
            $groups = array_diff_key($result, $null_group);
            $result = array_merge($groups, $null_group);
        }

        return $result;
    }

    /**
     * Utility function to sort an array of objects on a given field
     *
     * @param   array  &$a             An array of objects
     * @param   mixed  $k              The key (string) or a array of key to sort on
     * @param   mixed  $direction      Direction (integer) or an array of direction to sort in [1 = Ascending] [-1 = Descending]
     * @param   mixed  $caseSensitive  Boolean or array of booleans to let sort occur case sensitive or insensitive
     * @param   mixed  $locale         Boolean or array of booleans to let sort occur using the locale language or not
     *
     * @return  array  The sorted array of objects
     *
     * @since   11.1
     * @deprecated  4.0 Use Joomla\Utilities\ArrayHelper::sortObjects instead
     */
	public static function sort(&$a, $k, $direction = 1, $caseSensitive = true, $locale = false)
	{
		if (!is_array($locale) || !is_array($locale[0]))
		{
			$locale = array($locale);
		}

		self::$sortCase = (array) $caseSensitive;
		self::$sortDirection = (array) $direction;
		self::$sortKey = (array) $k;
		self::$sortLocale = $locale;

		uasort($a, array(__CLASS__, '_sort'));

		self::$sortCase = null;
		self::$sortDirection = null;
		self::$sortKey = null;
		self::$sortLocale = null;

		return $a;
	}

	/**
     * Callback function for sorting an array of objects on a key
     *
     * @param   array  &$a  An array of objects
     * @param   array  &$b  An array of objects
     *
     * @return  integer  Comparison status
     *
     * @see     JArrayHelper::sortObjects()
     * @since   11.1
     */
	protected static function _sort(&$a, &$b)
	{
		$key = self::$sortKey;

		for ($i = 0, $count = count($key); $i < $count; $i++)
		{
            $direction = 1;
			if (isset(self::$sortDirection[$i]))
			{
				$direction = self::$sortDirection[$i];
			}

            $caseSensitive = false;
			if (isset(self::$sortCase[$i]))
			{
				$caseSensitive = self::$sortCase[$i];
			}

            $locale = false;
			if (isset(self::$sortLocale[$i]))
			{
				$locale = self::$sortLocale[$i];
			}

			$va = is_object($a) ? $a->{$key[$i]} : $a[$key[$i]];
            $vb = is_object($b) ? $b->{$key[$i]} : $b[$key[$i]];

			if ((is_bool($va) || is_numeric($va)) && (is_bool($vb) || is_numeric($vb)))
			{
				$cmp = $va - $vb;
			}
			elseif ($caseSensitive)
			{
				$cmp = \JString::strcmp($va, $vb, $locale);
			}
			else
			{
				$cmp = \JString::strcasecmp($va, $vb, $locale);
			}

			if ($cmp > 0)
			{
				return $direction;
			}

			if ($cmp < 0)
			{
				return -$direction;
			}
		}

		return 0;
	}

    /**
     * Extracts a column from an array of arrays or objects
     *
     * @param   array   $array  The source array
     * @param   string  $index  The index of the column or name of object property
     *
     * @return  array  Column of values from the source array
     *
     * @since   1.0
     */
	public static function getColumn(array $array, $index)
	{
		$result = array();

		foreach ($array as $item)
		{
			if (is_array($item) && isset($item[$index]))
			{
				$result[] = $item[$index];
			}
			elseif (is_object($item) && (property_exists($item, $index) || isset($item->$index)))
			{
				$result[] = $item->$index;
			} elseif(is_object($item) && method_exists($item, "__get")) {
                $result[] = $item->__get($index);
            }
		}

		return $result;
	}

    public static function is_multi($array) {
        if (count($array) != count($array, COUNT_RECURSIVE))
            return true;
        else {
            $first_item = reset($array);
            return is_array($first_item) || is_object($first_item);
        }
    }

    public static function getMaxSuccessiveValue($values, $target) {
        $maxLength = 0;
        $tempLength = 0;
        $i = 0;

        foreach ($values as $value)
        {
        	if (in_array($value, (array)$target)) {
                $tempLength++;
            } else {
                $tempLength = 0;

                if(count($values) - $i <= $maxLength){
                    $i++;
                    break;
                }
            }

            if ($tempLength > $maxLength) {
                $maxLength = $tempLength;
            }

            $i++;
        }

        return $maxLength;
    }

}