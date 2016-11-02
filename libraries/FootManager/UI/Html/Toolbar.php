<?php
/**
 * @package    Joomla.Administrator
 *
 * @copyright  Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace FootManager\UI\Html;

defined('JPATH_PLATFORM') or die;

use FootManager\Utilities\HtmlHelper;

\JLoader::register('JSubMenuHelper', JPATH_BASE . '/includes/subtoolbar.php');

/**
 * Utility class for the button bar.
 *
 * @since  1.5
 */
abstract class Toolbar
{
	/**
     * Displays a modal button
     *
     * @param   string  $targetModalId  ID of the target modal box
     * @param   string  $icon           Icon class to show on modal button
     * @param   string  $alt            Title for the modal button
     *
     * @return  void
     *
     * @since   3.2
     */
	public static function modal($targetModalId, $icon, $alt, $class)
	{
		\JHtml::_('bootstrap.framework');

		$title = \JText::_($alt);
		$dhtml = "<button data-toggle='modal' data-target='#" . $targetModalId . "' class='btn btn-small ".$class."'>
			<span class='" . $icon . "' title='" . $title . "'></span>  " . $title . "</button>";

		$bar = \JToolbar::getInstance('toolbar');
		$bar->appendButton('Custom', $dhtml, $alt);
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
	public static function taskbutton($task, $title, $icon = "", $attribs = array())
	{
        $class = "";
        if(isset($attribs["class"]))
            $class  =$attribs["class"];

        $class .= ' btn-small';
        $attribs["class"] = $class;
		$bar = \JToolbar::getInstance('toolbar');
		$bar->appendButton('Custom', Button::task($task, $title, $icon, $attribs));
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
	public static function linkbutton($link, $title, $icon = "", $attribs = array())
	{
        $class = "";
        if(isset($attribs["class"]))
            $class  =$attribs["class"];

        $class .= ' btn-small';
        $attribs["class"] = $class;
		$bar = \JToolbar::getInstance('toolbar');
		$bar->appendButton('Custom', Button::link($link, $title, $icon, $attribs));
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
	public static function dropdownbutton($title, $class = "")
	{
        $class .= ' btn btn-small';
		$bar = \JToolbar::getInstance('toolbar');
		$bar->appendButton('Custom', Dropdown::render($title, "", $class));
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
	public static function buttonsgroup($class = "")
	{
		$bar = \JToolbar::getInstance('toolbar');
		$bar->appendButton('Custom', \FootManager\UI\Html\Button\Group::render($class));
	}
}