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

interface ICalendar {

    /**
     * Summary of toCalendar
     * @return Event
     */
    function toCalendar();
}