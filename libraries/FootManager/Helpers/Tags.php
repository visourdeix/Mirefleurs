<?php
/**
 * @package      FootManager
 * @subpackage   Helpers
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FootManager\Helpers;

defined('JPATH_PLATFORM') or die;
/**
 * This class contains common methods and properties for a database item
 *
 * @package      FootManager
 * @subpackage   Helpers
 */
abstract class Tags
{
	/**
     * Method to get a query to retrieve a detailed list of items for a tag.
     *
     * @param   mixed    $tagId            Tag or array of tags to be matched
     * @param   mixed    $typesr           Null, type or array of type aliases for content types to be included in the results
     * @param   boolean  $includeChildren  True to include the results from child tags
     * @param   string   $orderByOption    Column to order the results by
     * @param   string   $orderDir         Direction to sort the results in
     * @param   boolean  $anyOrAll         True to include items matching at least one tag, false to include
     *                                     items all tags in the array.
     * @param   string   $languageFilter   Optional filter on language. Options are 'all', 'current' or any string.
     * @param   string   $stateFilter      Optional filtering on publication state, defaults to published or unpublished.
     *
     * @return  \JDatabaseQuery  Query to retrieve a list of tags
     *
     * @since   3.1
     */
	public static function getTagItemsQuery($tagId, $typesr = null, $includeChildren = false, $orderByOption = 'c.core_title', $orderDir = 'ASC',
		$anyOrAll = true, $languageFilter = 'all', $stateFilter = '0,1')
	{
		// Create a new query object.
		$db = \JFactory::getDbo();
		$query = $db->getQuery(true);
		$user = \JFactory::getUser();
		$nullDate = $db->quote($db->getNullDate());
		$nowDate = $db->quote(\JFactory::getDate()->toSql());

		$ntagsr = substr_count($tagId, ',') + 1;

		// Force ids to array and sanitize
		$tagIds = (array) $tagId;
		$tagIds = implode(',', $tagIds);
		$tagIds = explode(',', $tagIds);
		\JArrayHelper::toInteger($tagIds);

		// If we want to include children we have to adjust the list of tags.
		// We do not search child tags when the match all option is selected.
		if ($includeChildren)
		{
			$tagTreeList = '';
			$tagTreeArray = array();

			foreach ($tagIds as $tag)
			{
				self::getTagTreeArray($tag, $tagTreeArray);
			}

			$tagIds = array_unique(array_merge($tagIds, $tagTreeArray));
		}

		// Sanitize filter states
		$stateFilters = explode(',', $stateFilter);
		\JArrayHelper::toInteger($stateFilters);

		// M is the mapping table. C is the core_content table. Ct is the content_types table.
		$query
			->select(
				'm.type_alias'
				. ', ' . 'm.content_item_id'
				. ', ' . 'm.core_content_id'
				. ', ' . 'count(m.tag_id) AS match_count'
				. ', ' . 'MAX(m.tag_date) as tag_date'
				. ', ' . 'MAX(c.core_title) AS core_title'
				. ', ' . 'MAX(c.core_params) AS core_params'
			)
			->select('MAX(c.core_alias) AS core_alias, MAX(c.core_body) AS core_body, MAX(c.core_state) AS core_state, MAX(c.core_access) AS core_access')
			->select(
				'MAX(c.core_metadata) AS core_metadata'
				. ', ' . 'MAX(c.core_created_user_id) AS core_created_user_id'
				. ', ' . 'MAX(c.core_created_by_alias) AS core_created_by_alias'
			)
			->select('MAX(c.core_created_time) as core_created_time, MAX(c.core_images) as core_images')
			->select('CASE WHEN c.core_modified_time = ' . $nullDate . ' THEN c.core_created_time ELSE c.core_modified_time END as core_modified_time')
			->select('MAX(c.core_language) AS core_language, MAX(c.core_catid) AS core_catid')
			->select('MAX(c.core_publish_up) AS core_publish_up, MAX(c.core_publish_down) as core_publish_down')
			->select('MAX(ct.type_title) AS content_type_title, MAX(ct.router) AS router')

			->from('#__contentitem_tag_map AS m')
			->join(
				'INNER',
				'#__ucm_content AS c ON m.type_alias = c.core_type_alias AND m.core_content_id = c.core_content_id AND c.core_state IN ('
					. implode(',', $stateFilters) . ')'
					. (in_array('0', $stateFilters) ? '' : ' AND (c.core_publish_up = ' . $nullDate
					. ' OR c.core_publish_up <= ' . $nowDate . ') '
					. ' AND (c.core_publish_down = ' . $nullDate . ' OR  c.core_publish_down >= ' . $nowDate . ')')
			)
			->join('INNER', '#__content_types AS ct ON ct.type_alias = m.type_alias')

			// Join over categoris for get only published
			->join('LEFT', '#__categories AS tc ON tc.id = c.core_catid AND tc.published = 1')

			// Join over the users for the author and email
			->select("CASE WHEN c.core_created_by_alias > ' ' THEN c.core_created_by_alias ELSE ua.name END AS author")
			->select("ua.email AS author_email")

			->join('LEFT', '#__users AS ua ON ua.id = c.core_created_user_id')

			->where('m.tag_id IN (' . implode(',', $tagIds) . ')');

		// Optionally filter on language
		if (empty($language))
		{
			$language = $languageFilter;
		}

		if ($language != 'all')
		{
			if ($language == 'current_language')
			{
				$language = self::getCurrentLanguage();
			}

			$query->where($db->quoteName('c.core_language') . ' IN (' . $db->quote($language) . ', ' . $db->quote('*') . ')');
		}

		// Get the type data, limited to types in the request if there are any specified.
		$typesarray = self::getTypes('assocList', $typesr, false);

		$typeAliases = array();

		foreach ($typesarray as $type)
		{
			$typeAliases[] = $db->quote($type['type_alias']);
		}

		$query->where('m.type_alias IN (' . implode(',', $typeAliases) . ')');

		$groups = '0,' . implode(',', array_unique($user->getAuthorisedViewLevels()));
		$query->where('c.core_access IN (' . $groups . ')')
			->group('m.type_alias, m.content_item_id, m.core_content_id, core_modified_time, core_created_time, core_created_by_alias, name, author_email');

		// Use HAVING if matching all tags and we are matching more than one tag.
		if ($ntagsr > 1 && $anyOrAll != 1 && $includeChildren != 1)
		{
			// The number of results should equal the number of tags requested.
			$query->having("COUNT('m.tag_id') = " . (int) $ntagsr);
		}

		// Set up the order by using the option chosen
		if ($orderByOption == 'match_count')
		{
			$orderBy = 'COUNT(m.tag_id)';
		}
		else
		{
			$orderBy = 'MAX(' . $db->quoteName($orderByOption) . ')';
		}

		$query->order($orderBy . ' ' . $orderDir);

		return $query;
	}

    /**
     * Method to get an array of tag ids for the current tag and its children
     *
     * @param   integer  $id             An optional ID
     * @param   array    &$tagTreeArray  Array containing the tag tree
     *
     * @return  mixed
     *
     * @since   3.1
     */
	public static function getTagTreeArray($id, &$tagTreeArray = array())
	{
		// Get a level row instance.
		\JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_tags/tables');
		$table = \JTable::getInstance('Tag', 'TagsTable');

		if ($table->isLeaf($id))
		{
			$tagTreeArray[] = $id;

			return $tagTreeArray;
		}

		$tagTree = $table->getTree($id);

		// Attempt to load the tree
		if ($tagTree)
		{
			foreach ($tagTree as $tag)
			{
				$tagTreeArray[] = $tag->id;
			}

			return $tagTreeArray;
		}
	}

    /**
     * Method to get a list of types with associated data.
     *
     * @param   string   $arrayType    Optionally specify that the returned list consist of objects, associative arrays, or arrays.
     *                                 Options are: rowList, assocList, and objectList
     * @param   array    $selectTypes  Optional array of type ids to limit the results to. Often from a request.
     * @param   boolean  $useAlias     If true, the alias is used to match, if false the type_id is used.
     *
     * @return  array   Array of of types
     *
     * @since   3.1
     */
	public static function getTypes($arrayType = 'objectList', $selectTypes = null, $useAlias = true)
	{
		// Initialize some variables.
		$db = \JFactory::getDbo();
		$query = $db->getQuery(true)
			->select('*');

		if (!empty($selectTypes))
		{
			$selectTypes = (array) $selectTypes;

			if ($useAlias)
			{
				$selectTypes = array_map(array($db, 'quote'), $selectTypes);

				$query->where($db->quoteName('type_alias') . ' IN (' . implode(',', $selectTypes) . ')');
			}
			else
			{
				\JArrayHelper::toInteger($selectTypes);

				$query->where($db->quoteName('type_id') . ' IN (' . implode(',', $selectTypes) . ')');
			}
		}

		$query->from($db->quoteName('#__content_types'));

		$db->setQuery($query);

		switch ($arrayType)
		{
			case 'assocList':
				$types = $db->loadAssocList();
				break;

			case 'rowList':
				$types = $db->loadRowList();
				break;

			case 'objectList':
			default:
				$types = $db->loadObjectList();
				break;
		}

		return $types;
	}

    /**
     * Gets the current language
     *
     * @param   boolean  $detectBrowser  Flag indicating whether to use the browser language as a fallback.
     *
     * @return  string  The language string
     *
     * @since   3.2
     */
	public function getCurrentLanguage($detectBrowser = true)
	{
		$app = \JFactory::getApplication();
		$langCode = $app->input->cookie->getString(\JApplicationHelper::getHash('language'));

		// No cookie - let's try to detect browser language or use site default
		if (!$langCode)
		{
			if ($detectBrowser)
			{
				$langCode = \JLanguageHelper::detectLanguage();
			}
			else
			{
				$langCode = \JComponentHelper::getParams('com_languages')->get('site', 'en-GB');
			}
		}

		return $langCode;
	}

}