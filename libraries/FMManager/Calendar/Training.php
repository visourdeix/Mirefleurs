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

class Training extends \FMManager\Calendar\Event {

    protected function color() {
        return $this->_event->rosters->first()->team->category->color;
    }

    protected function end() {
        return $this->_event->end_date;
    }

    protected function category() {
        return $this->_event->rosters->implode("small_name", ", ");
    }

    protected function url() {
        return "";
    }

}