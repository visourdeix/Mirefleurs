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
jimport('FootManager.framework');

/**
 * Form Field class for the Joomla Platform.
 * Provides radio button inputs
 *
 * @link   http://www.w3.org/TR/html-markup/command.radio.html#command.radio
 * @since  11.1
 */
class JFormFieldFmUploadFiles extends JFormField
{
	/**
     * The form field type.
     *
     * @var    string
     * @since  11.1
     */
	protected $type = 'FmUploadFiles';

    protected $url;
    protected $types;
    protected $maxFileSize;

    /**
     * Method to attach a JForm object to the field.
     *
     * @param   SimpleXMLElement  $element  The SimpleXMLElement object representing the <field /> tag for the form field object.
     * @param   mixed             $value    The form field value to validate.
     * @param   string            $group    The field name group control value. This acts as as an array container for the field.
     *                                      For example if the field has name="foo" and the group value is set to "bar" then the
     *                                      full field name would end up being "bar[foo]".
     *
     * @return  boolean  True on success.
     *
     * @see     JFormField::setup()
     * @since   3.2
     */
	public function setup(SimpleXMLElement $element, $value, $group = null)
	{
		$return = parent::setup($element, $value, $group);

		if ($return)
		{
            $this->url    = (string) $this->element['url'] ? (string) $this->element['url'] : "";
            $this->types    = (string) $this->element['types'] ? (string) $this->element['types'] : "";
            $this->maxFileSize    = (string) $this->element['maxFileSize'] ? (string) $this->element['maxFileSize'] : "500mb";

		}

		return $return;
	}

    protected function getInput()
	{

        $html = array();

        $html[] = '<div id="'.$this->id.'">';
        $html[] = '<p>'.JText::_('FMLIB_ERROR_BROWSER_SUPPORT').'</p>';
        $html[] = '</div>';

        $options = array();

        // Fixed
        $options["url"] = $this->url;

        if(!empty($this->types))
            $options["filters"] = '\\ { mime_types : [ { title : "Files", extensions : "'.$this->types.'" } ], max_file_size: "'.$this->maxFileSize.'" }';

        FootManager\UI\ui::plupload('#'.$this->id, $options);

        return implode("\n", $html);
	}

}