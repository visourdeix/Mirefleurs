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
FootManager\Form\Helper::loadFieldClass('fmlist');

/**
 * Form Field class for the Joomla Platform.
 * Provides radio button inputs
 *
 * @link   http://www.w3.org/TR/html-markup/command.radio.html#command.radio
 * @since  11.1
 */
class JFormFieldContactTypesList extends JFormFieldList
{

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
        $mobile = new stdClass();
        $mobile->value = FootManager\Constants::MOBILE;
        $mobile->text = JText::_("FMLIB_CONTACT_1");

        $fixe = new stdClass();
        $fixe->value = FootManager\Constants::FIXE;
        $fixe->text = JText::_("FMLIB_CONTACT_2");

        $mail = new stdClass();
        $mail->value = FootManager\Constants::MAIL;
        $mail->text = JText::_("FMLIB_CONTACT_3");

        $fax = new stdClass();
        $fax->value = FootManager\Constants::FAX;
        $fax->text = JText::_("FMLIB_CONTACT_4");

		$options = array($mobile, $fixe, $mail, $fax);

		return $options;
	}

}