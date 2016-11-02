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
 * Utility class for all HTML drawing classes
 *
 * @since  1.5
 */
abstract class Button
{

    /**
     * Displays a custom button
     *
     * @param   string  $targetModalId  ID of the target modal box
     * @param   string  $icon           Icon class to show on modal button
     * @param   string  $alt            Title for the modal button
     *
     * @return  void
     *
     * @since   3.2
     */
	public static function button($title, $icon = "", $attribs = array())
	{
        $str = array();

        $class = "";
        if(isset($attribs["class"]))
            $class  =$attribs["class"];

        $class .= ' btn';
        $attribs["class"] = $class;

        $attribs_html = HtmlHelper::attribs($attribs);

		$str[] = ' <button '.$attribs_html.'>';

        if($icon)
            $str[] = '     <span class="' . $icon . '"></span>';
        $str[] = \JText::_($title);
        $str[] = ' </button>';

        return implode("\n", $str);
    }

    /**
     * Displays a custom button
     *
     * @param   string  $targetModalId  ID of the target modal box
     * @param   string  $icon           Icon class to show on modal button
     * @param   string  $alt            Title for the modal button
     *
     * @return  string
     *
     * @since   3.2
     */
	public static function task($task, $title, $icon = "", $attribs = array())
	{
        $attribs["onclick"] = 'Joomla.submitbutton(\''.$task.'\')';
        return self::button($title, $icon, $attribs);
    }

    /**
     * Displays a custom button
     *
     * @param   string  $targetModalId  ID of the target modal box
     * @param   string  $icon           Icon class to show on modal button
     * @param   string  $alt            Title for the modal button
     *
     * @return  string
     *
     * @since   3.2
     */
	public static function link($link, $title, $icon = "", $attribs = array())
	{
        $str = array();

        $class = "";
        if(isset($attribs["class"]))
            $class  =$attribs["class"];

        $class .= ' btn';
        $attribs["class"] = $class;

        $attribs_html = HtmlHelper::attribs($attribs);

		$str[] = ' <a href="'.$link.'" '.$attribs_html.'>';

        if($icon)
            $str[] = '     <span class="' . $icon . '"></span>';
        $str[] = \JText::_($title);
        $str[] = ' </a>';

        return implode("\n", $str);
    }

    /**
     * Displays a custom button
     *
     * @param   string  $targetModalId  ID of the target modal box
     * @param   string  $icon           Icon class to show on modal button
     * @param   string  $alt            Title for the modal button
     *
     * @return  string
     *
     * @since   3.2
     */
	public static function dropdownbutton($list, $title, $icon = "", $attribs = array())
	{
        \JHtml::_('bootstrap.framework');

        $html = array();
        $attribs_html = HtmlHelper::attribs($attribs);

        $class = "";
        if(isset($attribs["class"]))
            $class  =$attribs["class"];

        $class .= ' btn dropdown-toggle';
        $attribs["class"] = $class;

		$html[] = '<div class="btn-group">';

        $html[] = self::button($title, $icon, $attribs);

        $html[] = ' <button data-toggle="dropdown" '.$attribs_html.'>';
        $html[] = '     <span class="caret"></span>';
        $html[] = ' </button>';

        $html[] = '<ul class="dropdown-menu">';

        foreach ($list as $li)
        {
            $href = isset($li["href"]) ? ' href="'.$li["href"].'" ' : 'href="#"';
            $onclick =isset($li["task"]) ? ' onclick="Joomla.submitbutton(\''.$li["task"].'\')" ' : "";

            $html[] = '<li>';
            $html[] = ' <a'.$onclick.$href.'>'.\JText::_($li["title"]).'</a>';
            $html[] = '</li>';
        }

        $html[] = '</ul>';

        $html[] = '</div>';

        return implode("\n", $html);
    }

}