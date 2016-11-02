<?php
/**
 * @package      FootManager
 * @subpackage   Calendar
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FootManager\Calendar;

defined('JPATH_PLATFORM') or die;

date_default_timezone_set('UTC');

abstract class Event {

    protected $_event;

    public function __construct($event) {
        $this->_event = $event;
    }

    // Tests whether the given ISO8601 string has a time-of-day or not
    const ALL_DAY_REGEX = '/^\d{4}-\d\d-\d\d$/'; // matches strings like "2013-12-29"

    protected $_timezone;

    public function setTimezone($timezone) {
        $this->_timezone = $timezone;

    }

    protected function allDay() {
        return preg_match(self::ALL_DAY_REGEX, $this->start()) &&
                    (!$this->end() || preg_match(self::ALL_DAY_REGEX, $this->end()));
    }

    protected function end() {
        return null;
    }

    protected function color() {
        return "#333";
    }

    protected function editable() {
        return false;
    }

    protected abstract function type();
    protected abstract function start();
    protected abstract function title();
    protected abstract function template();
    protected abstract function summary();
    protected abstract function category();
    protected abstract function url();
    protected abstract function id();

    protected function state() {
        return \FootManager\Constants::DONE;
    }

    protected function date() {
        $start = $this->start();

        if(\FootManager\Utilities\DateHelper::isValid($start)) {
            $date = new \JDate($start);
            return  $date->format("Y-m-d");
        }

        return null;
    }

    protected function content() {
        $content = array();

        $start = $this->start();

        if(\FootManager\Utilities\DateHelper::isValid($start)) {
            $start_date = new \JDate($start);
            $start_date = $start_date->format("l d F Y - G:i");

            $content[] = '<div class="fm-calendar-tooltip-date">'.$start_date.'</div>';
        }

        $content[] = '<div class="fm-margin-top-10">'.$this->template().'</div>';

        return implode("\n", $content);
    }

    // Returns whether the date range of our event intersects with the given all-day range.
    // $rangeStart and $rangeEnd are assumed to be dates in UTC with 00:00:00 time.
    public function isWithinDayRange($rangeStart, $rangeEnd) {

        // Normalize our event's dates for comparison with the all-day range.
        $eventStart = $this->stripTime($this->start());
        $eventEnd = $this->end() ? $this->stripTime($this->end()) : null;

        if (!$eventEnd) {
            // No end time? Only check if the start is within range.
            return $eventStart < $rangeEnd && $eventStart >= $rangeStart;
        } else {
            // Check if the two ranges intersect.
            return $eventStart < $rangeEnd && $eventEnd > $rangeStart;
        }
    }

    // Converts this Event object back to a plain data array, to be used for generating JSON
    public function toArray() {

        // Figure out the date format. This essentially encodes allDay into the date string.
        if ($this->allDay()) {
            $format = 'Y-m-d'; // output like "2013-12-29"
        } else {
            $format = 'c'; // full ISO8601 output, like "2013-12-29T09:00:00+08:00"
        }

        $array['id'] = $this->type()."-".$this->id();
        $array['category'] = $this->category();
        $array['textColor'] = $this->color();
        $array['color'] = $this->color();
        $array['editable'] = $this->editable();
        $array['content'] = $this->content();
        $array['summary'] = $this->summary();
        $array['start'] = $this->parseDateTime($this->start(), $this->_timezone)->format($format);
        $state = $this->state();
        $title = "";

        if($state  == \FootManager\Constants::REPORTED) {
            $title .= '<div class="fm-watermark fm-reported">'.\JText::_("FMLIB_REPORTED").'</div>';
        }

        if($state == \FootManager\Constants::CANCELLED) {
            $title .= '<div class="fm-watermark fm-cancelled">'.\JText::_("FMLIB_CANCELLED").'</div>';
        }

        if($state == \FootManager\Constants::STOPPED) {
            $title .= '<div class="fm-watermark fm-stopped">'.\JText::_("FMLIB_STOPPED").'</div>';
        }

        $title .= "<span class='fm-content'>".$this->title()."</span>";
        $array["state"] = $state;
        $array['title'] = $title;

        $end = $this->end();
        $url = $this->url();

        if($end)
            $array['end'] = $this->parseDateTime($end, $this->_timezone)->format($format);

        if($url)
            $array["url"] = $url;

        return $array;
    }

    // Date Utilities
    //----------------------------------------------------------------------------------------------
    // Parses a string into a DateTime object, optionally forced into the given timezone.
    private function parseDateTime($string, $timezone = null) {
        $date = new \DateTime(
                $string, $timezone ? $timezone : new \DateTimeZone('UTC')
                // Used only when the string is ambiguous.
                // Ignored if string has a timezone offset in it.
        );
        if ($timezone) {
            // If our timezone was ignored above, force it.
            $date->setTimezone($timezone);
        }
        return $date;
    }

    // Takes the year/month/date values of the given DateTime and converts them to a new DateTime,
    // but in UTC.
    private function stripTime($datetime) {
        return new \DateTime($datetime->format('Y-m-d'));
    }

    public function __get($name) {

        if($name == "event") return $this->_event;

        if(method_exists($this, $name)) {
            return $this->$name();
        }

        return null;
    }
}