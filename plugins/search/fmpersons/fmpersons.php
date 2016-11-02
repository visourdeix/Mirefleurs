<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Search.contacts
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Contacts search plugin.
 *
 * @since  1.6
 */
class PlgSearchFmpersons extends JPlugin
{
	/**
     * Load the language file on instantiation.
     *
     * @var    boolean
     * @since  3.1
     */
	protected $autoloadLanguage = true;

	/**
     * Determine areas searchable by this plugin.
     *
     * @return  array  An array of search areas.
     *
     * @since   1.6
     */
	public function onContentSearchAreas()
	{
		static $areas = array(
        'fmpersons' => 'PLG_SEARCH_FMPERSONS_PERSONS'
		);

		return $areas;
	}

	/**
     * Search content (contacts).
     *
     * The SQL must return the following fields that are used in a common display
     * routine: href, title, section, created, text, browsernav.
     *
     * @param   string  $text      Target search string.
     * @param   string  $phrase    Matching option (possible values: exact|any|all).  Default is "any".
     * @param   string  $ordering  Ordering option (possible values: newest|oldest|popular|alpha|category).  Default is "newest".
     * @param   string  $areas     An array if the search is to be restricted to areas or null to search all areas.
     *
     * @return  array  Search results.
     *
     * @since   1.6
     */
	public function onContentSearch($text, $phrase = '', $ordering = '', $areas = null)
	{
		jimport("FMManager.library");

		$db = JFactory::getDbo();
		$app = JFactory::getApplication();
		$user = JFactory::getUser();
		$groups = implode(',', $user->getAuthorisedViewLevels());

		if (is_array($areas))
		{
			if (!array_intersect($areas, array_keys($this->onContentSearchAreas())))
			{
				return array();
			}
		}

		$limit = $this->params->def('search_limit', 50);

		$text = trim($text);

		if ($text == '')
		{
			return array();
		}

        $text = '%' . $text . '%';

        $persons = FMManager\Database\Models\Person::withoutGlobalScopes()->with("category")->joinCategory()->where(function($query) use($text) {
            $query->where("last_name", "LIKE", $text)
                ->orWhere("first_name", "LIKE", $text);
        });

		switch ($ordering)
		{
			case 'category':
                $persons = $persons->orderBy("fm_categories.ordering");

            case 'alpha':
			case 'popular':
			case 'newest':
			case 'oldest':
			default:
				$persons = $persons->orderBy("last_name")->orderBy("first_name");
		}

        $results = [];

        foreach ($persons->get() as $key => $person)
        {
            $results[$key] = new stdClass();
        	$results[$key]->href = FmmanagerHelperRoute::person($person);
            $results[$key]->title = $person->name;
            $results[$key]->text = "";
            $results[$key]->created = $person->created;
            $results[$key]->section = ($person->category) ? $person->category->label : "";
            $results[$key]->browsernav = "2";

        }

		return $results;
	}
}