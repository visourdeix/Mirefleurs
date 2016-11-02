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
class JFormFieldFmRadio extends JFormFieldList
{
	/**
     * The form field type.
     *
     * @var    string
     * @since  11.1
     */
	protected $type = 'FmRadio';
    protected $inRepeater = false;

	/**
     * Method to get the radio button field input markup.
     *
     * @return  string  The field input markup.
     *
     * @since   11.1
     */
	protected function getInput()
	{
		$html = array();

		// Initialize some field attributes.
        $disabled  = ($this->disabled || $this->readonly) ? ' disabled' : '';
		$readonly  = $this->readonly;
		$class     = !empty($this->class) ? ' class="fmradio btn-group ' . $this->class .$disabled. '"' : ' class="fmradio btn-group'.$disabled.'"';
		$required  = $this->required ? ' required aria-required="true"' : '';
		$autofocus = $this->autofocus ? ' autofocus' : '';
        $value = ($this->value == "") ? $this->default : $this->value;

		// Start the radio field output.
		$html[] = '<div id="' . $this->id . '"' . $class . $required . $autofocus . $disabled . ' >';

		// Get the field options.
		$options = $this->getOptions();

		// Build the radio field output.
		foreach ($options as $i => $option)
		{
			// Initialize some option attributes.
			$checked = ((string) $option->value == (string) $value) ? ' checked="checked"' : '';
            $title = !empty($option->title) ? ' title="' . $option->title . '"' : '';
			$class = !empty($option->class) ? ' class="hasTooltip ' . $option->class . '"' : 'class="hasTooltip"';
            $active_class = !empty($option->active_class) ? ' active_class="' . $option->active_class . '"' : '';

			$disabled = !empty($option->disable) || ($readonly && !$checked);

			$disabled = $disabled ? ' disabled' : '';

			$html[] = '<button for="' . $this->id . $i . '"' . $class . $active_class.$title.'>';
            $html[] = '<input type="radio" id="' . $this->id . $i . '" name="' . $this->name . '" value="'
				. htmlspecialchars($option->value, ENT_COMPAT, 'UTF-8') . '"' . $required . $disabled . $checked . ' class="'.$this->class.'" />';
            $html[] = JText::alt($option->text, preg_replace('/[^a-zA-Z0-9_\-]/', '_', $this->fieldname)) . '</button>';

			$required = '';
		}

		// End the radio field output.
		$html[] = '</div>';

        if(!$this->inRepeater)
            FootManager\UI\ui::radio('#'.$this->id);
        else
            FootManager\UI\Loader::radio();

		return implode($html);
	}

    /**
     * Method to get the field options.
     *
     * @return  array  The field option objects.
     *
     * @since   11.1
     */
	protected function getOptions()
	{
		$fieldname = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $this->fieldname);
		$options = array();

		foreach ($this->element->xpath('option') as $option)
		{
			// Filter requirements
			if ($requires = explode(',', (string) $option['requires']))
			{
				// Requires multilanguage
				if (in_array('multilanguage', $requires) && !JLanguageMultilang::isEnabled())
				{
					continue;
				}

				// Requires associations
				if (in_array('associations', $requires) && !JLanguageAssociations::isEnabled())
				{
					continue;
				}
			}

			$value = (string) $option['value'];
			$text = trim((string) $option) ? trim((string) $option) : $value;

			$disabled = (string) $option['disabled'];
			$disabled = ($disabled == 'true' || $disabled == 'disabled' || $disabled == '1');
			$disabled = $disabled || ($this->readonly && $value != $this->value);

			$checked = (string) $option['checked'];
			$checked = ($checked == 'true' || $checked == 'checked' || $checked == '1');

			$selected = (string) $option['selected'];
			$selected = ($selected == 'true' || $selected == 'selected' || $selected == '1');

            $active_class = (string) $option['active_class'];
            $title = (string) $option['title'];

			$tmp = array(
					'value'    => $value,
					'text'     => JText::alt($text, $fieldname),
                    'active_class'     => $active_class,
                    'title'     => JText::alt($title, $fieldname),
					'disable'  => $disabled,
					'class'    => (string) $option['class'],
					'selected' => ($checked || $selected),
					'checked'  => ($checked || $selected)
				);

			// Set some event handler attributes. But really, should be using unobtrusive js.
			$tmp['onclick']  = (string) $option['onclick'];
			$tmp['onchange']  = (string) $option['onchange'];

			// Add the option object to the result set.
			$options[] = (object) $tmp;
		}

		reset($options);

		return $options;
	}
}