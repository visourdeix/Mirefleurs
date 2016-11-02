<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Form
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

JFormHelper::loadFieldClass('text');
jimport('FootManager.framework');

/**
 * Form Field class for the Joomla Platform.
 * Provides radio button inputs
 *
 * @link   http://www.w3.org/TR/html-markup/command.radio.html#command.radio
 * @since  11.1
 */
class JFormFieldFmText extends JFormFieldText
{
	/**
     * The form field type.
     *
     * @var    string
     * @since  11.1
     */
	protected $type = 'FmText';
    protected $source;

    protected $inRepeater = false;

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
            $this->source    = (string) $this->element['source'] ? (string) $this->element['source'] : "";
            $this->source = (array)explode(",", $this->source);
            if($this->source) $this->autocomplete = false;
		}

		return $return;
	}

    /**
     * Method to get the field input markup.
     *
     * @return  string  The field input markup.
     *
     * @since   11.1
     */
	protected function getInput() {

        if($this->source and !$this->inRepeater)  {
            $params = array();
            $params['source']      = '\\'.json_encode((array)$this->source);
            $params['items']       = 8;
            $params['minLength']   = 1;
            $params['matcher']     = null;
            $params['sorter']      = null;
            $params['updater']     = null;
            $params['highlighter'] = null;

            JHtmlBootstrap::typeahead('#'.$this->id, $params);
        }

        return parent::getInput();
	}

}