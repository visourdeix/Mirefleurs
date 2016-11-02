<?php
/**
 * @package      FMEvents
 * @subpackage   Calendar
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FootManager\Database\Eloquent;

defined('JPATH_PLATFORM') or die;

/**
 * This class contains common methods and properties for a database item
 *
 * @package      FMEvents
 * @subpackage   Calendar
 */
class Collection extends \Illuminate\Database\Eloquent\Collection {

    /**
     * Get the collection of items as a plain array.
     *
     * @return array
     */
    public function toDropdown($textField = "label", $valueField = "id")
    {
        $callbackText = $this->valueRetriever($textField);
        $callbackValue = $this->valueRetriever($valueField);

        return array_map(function ($value) use($callbackText, $callbackValue) {
            $item = new \stdClass();
            $item->value = $callbackValue($value);
            $item->text = $callbackText($value);
            return $item;

        }, $this->items);
    }

    /**
     * Get the collection of items as a plain array.
     *
     * @param  callable|string  $groupBy
     * @return array
     */
    public function toGroupedDropdown($groupBy, $textField = "label", $valueField = "id")
    {
        $items = $this->groupBy($groupBy);
        foreach ($items as $key => $item)
            $items[$key] = $item->toDropDown($textField, $valueField);

        return $items->toArray();
    }

    /**
     * Sort the collection using the given callback.
     *
     * @param  callable|string  $callback
     * @param  int   $options
     * @param  bool  $descending
     * @return static
     */
    public function sortMulti($sort_fields, $sort_directions = array())
    {
        $results = [];

        foreach ($this->items as $key => $value) {
            $item = array();
            foreach ($sort_fields as $field)
            {
                $callback = $this->valueRetriever($field);
                $item[$field] = $callback($value, $key);
            }
            $results[$key] = $item;
        }

        $results = \FootManager\Utilities\ArrayHelper::sort($results, $sort_fields, $sort_directions);

        // Once we have sorted all of the keys in the array, we will loop through them
        // and grab the corresponding model so we can set the underlying items list
        // to the sorted version. Then we'll just return the collection instance.
        foreach (array_keys($results) as $key) {
            $results[$key] = $this->items[$key];
        }

        return new static($results);
    }

    /**
     * Get a column.
     * @param mixed $field
     */
    public function getColumn($field) {

        $callback = $this->valueRetriever($field);
        return $this->map(function($obj) use($callback) { return $callback($obj); });
    }
}

?>