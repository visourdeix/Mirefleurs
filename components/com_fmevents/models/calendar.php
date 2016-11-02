<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Content Component Article Model
 *
 * @since  1.5
 */
class FmeventsModelCalendar extends JModelItem
{

    /**
     * Search data array
     *
     * @var array
     */
	protected $_events = null;

	/**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @since   1.6
     *
     * @return void
     */
	protected function populateState()
	{
		$app = JFactory::getApplication('site');

		// Load the parameters.
		$params = $app->getParams();
		$this->setState('params', $params);

        $types = $app->input->get('types', null, 'array');
		$this->setState('types', $types);
        $categories = $app->input->get('categories', null, 'array');
		$this->setState('categories', $categories);

	}

	/**
     * Method to get article data.
     *
     * @param   integer  $pk  The id of the article.
     *
     * @return  mixed  Menu item data object on success, false on failure.
     */
	public function getItem()
	{
        $item = new stdClass();

        $all_types = FMEvents\Helper::getTypes();
        $allowed_types = (array)$this->getState("types", array_keys($all_types));
        $types = array();

        if(in_array("all", $allowed_types)) {
            $types = $all_types;
        } else {

            foreach ($allowed_types as $value)
            {
                if(array_key_exists($value, $all_types))
                    $types[$value] = $all_types[$value];
            }
        }

        $all_categories = FMEvents\Helper::getCategories();
        $allowed_categories = (array)$this->getState("categories", array_keys($all_categories));
        $categories = array();

        if(in_array("all", $allowed_categories)) {
            $categories = $all_categories;
        } else {

            foreach ($allowed_categories as $value)
            {
                if(array_key_exists($value, $all_categories))
                    $categories[$value] = $all_categories[$value];
            }
        }

        $item->types = $types;
        $item->categories = $categories;

        return $item;
	}

    /**
     * Method to get weblink item data for the category
     *
     * @access public
     * @return array
     */
	public function getEvents($start = "", $end = "", $types = array(), $categories  = array(), $params = array())
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_events)) {
            $events = \FMEvents\Helper::getEvents($start, $end, $types, $categories)->events;
            $events =  $events->map(function($obj) {
                if($obj instanceof FootManager\Calendar\Event)
                    return $obj->toArray();
                return $obj;
            });

            $this->_events = array();
            foreach ($events as $event)
            	array_push($this->_events, $event);
        }

		return $this->_events;
	}
}