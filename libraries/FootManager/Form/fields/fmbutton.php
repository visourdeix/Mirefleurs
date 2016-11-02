<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Form
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

/**
 * Form Field class for the Joomla Platform.
 * Provides radio button inputs
 *
 * @link   http://www.w3.org/TR/html-markup/command.radio.html#command.radio
 * @since  11.1
 */
class JFormFieldFmButton extends JFormField
{

    /**
     * Method to get the field input markup.
     *
     * @return  string  The field input markup.
     *
     * @since   11.1
     */
	protected function getInput() {

        $html = array();
		$attr = '';

		// Initialize some field attributes.
		$attr .= !empty($this->class) ? ' class="btn ' . $this->class . '"' : '';
		$attr .= $this->disabled ? ' disabled' : '';

        $html[] = '<input type="hidden" name="' . $this->name . '" id="' . $this->id . '" value="'
			. htmlspecialchars($this->value, ENT_COMPAT, 'UTF-8') . '" />';

        $html[] = '<a id="'.$this->id.'_button'.'" href="#" '.$attr.'>'.$this->getLabel().'</a>';

		return implode($html);

	}

    /**
     * Method to get a control group with label and input.
     *
     * @param   array  $options  Options to be passed into the rendering of the field
     *
     * @return  string  A string containing the html for the control group
     *
     * @since   3.2
     */
	public function renderField($options = array())
	{

        $html = array();

        $html[] = '<div class="control-group">';
        $html[] = $this->getInput();
        $html[] = '</div>';

        return implode("\n", $html);
	}

}