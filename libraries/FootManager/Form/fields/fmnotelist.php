<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Form
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

JFormHelper::loadFieldClass('list');
jimport('FootManager.framework');

/**
 * Form Field class for the Joomla Platform.
 * Provides radio button inputs
 *
 * @link   http://www.w3.org/TR/html-markup/command.radio.html#command.radio
 * @since  11.1
 */
class JFormFieldFmNoteList extends JFormFieldList
{
    /**
     * Method to get the field label markup.
     *
     * @return  string  The field label markup.
     *
     * @since   11.1
     */
	protected function getLabel()
	{
		if (empty($this->element['label']) && empty($this->element['description']))
		{
			return '';
		}

		$title = $this->element['label'] ? (string) $this->element['label'] : ($this->element['title'] ? (string) $this->element['title'] : '');
		$heading = $this->element['heading'] ? (string) $this->element['heading'] : 'h4';
		$description = (string) $this->element['description'];
		$class = !empty($this->class) ? ' class="' . $this->class . '"' : '';
		$close = (string) $this->element['close'];

		$html = array();

		if ($close)
		{
			$close = $close == 'true' ? 'alert' : $close;
			$html[] = '<button type="button" class="close" data-dismiss="' . $close . '">&times;</button>';
		}

		$html[] = !empty($title) ? '<' . $heading . '>' . JText::_($title) . '</' . $heading . '>' : '';
		$html[] = !empty($description) ? JText::_($description) : '';
        $html[] = "<br /><br />";

        $options = $this->getOptions();

        $html[] = "<ul>";
        foreach ($options as $option)
        {
        	$html[] = "<li>";
            $html[] = "<b>".JText::_($option->value)."</b> : ".JText::_($option->text);
            $html[] = "</li>";
        }
        $html[] = "</ul>";

		return '</div><div ' . $class . '>' . implode('', $html);
	}

	/**
     * Method to get the field input markup.
     *
     * @return  string  The field input markup.
     *
     * @since   11.1
     */
	protected function getInput()
	{
		return '';
	}

}