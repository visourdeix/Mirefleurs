<?php
/**
 * @package      FootManager
 * @subpackage   Utilities
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FootManager\Utilities;

defined('JPATH_PLATFORM') or die;

/**
 * Projectfork Date Helper Class
 *
 */
abstract class DateHelper
{
    /**
     * Test if string is date.
     * @param mixed $input
     * @return boolean
     */
    public static function isValid($string)
    {
        return !is_null($string) && (bool)strtotime($string);
    }

    /**
     * Test if string is date.
     * @param mixed $input
     * @return array
     */
    public static function format($date, $format = "Y-m-d")
    {
        if(self::isValid($date)) {
            $result = new \JDate($date);
            return $result->format($format);
        }

        return "";
    }

    /**
     * Test if string is before today.
     * @param mixed $input
     * @return array
     */
    public static function isBeforeToday($string)
    {
        if(self::isValid($string)) {
            return (new \DateTime($string) < new \DateTime());
        }

        return false;

    }

    /**
     * Test if string is after today.
     * @param mixed $input
     * @return array
     */
    public static function isAfterToday($string)
    {
        if(self::isValid($string)) {
            return (new \DateTime($string) > new \DateTime());
        }

        return false;
    }

    /**
     * Test if string is after today.
     * @param mixed $input
     * @return array
     */
    public static function isAfter($date1, $date2)
    {
        if(self::isValid($date1) && self::isValid($date2)) {
            return (new \DateTime($date1) > new \DateTime($date2));
        }

        return false;
    }

    /**
     * Test if string is after today.
     * @param mixed $input
     * @return array
     */
    public static function isBefore($date1, $date2)
    {
        if(self::isValid($date1) && self::isValid($date2)) {
            return (new \DateTime($date1) < new \DateTime($date2));
        }

        return false;
    }

    //+ Maigret Aurélien
    //@ https://www.dewep.net
    public static function getRelativeDate($date)
    {
        if(!$date) return "";

        $date_a_comparer = new \DateTime($date);
        $date_actuelle = new \DateTime("now");

        $intervalle = $date_a_comparer->diff($date_actuelle);

        if ($date_a_comparer > $date_actuelle)
        {
            $prefix = \JText::_("FMLIB_IN");
        }
        else
        {
            $prefix = \JText::_("FMLIB_AGO");
        }

        $ans = $intervalle->format('%y');
        $mois = $intervalle->format('%m');
        $jours = $intervalle->format('%d');
        $heures = $intervalle->format('%h');
        $minutes = $intervalle->format('%i');
        $secondes = $intervalle->format('%s');

        if ($ans != 0)
        {
            $value = $ans;
            $suffix = (($ans > 1) ? \JText::_("FMLIB_YEARS") : \JText::_("FMLIB_YEAR"));
            if ($mois >= 6) $suffix .= ' '.\JText::_("FMLIB_AND_HALF");
        }
        elseif ($mois != 0)
        {
            $value = $mois;
            $suffix = (($mois > 1) ? \JText::_("FMLIB_MONTHS") : \JText::_("FMLIB_MONTH"));
            if ($jours >= 15) $suffix .= ' '.\JText::_("FMLIB_AND_HALF");
        }
        elseif ($jours != 0)
        {
            $value = $jours;
            $suffix = (($jours > 1) ? \JText::_("FMLIB_DAYS") : \JText::_("FMLIB_DAY"));
        }
        elseif ($heures != 0)
        {
            $value = $heures;
            $suffix = (($heures > 1) ? \JText::_("FMLIB_HOURS") : \JText::_("FMLIB_HOUR"));
        }
        elseif ($minutes != 0)
        {
            $value = $minutes;
            $suffix = (($minutes > 1) ? \JText::_("FMLIB_MINUTES") : \JText::_("FMLIB_MINUTE"));
        }
        else
        {
            $value = "";
            $suffix = \JText::_("FMLIB_FEW_SECONDS");
        }

        $relative_date = $prefix.($value ? ' '.$value : "").' '.$suffix;
        return $relative_date;
    }

}