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
FootManager\Form\Helper::loadFieldClass('fmgroupedlist');

/**
 * Form Field class for the Joomla Platform.
 * Provides radio button inputs
 *
 * @link   http://www.w3.org/TR/html-markup/command.radio.html#command.radio
 * @since  11.1
 */
class JFormFieldCompetitionsList extends JFormFieldFmGroupedList
{
    protected $ranking = false;

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
            $this->ranking    = (string) $this->element['ranking'] ? (string) $this->element['ranking'] == "true" || $this->element['ranking'] ==  "1" : false;
		}

		return $return;
	}

    protected function getDefaultEditLink() {
        return "index.php?option=".FM_MANAGER_COMPONENT."&task=competition.edit";
    }

    protected function getDefaultButtonTitle() {
        return "COM_FMMANAGER_CREATE_NEW_COMPETITION";
    }

    protected function getDefaultPlaceHolder() {
        return "COM_FMMANAGER_SELECT_COMPETITION";
    }

    protected function allowEdit() {
        return \FootManager\Helpers\Access::getActions(FM_MANAGER_COMPONENT)->get("competitions.manage");
    }

    /**
     * Method to get the field option groups.
     *
     * @return  array  The field option objects as a nested array in groups.
     *
     * @since   11.1
     * @throws  UnexpectedValueException
     */
	protected function getDefaultGroups()
	{
        $competitions = FMManager\Database\Models\Competition::joinTournamentType()
            ->joinSeason()
            ->joinCategory()
            ->orderBy("fm_seasons.ordering")
            ->orderBy("fm_categories.ordering")
            ->orderBy("fm_tournament_types.ordering")
            ->orderBy("fm_tournaments.ordering");

        if($this->ranking) $competitions->where("fm_tournament_types.has_ranking", "=", "1");

        return $competitions->get()
            ->toGroupedDropdown(function($obj) { return $obj->season->label; }, function($obj) { return $obj->medium_name; });
    }

}