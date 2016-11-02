<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Form
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

jimport('FootManager.framework');

JFormHelper::loadFieldClass('checkbox');

/**
 * Form Field class for the Joomla Platform.
 * Display a JSON loaded window with a repeatable set of sub fields
 *
 * @package     Joomla.Platform
 * @subpackage  Form
 * @since       3.2
 */
class JFormFieldFmTouchspin extends JFormField
{
	/**
     * The form field type.
     *
     * @var    string
     * @since  3.2
     */
	protected $type = 'FmTouchspin';

    protected $min;
    protected $max;
    protected $decimals;
    protected $step;
    protected $vertical;
    protected $prefix;
    protected $postfix;
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
            $this->class    = (string) $this->element['class'] ? (string) $this->element['class'] : "fm-input-xxmini text-center";
            $this->min    = isset($this->element['min']) ? (int) $this->element['min'] : 0;
            $this->max    = isset($this->element['max']) ? (int) $this->element['max'] : 100;
            $this->decimals    = (string) $this->element['decimals'] ? (int) $this->element['decimals'] : 0;
            $this->step    = (string) $this->element['step'] ? (string) $this->element['step'] : 1;
            $this->vertical    = (string) $this->element['vertical'] ? (boolean) $this->element['vertical'] : false;
            $this->prefix    = (string) $this->element['prefix'] ? (string) $this->element['prefix'] : "";
            $this->postfix    = (string) $this->element['postfix'] ? (string) $this->element['postfix'] : "";
		}

		return $return;
	}

	/**
     * Method to get the field input markup.
     *
     * @return  string  The field input markup.
     *
     * @since   3.2
     */
	protected function getInput()
	{
		$attribs = array();
        $attribs["id"] = $this->id;
        $attribs["name"] = $this->name;
        $attribs["value"] = $this->value;
        $attribs["class"] = "fmtouchspin ".$this->class;
        $attribs["data-bts-min"] = $this->min;
        $attribs["data-bts-max"] = $this->max;
        $attribs["data-bts-decimals"] = $this->decimals;
        $attribs["data-bts-step"] = $this->step;
        $attribs["data-bts-vertical-buttons"] = $this->vertical;
        $attribs["data-bts-prefix"] = $this->prefix;
        $attribs["data-bts-postfix"] = $this->postfix;

        if(!$this->inRepeater)
            FootManager\UI\ui::touchspin('#'.$this->id);
        else
            FootManager\UI\Loader::touchspin();

        $html[] = FootManager\UI\Html\Form::textbox($attribs, $this->readonly);

        return implode("\n", $html);
	}
}