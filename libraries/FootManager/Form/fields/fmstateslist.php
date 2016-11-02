<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Form
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;
jimport('FootManager.framework');
FootManager\Form\Helper::loadFieldClass('fmlist');

/**
 * Form Field class for the Joomla Platform.
 * Provides radio button inputs
 *
 * @link   http://www.w3.org/TR/html-markup/command.radio.html#command.radio
 * @since  11.1
 */
class JFormFieldFmStatesList extends JFormFieldFmList
{

    /**
     * Method to get the field input markup.
     *
     * @return  string  The field input markup.
     *
     * @since   11.1
     */
	protected function getInput() {

        if(!$this->inRepeatable)
            FootManager\UI\ui::statesselect('#'.$this->id);
        else
            FootManager\UI\Loader::statesselect();

		return parent::getInput();

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
	protected function getDefaultOptions()
	{
        $options = array();

        $notPlayed = new stdClass();
        $notPlayed->value = FootManager\Constants::TO_BE_COME;
        $notPlayed->text = JText::_("FMLIB_STATE_0");
        $options[] = $notPlayed;

        $played = new stdClass();
        $played->value = FootManager\Constants::DONE;
        $played->text = JText::_("FMLIB_STATE_1");
        $options[] = $played;

        $reported = new stdClass();
        $reported->value = FootManager\Constants::REPORTED;
        $reported->text = JText::_("FMLIB_STATE_2");
        $options[] = $reported;

        $cancelled = new stdClass();
        $cancelled->value = FootManager\Constants::CANCELLED;
        $cancelled->text = JText::_("FMLIB_STATE_3");
        $options[] = $cancelled;

        $stopped = new stdClass();
        $stopped->value = FootManager\Constants::STOPPED;
        $stopped->text = JText::_("FMLIB_STATE_4");
        $options[] = $stopped;

		return $options;
	}

}