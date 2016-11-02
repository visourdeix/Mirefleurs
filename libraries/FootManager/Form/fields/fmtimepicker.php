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

/**
 * Form Field class for the Joomla Platform.
 * Display a JSON loaded window with a repeatable set of sub fields
 *
 * @package     Joomla.Platform
 * @subpackage  Form
 * @since       3.2
 */
class JFormFieldFmTimePicker extends JFormField
{
	/**
     * The form field type.
     *
     * @var    string
     * @since  3.2
     */
	protected $type = 'FmTimePicker';

	protected $format;
	protected $startDate;
	protected $endDate;
	protected $language;
    protected $inModal;
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
			$this->format    = (string) $this->element['format'] ? (string) $this->element['format'] : "HH:mm";
			$this->language    = (string) $this->element['language'] ? (string) $this->element['language'] : "fr";
            $this->inModal    = (string) $this->element['inModal'] ? ((string) $this->element['inModal'] == "true" || (string) $this->element['inModal'] == "1") : false;
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
        if(!empty($this->value) && $this->value != '00:00:00')
            $date = '2000-01-01 '.$this->value;
        elseif($this->value instanceof JDate)
            $date = $this->value->format("G:i:s");
        else
            $date = $this->value;

        $attribs_datetimepicker = array();
		$attribs_datetimepicker["data-date-format"]   = $this->format;
		$attribs_datetimepicker["data-date-locale"]    = $this->language;
		$attribs_datetimepicker["data-date-default-date"] = $date;
        $attribs_datetimepicker["class"] = "date fmdatetimepicker";
        if(!$this->inModal) $attribs_datetimepicker["style"] = "position:relative";
        $attribs_datetimepicker["id"] = $this->id.'_datetimepicker';

        $attribs_input = array();
        $attribs_input["id"] = $this->id;
        $attribs_input["name"] = $this->name;
        $attribs_input["class"] = $this->class.' fm-input-xmini';

        if(!$this->inRepeater)
            FootManager\UI\ui::datetimepicker('#'.$attribs_datetimepicker["id"]);
        else
            FootManager\UI\Loader::datetimepicker();

        return FootManager\UI\Html\Form::textboxAppend($attribs_input, $attribs_datetimepicker, "clock-o", $this->readonly);

	}
}