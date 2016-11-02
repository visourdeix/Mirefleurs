<?php
/**
 * @package     Joomla.Libraries
 * @subpackage  HTML
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace FootManager\UI\Html;

defined('JPATH_PLATFORM') or die;

use FootManager\Utilities\HtmlHelper;

/**
 * Utility class for creating HTML Grids
 *
 * @since  1.6
 */
abstract class Html
{

    /**
     * Write a <img></img> element
     *
     * @param   string   $file      The relative or absolute URL to use for the src attribute.
     * @param   string   $alt       The alt text.
     * @param   mixed    $attribs   String or associative array of attribute(s) to use.
     * @param   boolean  $relative  Path to file is relative to /media folder (and searches in template).
     * @param   mixed    $path_rel  Return html tag without (-1) or with file computing(false). Return computed path only (true).
     *
     * @return  string
     *
     * @since   1.5
     */
	public static function image($file, $attribs = array(), $async = false)
	{
        $src= '';
        if($async) {

            $src = 'data-src="' . $file. '"';

            if(!isset( $attribs["class"])) {
                $attribs["class"] = "";
            }
            $attribs["class"] = $attribs["class"].' fm-img-async';
        } else {
            $src = 'src="' . $file. '"';
        }

        try
        {
            list($width, $height) = getimagesize(\FootManager\Utilities\ImageHelper::getRemoteName($file));
            if(!in_array("height", array_keys($attribs)))
                $attribs["height"] = $height;
            if(!in_array("width", array_keys($attribs)))
                $attribs["width"] = $width;
            if(!in_array("alt", array_keys($attribs)))
                $attribs["alt"] = "";
        }
        catch (Exception $exception)
        {
        }

        return '<img '.$src.' ' . HtmlHelper::attribs($attribs) . '>';
    }

    /**
     * Write a <img></img> element
     *
     * @param   string   $file      The relative or absolute URL to use for the src attribute.
     * @param   string   $alt       The alt text.
     * @param   mixed    $attribs   String or associative array of attribute(s) to use.
     * @param   boolean  $relative  Path to file is relative to /media folder (and searches in template).
     * @param   mixed    $path_rel  Return html tag without (-1) or with file computing(false). Return computed path only (true).
     *
     * @return  string
     *
     * @since   1.5
     */
	public static function link($link, $text, $attribs = array())
	{
        return '<a href="'.$link.'" '.HtmlHelper::attribs($attribs).'>'.$text.'</a>';
    }
}