<?php
/**
 * @package     Joomla.Libraries
 * @subpackage  HTML
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace FootManager\UI\Html\Button;

defined('JPATH_PLATFORM') or die;

use FootManager\Utilities\HtmlHelper;

/**
 * HTML utility class for building a dropdown menu
 *
 * @since  3.2
 */
abstract class Group
{
	/**
     * @var    array  HTML markup for the dropdown list
     * @since  3.2
     */
	protected static $buttons = array();

    /**
     * @var    array  HTML markup for the dropdown list
     * @since  3.2
     */
	protected static $dropdown = array();

	/**
     * Method to render current dropdown menu
     *
     * @param   string  $item  An item to render.
     *
     * @return  string  HTML markup for the dropdown list
     *
     * @since   3.2
     */
	public static function render($class = "")
	{
		$html = array();

		$html[] = '<div class="btn-group">';

		$html[] = implode('', static::$buttons);

        if(static::$dropdown) {
            $html[] = '<button class="btn '.$class.' dropdown-toggle" data-toggle="dropdown">';
            $html[] = '<span class="caret"></span>';
            $html[] = '</button>';
            $html[] = '<ul class="dropdown-menu">';
            foreach (static::$dropdown as $dd)
            {
                $html[] = '<li>'.$dd.'</li>';
            }

            $html[] = '</ul>';
        }
        $html[] = '</div>';

		static::$buttons = [];
        static::$dropdown = [];

		return implode('', $html);
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
	public static function addTask($task, $title, $icon = "", $attribs = array(), $dropdown = false)
	{
        if($dropdown) {
            $attribs["onclick"] = 'Joomla.submitbutton(\''.$task.'\')';
            $text = "";
            if($icon) $text = '     <span class="' . $icon . '"></span>';
            $text = \JText::_($title);
            self::$dropdown[] = \FootManager\UI\Html\Html::link("#", $text, $attribs);
        } else
            self::$buttons[] = \FootManager\UI\Html\Button::task($task, $title, $icon, $attribs);
	}

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
	public static function addLink($link, $title, $icon = "", $attribs = array(), $dropdown = false)
	{
        if($dropdown) {
            $text = "";
            if($icon) $text = '     <span class="' . $icon . ' fm-margin-right-10"></span>';
            $text .= \JText::_($title);
            self::$dropdown[] = \FootManager\UI\Html\Html::link($link, $text, $attribs);
        } else
            self::$buttons[] = \FootManager\UI\Html\Button::link($link, $title, $icon, $attribs);
    }

}