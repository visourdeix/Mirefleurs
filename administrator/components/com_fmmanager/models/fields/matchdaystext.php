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
JFormHelper::loadFieldClass('text');

/**
 * Form Field class for the Joomla Platform.
 * Provides radio button inputs
 *
 * @link   http://www.w3.org/TR/html-markup/command.radio.html#command.radio
 * @since  11.1
 */
class JFormFieldMatchdaysText extends JFormFieldText
{
    protected $tournament_type;

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
            $this->tournament_type    = (string) $this->element['tournament_type'] ? (string) $this->element['tournament_type'] : 0;
            $this->autocomplete = false;
		}

		return $return;
	}

    /**
     * Method to get the field options.
     *
     * @return  array  The field option objects.
     *
     * @since   3.4
     */
    protected function getOptions()
    {

        $matchdays = FMManager\Database\Models\Matchday::joinTournamentType()->where("fm_tournaments.type_id", "=", $this->tournament_type)->get()->getColumn("name")->toArray();

        $options = array();
        foreach ($matchdays as $name)
        {

            // Create a new option object based on the <option /> element.
            $options[] = JHtml::_(
                'select.option', (string) $name,
                JText::alt(trim((string) $name), preg_replace('/[^a-zA-Z0-9_\-]/', '_', $this->fieldname)), 'value', 'text'
            );
        }

        return $options;
    }

}