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
 * Content article class.
 *
 * @since  1.6.0
 */
class FMEventsControllerCalendar extends JControllerLegacy
{

    public function getEvents() {

        $input = JFactory::getApplication()->input;
        $params = json_decode($input->get('params', '', 'post'), true);
        $start = $input->get('start', '', 'post');
        $end = $input->get('end', '', 'post');
        $types = $input->get('types', array(), 'post', 'ARRAY');
        $categories = $input->get('categories', array(), 'post', 'ARRAY');
        $timezone = $input->get('timezone', '', 'post');
        $model = $this->getModel("Calendar", 'FmeventsModel');
        $events = $model->getEvents($start, $end, $types, $categories, $timezone, $params);

        echo json_encode($events);
        exit;
    }

}