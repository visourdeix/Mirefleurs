<?php
/**
 * @package      FootManager
 * @subpackage   Calendar
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FMManager\Calendar;

defined('JPATH_PLATFORM') or die;

class Event extends \FootManager\Calendar\Event {

    protected function id() {
        return $this->_event->id;
    }

    protected function color() {
        return $this->_event->category->color;
    }

    protected function type() {
        return $this->_event->type;
    }

    protected function start() {
        return $this->_event->datetime;
    }

    protected function category() {
        return $this->_event->category->label;
    }

    protected function state() {
        return $this->_event->state;
    }

    protected function url() {
        $type = $this->type();
        return \FmmanagerHelperRoute::$type($this->_event);
    }

    protected function title() {
        return \FootManager\Helpers\Layout::render($this->type().'.calendar.title', array("event" => $this->_event), '', array('component' => FM_MANAGER_COMPONENT));
    }

    protected function template() {
        return \FootManager\Helpers\Layout::render($this->type().'.calendar.template', array("event" => $this->_event), '', array('component' => FM_MANAGER_COMPONENT));
    }

    protected function summary() {
        return \FootManager\Helpers\Layout::render($this->type().'.calendar.summary', array("event" => $this->_event), '', array('component' => FM_MANAGER_COMPONENT));
    }
}