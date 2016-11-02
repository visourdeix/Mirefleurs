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
 * HTML utility class for building a dropdown menu
 *
 * @since  3.2
 */
abstract class Dropdown
{
	/**
     * @var    array  HTML markup for the dropdown list
     * @since  3.2
     */
	protected static $dropDownList = array();

	/**
     * Method to render current dropdown menu
     *
     * @param   string  $item  An item to render.
     *
     * @return  string  HTML markup for the dropdown list
     *
     * @since   3.2
     */
	public static function render($title, $id = "", $class = '')
	{
		$html = array();

        $html[] = '<div class="dropdown">';
		$html[] = '<a data-toggle="dropdown" role="button" data-toggle="dropdown" data-target="#" href="#" class="dropdown-toggle '.$class.'" id="'.$id.'">';

        if($title)
            $html[] = $title;
		$html[] = '<span class="fa fa-chevron-down"></span>';
		$html[] = '</a>';

		$html[] = '<ul class="dropdown-menu" role="menu" aria-labelledby="'.$id.'">';
        $html[] = implode('', static::$dropDownList);
		$html[] = '</ul>';
        $html[] = '</div>';

		static::$dropDownList = array();

		return implode('', $html);
	}

	/**
     * Writes a divider between dropdown items
     *
     * @return  void
     *
     * @since   3.0
     */
	public static function divider()
	{
		static::$dropDownList[] = '<li role="presentation" class="divider"></li>';
	}

    /**
     * Append a custom item to current dropdown menu.
     *
     * @param   string  $label  The label of the item.
     * @param   string  $icon   The icon classname.
     * @param   string  $id     The item id.
     * @param   string  $task   The task.
     *
     * @return  void
     *
     * @since   3.2
     */
	public static function addTask($task, $label, $icon = '')
	{
        $title = ($icon ? '<span class="' . $icon . '"></span> ' : ''). \JText::_($label);
        $html[] = '<li role="presentation">';
        $html[] = Html::link("#", $title, array("onclick" => "Joomla.submitbutton('".$task."')"));
        $html[] = '</li>';

        static::$dropDownList[] = implode('', $html);
	}

	/**
     * Append a custom item to current dropdown menu.
     *
     * @param   string  $label  The label of the item.
     * @param   string  $icon   The icon classname.
     * @param   string  $id     The item id.
     * @param   string  $task   The task.
     *
     * @return  void
     *
     * @since   3.2
     */
	public static function addLink($link, $label, $icon = '', $attribs = array())
	{
        $title = ($icon ? '<span class="' . $icon . '"></span> ' : ''). \JText::_($label);
        $html[] = '<li role="presentation">';
        $html[] = Html::link($link, $title, array_merge($attribs, array("role" => "menuitem", "tabindex" => -1)));
        $html[] = '</li>';

        static::$dropDownList[] = implode('', $html);
	}

    /**
     * Append a custom item to current dropdown menu.
     *
     * @param   string  $label  The label of the item.
     * @param   string  $icon   The icon classname.
     * @param   string  $id     The item id.
     * @param   string  $task   The task.
     *
     * @return  void
     *
     * @since   3.2
     */
	public static function addGroup($label, $icon = '', $attribs = array())
	{
        $title = ($icon ? '<span class="' . $icon . '"></span> ' : ''). \JText::_($label);
        $html[] = '<li class="group" role="presentation">';
        $html[] = Html::link("#", $title, array_merge($attribs, array("role" => "menuitem", "tabindex" => -1)));
        $html[] = '</li>';

        static::$dropDownList[] = implode('', $html);
	}
}