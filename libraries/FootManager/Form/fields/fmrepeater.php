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
class JFormFieldFmRepeater extends JFormField
{
	/**
     * The form field type.
     *
     * @var    string
     * @since  3.2
     */
	protected $type = 'FmRepeater';

    protected $subForm;
    protected $component;
    protected $view;
    protected $filters;
    protected $primaryKey;
    protected $canAdd;
    protected $canRemove;

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
            $this->component    = (string) $this->element['component'] ? (string) $this->element['component'] : "";
            $this->view    = (string) $this->element['view'] ? (string) $this->element['view'] : "";
            $this->filters    = (string) $this->element['filters'] ? (string) $this->element['filters'] : "";
            $this->primaryKey    = (string) $this->element['primaryKey'] ? (string) $this->element['primaryKey'] : "";
            $this->canAdd    = isset($this->element['canAdd']) ? ((string)$this->element['canAdd'] == "false") : true;
            $this->canRemove    = isset($this->element['canRemove']) ? ((string)$this->element['canRemove'] == "false") : true;
            $this->class    = (string) $this->element['class'] ? (string) $this->element['class'] : "fm-table-responsive table-striped";

            // Initialize variables.
			$this->subForm = new JForm($this->name, array('control' => $this->name));
            $children = $this->element->children();
            if(count((array)$children) > 0 && $children[0]->getName() !== 'field') {
                $children = $children[0]->children();
            }
			$xml = $children->asXML();

			$this->subForm->load($xml);
            $this->subForm->setFields($children);

			// Needed for repeating modals in gmaps
			$this->subForm->repeatCounter = (int) @$this->form->repeatCounter;

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
        // Init variables
		$attribs = array();
		$fields = array();
        $links = array();
        $multiple = array();

        if($this->view) {
            $multiple = array("view" => $this->view, "component" => $this->component, "primaryKey" => $this->primaryKey, "filters" => $this->filters);
        }

        // Init attribs
        if(is_string($this->value))
            $attribs["values"] = (array)json_decode($this->value);
        elseif(is_object($this->value))
            $attribs["values"] = get_object_vars($this->value);
        else
            $attribs["values"] = (array)$this->value;
        $attribs["canAdd"] = $this->canAdd;
        $attribs["canRemove"] = $this->canRemove;

        // Init fields
		foreach ($this->subForm->getGroup(null) as $field)
		{
            $field->__set("inRepeater", true);

            if(($field instanceof JFormFieldFmList || $field instanceof JFormFieldFmGroupedList)) {
                if($field->__get("editLink") != "" && $field->__get("editLink") != "none") {
                    if(!$field->readonly && !$field->disabled)
                        $links[] = array($field->__get("editLink"), $field->__get("buttonTitle"));
                    $field->__set("editLink", "");
                }
            }

			$item = array();
			$item["label"] = $field->getLabel($field->name);
			$item["description"] = JText::_($field->description);
			$item["input"] = $field->getInput();
            $item["hidden"] = ($field instanceof JFormFieldHidden);
			$fields[] = $item;
		}

        $str = array();

        // Add links
        if($links) {

            $str[] = '<div class="btn-group pull-right fm-margin-bottom-5">';
            $str[] = '     <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">'.JText::_("FMLIB_CREATE_NEW_ITEM").'  <span class="caret"></span></a>';

            $str[] = '     <ul class="dropdown-menu">';

            foreach($links as $link) {
                $str[] = '     <li><a href="'.$link[0].'" target="_blank">'.JText::_($link[1]).'</a></li>';
            }

            $str[] = '     </ul>';
            $str[] = '</div>';
            $str[] = '<div class="clearfix"></div>';
        }

        $str[] = '<div id="'.$this->id.'_repeater" >';

        // Add Buttons (for phones)
        $addItemButtonStr = '          <a class="btn btn-success hasTooltip" title="' . JText::_("FMLIB_ADD_NEW_ITEM") . '" data-repeater-add-button><span class="fa fa-plus"></span></a>';
        $addItemsButtonStr = "";
        if($multiple && isset($multiple["view"]) && $multiple["view"]) {
            $component = (isset($multiple["component"]) && $multiple["component"]) ? $multiple["component"] : "";
            $filters = (isset($multiple["filters"]) && $multiple["filters"]) ? '&'.$multiple["filters"] : '';
            $formLink = 'index.php?option='.$component.'&view='.$multiple["view"].'&layout=modal&tmpl=component&function=fmSelectItems'.$this->id.$filters;
            $addItemsButtonStr = '          <a class="modal btn btn-info hasTooltip" title="' . JText::_("FMLIB_ADD_ITEMS") . '" href="'.$formLink.'" rel="{handler: \'iframe\', size: {x:800, y:450}, id: \'iframe\'}"><span class="fa fa-bars"></span></a>';
        }

        if($this->canAdd) {
            $buttons_visibility = (strstr($this->class, 'fm-table-responsive-fix')) ? "" : "visible-phone";
            $str[] = '  <div class="text-right fm-margin-bottom-5 '.$buttons_visibility.'">';
            $str[] = '      <div class="btn-group">';
            $str[] = $addItemButtonStr;
            $str[] = $addItemsButtonStr;
            $str[] = '      </div>';
            $str[] = '  </div>';
        }

        // Add Table
        $str[] = '  <table class="table '.$this->class.'">';

        // Header
        $str[] = '      <thead>';
        $str[] = '          <tr>';

        foreach ($fields as $field) {
            $hiddenClass = ($field["hidden"]) ? " hidden" : "";
            $str[] = '          <th class="center'.$hiddenClass.'">';
            $str[] = '              <span class="hasTooltip" title="' . $field['description'] . '">' . strip_tags($field['label']) . '</span>';
            $str[] = '          </th>';
        }

        // Add Buttons
        if($this->canRemove || $this->canAdd) {
            $str[] = '              <th class="center">';
            if($this->canAdd) {
                $str[] = '                    <div class="btn-group">';
                $str[] = $addItemButtonStr;
                $str[] = $addItemsButtonStr;
                $str[] = '                    </div">';
            }
            $str[] = '              </th>';
        }

        $str[] = '          </tr>';
        $str[] = '      </thead>';

        // Body
        $str[] = '      <tbody>';
        $str[] = '          <tr>';

        foreach ($fields as $key => $field) {
            $hiddenClass = ($field["hidden"]) ? " hidden" : "";
            $str[] = '          <td class="center'.$hiddenClass.'" data-title="' . strip_tags($field['label']) . '">';
            $str[] = '              <div class="fm-repeater-col-'.$key.'">';
            $str[] =                    $field["input"];
            $str[] = '              </div>';
            $str[] = '          </td>';
        }

        if($this->canRemove || $this->canAdd) {
            $str[] = '              <td class="center">';
            if($this->canRemove) {
                $str[] = '                  <a class="btn btn-danger hasTooltip" title="' . JText::_("FMLIB_REMOVE_ITEM") . '" data-repeater-remove-button><span class="fa fa-minus"></span></a>';
            }
            $str[] = '              </td>';
        }

        $str[] = '          </tr>';
        $str[] = '      </tbody>';

        $str[] = '  </table>';

        // Add save input
        $str[] = '  <input type="hidden" id="'.$this->id.'" name="'.$this->name.'" value="" data-repeater-save />';

        $str[] = '</div>';

        if($multiple) {
            $primaryKey = isset($multiple["primaryKey"]) && $multiple["primaryKey"] ? $multiple["primaryKey"] : "id";
            $script = "function fmSelectItems".$this->id."(ids) {
                            var array = typeof ids == 'string' ? [ids] : ids;
                            var values;
                            for (i = 0; i < array.length; i++) {
                                values = [];
                                values['$primaryKey'] = array[i];
                                jQuery('#".$this->id."_repeater').data('Repeater').addRow(values);
                            }

                            SqueezeBox.close();

                        }";

            JFactory::getDocument()->addScriptDeclaration($script);
        }

        FootManager\UI\ui::repeater('#'.$this->id.'_repeater', $attribs);

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
	}

}