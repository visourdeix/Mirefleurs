<?php
/**
 * @package      FootManager
 * @subpackage   Router
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FootManager\Social;

defined('JPATH_PLATFORM') or die;
/**
 * This class contains common methods and properties fo route item
 *
 * @package      FootManager
 * @subpackage   Router
 */
abstract class OpenGraph
{

    const OG = "og";
    const FB = "fb";
    const TWITTER = "twitter";
    const TAG = '<meta property="%s" content="%s" />';

    protected static $loaded = array();

    public static function addMetaTag($property, $content, $prefix = "") {
        $document = \JFactory::getDocument();

        if (!method_exists($document, 'addCustomTag')) {
            return;
        }

        $prop = ($prefix ? $prefix.":" : "").$property;

        // Only load once
        if (!$prop || !$content || !empty(self::$loaded[__FUNCTION__][$prop])) return;

        $document->addCustomTag(\JText::sprintf(self::TAG, $prop,  strip_tags($content)));

        self::$loaded[__FUNCTION__][$prop] = true;
    }

    public static function addOgTag($property, $content) {
        self::addMetaTag($property, $content, self::OG);
    }

    public static function addFbTag($property, $content) {
        self::addMetaTag($property, $content, self::FB);
    }

    public static function addTwitterTag($property, $content) {
        self::addMetaTag($property, $content, self::TWITTER);
    }

    public static function addImageTag($content) {
        $localImage = \FootManager\Utilities\ImageHelper::getLocalName($content);
        $remoteImage = \FootManager\Utilities\ImageHelper::getRemoteName($content);

        if(\JFile::exists($localImage)) {
            list($width, $height) = getimagesize($remoteImage);
            self::addOgTag("image", $remoteImage);
            self::addOgTag("image:width", $width);
            self::addOgTag("image:height", $height);
            self::addTwitterTag("image:src", $remoteImage);
        }
    }

    public static function addTitleTag($content) {
        self::addOgTag("title", $content);
        self::addTwitterTag("title", $content);
    }

    public static function addUrlTag($content) {
        self::addOgTag("url", $content);
        self::addTwitterTag("url", $content);
    }

}