<?php
/**
 * @package      FootManager
 * @subpackage   Calendar
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FootManager\Medias;

defined('JPATH_PLATFORM') or die;

date_default_timezone_set('UTC');

interface IThumbnail {

    /**
     * Summary of toCalendar
     * @return Thumbnail
     */
    function toThumbnail($size, $category_type = "category");
}