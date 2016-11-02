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
abstract class Log
{
    /**
     * Summary of initialise
     */
    public static function initialise($name, $priority = \JLog::INFO, $category = "jerror") {
        $options['format']    = '{DATE}\t{TIME}\t{LEVEL}\t{CODE}\t{MESSAGE}';
        $options['text_file'] = $name.'.php';

        \JLog::addLogger($options, $priority, array($category));
    }

    /**
     * Summary of initialise
     */
    public static function add($data, $priority = \JLog::INFO, $category = "jerror") {
        if(\JDEBUG) {
            if(is_object($data) || is_array($data)) {
                $data = (is_object($data)) ? \JArrayHelper::fromObject($data, true) : $data;
                $text = \JArrayHelper::toString($data, "=", ", ", false);
            }
            else
                $text = $data;
            \JLog::add($text, $priority, $category);
        }
    }

}