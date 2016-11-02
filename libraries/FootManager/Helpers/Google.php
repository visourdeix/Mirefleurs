<?php
/**
 * @package      FootManager
 * @subpackage   Helpers
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FootManager\Helpers;

defined('JPATH_PLATFORM') or die;
/**
 * This class contains common methods and properties for a database item
 *
 * @package      FootManager
 * @subpackage   Helpers
 */
abstract class Google
{
    /**
     * Get google map link.
     * @param mixed $position
     * @return string
     */
    public static function mapLink($position = array()) {
        $lat = \JArrayHelper::getValue($position, "latitude");
        $long = \JArrayHelper::getValue($position, "longitude");

        $str = "";

        if($lat || $long)
            $str = implode(',', array($lat, $long));
        else {
            $address = \JArrayHelper::getValue($position, "address");
            $pc = \JArrayHelper::getValue($position, "postal_code");
            $city = \JArrayHelper::getValue($position, "city");
            $str = implode(' ', array($address, $pc, $city));
        }

        if(trim($str) !== "")
            return 'http://maps.google.com/maps?q='.urlencode($str);

        return "";
    }
}