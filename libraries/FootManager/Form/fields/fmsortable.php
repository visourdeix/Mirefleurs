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
JFormHelper::loadFieldClass('list');

/**
 * Form Field class for the Joomla Platform.
 * Display a JSON loaded window with a repeatable set of sub fields
 *
 * @package     Joomla.Platform
 * @subpackage  Form
 * @since       3.2
 */
class JFormFieldFmSortable extends JFormFieldList
{
	/**
     * The form field type.
     *
     * @var    string
     * @since  3.2
     */
	protected $type = 'FmSortable';
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

        $value = array();

        if(is_string($this->value)) {
            $value = (array)json_decode($this->value);
        } elseif(is_object($this->value)) {
            $value = get_object_vars($this->value);
        } else {
            $value = (array)$this->value;
        }

        $attribs = array();
        $str = array();

        $str[] = '<div id="' . $this->id . '_sortable" class="row-fluid">';

        // First Panel
        $str[] = '  <div class="span5">';
        $str[] = '      <ul class="source connected">';

        $options = $this->getOptions();

        foreach ($options as $option) {
            if (!in_array($option->value, $value))
                $str[] = '<li data-stock-symbol="' . $option->value . '">' . $option->text . '</li>';
        }

        $str[] = '      </ul>';
        $str[] = '  </div>';

        // Second Panel
        $str[] = '  <div class="span5">';
        $str[] = '      <ol class="target connected">';

        $options = $this->getOptions();

        foreach ($value as $val) {
            $find = array_filter($options, function($obj) use($val) { return $obj->value == $val;});
            $find = reset($find);
            $text = "";
            if($find)
                $text = $find->text;
            $str[] = '<li data-stock-symbol="' . $val . '">' . $text . '</li>';
        }

        $str[] = '      </ol>';
        $str[] = '  </div>';

        // Input
        $value_str = $value ? json_encode($value) : "";
        $str[] = FootManager\UI\Html\Form::hidden(array("id" => $this->id, "name" => $this->name, "value" => $value_str));

        $str[] = '</div>';

        $attribs["connectWith"] = "#".$this->id."_sortable .connected";
        $attribs["update"] = '\\function() {
            var items = [];
			jQuery("#' . $this->id . '_sortable ol.target").children().each(function() {
			    var item = jQuery(this).data("stock-symbol");
			    items.push(item);
			});

            var str = "";
			if(items.length > 0)
				str = JSON.stringify(items);
			jQuery("#' . $this->id . '").val(str);
        }';

        FootManager\UI\ui::sortable("#".$this->id."_sortable .source, #".$this->id."_sortable .connected", $attribs);

        return implode("\n", $str);

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
        $html[] = $this->getLabel();
        $html[] = $this->getInput();
        $html[] = '</div>';

        return implode("\n", $html);

		if ($this->hidden)
		{
			return $this->getInput();
		}

		if (!isset($options['class']))
		{
			$options['class'] = '';
		}

		$options['rel'] = '';

		if (empty($options['hiddenLabel']) && $this->getAttribute('hiddenLabel'))
		{
			$options['hiddenLabel'] = true;
		}

		if ($showon = $this->getAttribute('showon'))
		{
			$showon   = explode(':', $showon, 2);
			$options['class'] .= ' showon_' . implode(' showon_', explode(',', $showon[1]));
			$id = $this->getName($showon[0]);
			$id = $this->multiple ? str_replace('[]', '', $id) : $id;
			$options['rel'] = ' rel="showon_' . $id . '"';
			$options['showonEnabled'] = true;
		}

		return JLayoutHelper::render($this->renderLayout, array('input' => $this->getInput(), 'label' => $this->getLabel(), 'options' => $options));
	}

}