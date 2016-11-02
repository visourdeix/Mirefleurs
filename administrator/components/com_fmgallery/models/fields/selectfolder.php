<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Form
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

JFormHelper::loadFieldClass('field');
jimport('FMGallery.framework');

/**
 * Form Field class for the Joomla Platform.
 * Provides radio button inputs
 *
 * @link   http://www.w3.org/TR/html-markup/command.radio.html#command.radio
 * @since  11.1
 */
class JFormFieldSelectFolder extends JFormField
{
	/**
     * The form field type.
     *
     * @var    string
     * @since  11.1
     */
	protected $type = 'SelectFolder';

    protected function getInput()
	{
		// Initialize variables.
		$html = array();
		$link = 'index.php?option=com_fmgallery&amp;view=folder&amp;tmpl=component&amp;field='.$this->id;

		// Initialize some field attributes.
		$attr = $this->element['class'] ? ' class="'.(string) $this->element['class'].' input-medium"' : 'class="input-medium"';
		$attr .= $this->element['size'] ? ' size="'.(int) $this->element['size'].'"' : '';

		// Initialize JavaScript field attributes.
		$onchange = (string) $this->element['onchange'];

		// Load the modal behavior script.
		JHtml::_('behavior.modal', 'a.modal_'.$this->id);

		// Build the script.
		$script = array();
		$script[] = '	function fmSelectFolder_'.$this->id.'(title) {';
		$script[] = '		document.getElementById("'.$this->id.'_id").value = title;';
		$script[] = '		'.$onchange;
		$script[] = '		SqueezeBox.close();';
		$script[] = '	}';

		// Add the script to the document head.
		JFactory::getDocument()->addScriptDeclaration(implode("\n", $script));

        /*
		$html[] = '<div class="fltlft">';
		$html[] = '<input type="text" id="'.$this->id.'_id" name="'.$this->name.'" value="'. $this->value.'"' .' '.$attr.' />';
		$html[] = '</div>';

		// Create the user select button.
		$html[] = '<div class="button2-left">';
		$html[] = '  <div class="blank">';
		$html[] = '		<a class="modal_'.$this->id.'" title="'.JText::_('COM_PHOCAGALLERY_FORM_SELECT_FOLDER').'"' .
        ' href="'.($this->element['readonly'] ? '' : $link).'"' .
        ' rel="{handler: \'iframe\', size: {x: 650, y: 375}}">';
		$html[] = '			'.JText::_('COM_PHOCAGALLERY_FORM_SELECT_FOLDER').'</a>';
		$html[] = '  </div>';
		$html[] = '</div>';*/

		$html[] = '<div class="input-append">';
		$html[] = '<input type="text" id="'.$this->id.'_id" name="'.$this->name.'" value="'. $this->value.'"' .' '.$attr.' readonly />';
		$html[] = '<a class="modal_'.$this->id.' btn hasTooltip" title="'.JText::_('FMLIB_SELECT').'"'
				.' href="'.($this->element['readonly'] ? '' : $link).'"'
				.' rel="{handler: \'iframe\', size: {x: 650, y: 400}}">'
				. '<i class="fa fa-folder-open"></i></a>';
		$html[] = '</div>'. "\n";

		return implode("\n", $html);
	}

}