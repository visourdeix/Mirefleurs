<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Form
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;
jimport('FMManager.library');
FootManager\Form\Helper::loadFieldClass('fmradio');

/**
 * Form Field class for the Joomla Platform.
 * Provides radio button inputs
 *
 * @link   http://www.w3.org/TR/html-markup/command.radio.html#command.radio
 * @since  11.1
 */
class JFormFieldGenderRadio extends JFormFieldFmRadio
{

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
            $this->none    = ($this->element['none']) ? (bool) $this->element['none'] : false;
		}

        return $return;
	}

    /**
     * Method to get a list of categories that respects access controls and can be used for
     * either category assignment or parent category assignment in edit screens.
     * Use the parent element to indicate that the field will be used for assigning parent categories.
     *
     * @return  array  The field option objects.
     *
     * @since   1.6
     */
	protected function getOptions()
	{
        $options = array();

        $male = new stdClass();
        $male->value = FootManager\Constants::MALE;
        $male->text = "<i class='fa fa-mars'></i>";
        $male->title = JText::_("FMliB_GENDER_1");
        $male->active_class = "fm-btn-light-blue";
        $options[] = $male;

        if($this->none) {
            $none = new stdClass();
            $none->value = 0;
            $none->text = "<i class='fa fa-circle-o'></i>";
            $none->title = JText::_("FMLIB_NONE_1");
            $none->active_class = "btn-inverse";
            $options[] = $none;
        }

        $female = new stdClass();
        $female->value = FootManager\Constants::FEMALE;
        $female->text = "<i class='fa fa-venus'></i>";
        $female->title = JText::_("FMLIB_GENDER_2");
        $female->active_class = "fm-btn-pink";
        $options[] = $female;

		return $options;
	}

}