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
class JFormFieldFmToggle extends JFormFieldCheckbox
{
	/**
     * The form field type.
     *
     * @var    string
     * @since  3.2
     */
	protected $type = 'FmToggle';

	protected $onText;
    protected $offText;
	protected $size;
    protected $onColor;
    protected $offColor;
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
			$this->onText    = (string) $this->element['onText'] ? (string) $this->element['onText'] : "<i class='fa fa-check'>";
			$this->offText    = (string) $this->element['offText'] ? (string) $this->element['offText'] : "<i class='fa fa-remove'>";
            $this->size    = (string) $this->element['size'] ? (string) $this->element['size'] : "normal";
			$this->onColor    = (string) $this->element['onColor'] ? (string) $this->element['onColor'] : "primary";
			$this->offColor    = (string) $this->element['offColor'] ? (string) $this->element['offColor'] : "default";
		}

		return $return;
	}

    /**
     * Method to get certain otherwise inaccessible properties from the form field object.
     *
     * @param   string  $name  The property name for which to the the value.
     *
     * @return  mixed  The property value or null.
     *
     * @since   3.2
     */
	public function __get($name)
	{
		switch ($name)
		{
			case 'onText':
            case 'offText':
            case 'size':
            case 'onColor':
            case 'offColor':
				return $this->$name;
		}

		return parent::__get($name);
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
        $attribs["value"] = 1;
        $attribs["class"] = "fmtoggle";
		$attribs["data-on"]   = JText::_($this->onText);
		$attribs["data-off"]    = JText::_($this->offText);
		$attribs["data-size"]    = $this->size;
		$attribs["data-onstyle"]    = $this->onColor;
		$attribs["data-offstyle"] = $this->offColor;
        $attribs["data-style"] = $this->class;

        if(!$this->inRepeater)
            FootManager\UI\ui::toggle('#'.$this->id);
        else
            FootManager\UI\Loader::toggle();

        if(!$this->inRepeater)
            $html[] = FootManager\UI\Html\Form::hidden(array("name" => $this->name, "value" => 0));

		$html[] = FootManager\UI\Html\Form::checkbox($attribs, $this->checked, $this->readonly);

        return implode("\n", $html);
	}
}