<?php
/**
 * @package      FootManager
 * @subpackage   Calendar
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FMEvents\Calendar;

defined('JPATH_PLATFORM') or die;

class Event extends \FootManager\Calendar\Event {

    protected function id() {
        return $this->_event->id;
    }

    protected function color() {
        return $this->_event->color;
    }

    protected function type() {
        return "event";
    }

    protected function start() {
        return $this->_event->start_date_time;
    }

    protected function end() {
        return $this->_event->end_date_time;
    }

    protected function category() {
        return $this->_event->category->title;
    }

    protected function state() {
        return $this->_event->state_2;
    }

    protected function url() {
        return \FmeventsHelperRoute::event($this->_event);
    }

    protected function title() {
        return \FootManager\Helpers\Layout::render('event.calendar.title', array("event" => $this->_event), '', array('component' => FM_EVENTS_COMPONENT));
    }

    protected function template() {
        return \FootManager\Helpers\Layout::render('event.calendar.template', array("event" => $this->_event), '', array('component' => FM_EVENTS_COMPONENT));
    }

    protected function summary() {
        return \FootManager\Helpers\Layout::render('event.calendar.summary', array("event" => $this->_event), '', array('component' => FM_EVENTS_COMPONENT));
    }
}