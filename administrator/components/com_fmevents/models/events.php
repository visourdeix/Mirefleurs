<?php
/**
 * @package     Fmmanager
 * @subpackage  Positions
 *
 * @copyright   Copyright (C) 2015 STéphane ANDRE. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Methods supporting a list of positions records.
 *
 */
class FmeventsModelEvents extends FootManager\Model\Items
{
	/**
     * Constructor.
     *
     * @param   array  $config  An optional associative array of configuration settings.
     *
     * @since   1.6
     * @see     JController
     */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id',
				'title',
				'alias',
                'start_date',
                'end_date',
                'start_time',
                'end_time',
				'catid', 'categories.title',
				'state',
				'access', 'viewlevels.title',
				'created',
				'created_by',
				'ordering',
				'hits',
				'published',
				'category_id',
				'level',
				'tag'
			);
		}

        $this->default_search = ["fmevents_events.title"];

		parent::__construct($config);
	}

	/**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @param   string  $ordering   An optional ordering field.
     * @param   string  $direction  An optional direction (asc|desc).
     *
     * @return  void
     *
     * @since   1.6
     */
	protected function populateState($ordering = null, $direction = null)
	{
		// List state information.
		parent::populateState('start_date', 'desc');

	}

	/**
     * Method to get a store id based on model configuration state.
     *
     * This is necessary because the model is used by the component and
     * different modules that might need different sets of data or different
     * ordering requirements.
     *
     * @param   string  $id  A prefix for the store id.
     *
     * @return  string  A store id.
     *
     * @since   1.6
     */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id .= ':' . $this->getState('filter.search');
		$id .= ':' . $this->getState('filter.access');
		$id .= ':' . $this->getState('filter.published');
		$id .= ':' . $this->getState('filter.category_id');
		$id .= ':' . $this->getState('filter.author_id');
		$id .= ':' . $this->getState('filter.language');

		return parent::getStoreId($id);
	}

    /**
     * Build an SQL query to load the list data.
     *
     * @return  \Illuminate\Database\Eloquent\Builder
     * @since   1.6
     */
	protected function getListQuery()
	{
        $query = parent::getListQuery()
            ->joinCategory()
            ->joinViewLevel()
                    ->with(["category", "viewLevel"]);

        // Filter by access level.
		if ($access = $this->getState('filter.access'))
			$query = $query->where('fmevents_events.access', "=", (int) $access);

        // Implement View Level Access
        $user = JFactory::getUser();
        $groups = $user->getAuthorisedViewLevels();
		if (!$user->authorise('core.admin'))
		{
			$query = $query->whereIn('fmevents_events.access', $groups );
		}

        // Filter by published state
		$published = $this->getState('filter.published');

		if (is_numeric($published))
			$query = $query->where('fmevents_events.state', "=", (int) $published);
		elseif ($published === '')
			$query = $query->where(function($query) {
                $query->where("fmevents_events.state", "=", 0)->orWhere("fmevents_events.state", "=", 1);
        });

        // Filter by a single or group of categories.
		$baselevel = 1;
		$categoryId = $this->getState('filter.category_id');

		if (is_numeric($categoryId))
		{
			$cat_tbl = JTable::getInstance('Category', 'JTable');
			$cat_tbl->load($categoryId);
			$rgt = $cat_tbl->rgt;
			$lft = $cat_tbl->lft;
			$baselevel = (int) $cat_tbl->level;
            $query = $query->where('categories.lft', ">=", (int) $lft)->where('categories.rgt', "<=", (int) $rgt);
		}
		elseif (is_array($categoryId))
		{
			JArrayHelper::toInteger($categoryId);
			$categoryId = implode(',', $categoryId);
            $query = $query->whereIn('fmevents_events.catid', $categoryId );
		}

        // Filter on the level.
		if ($level = $this->getState('filter.level'))
            $query = $query->where('categories.level', "<=", ((int) $level + (int) $baselevel - 1));

		// Filter by a single tag.
		$tagId = $this->getState('filter.tag');

        if (is_numeric($tagId))
        {
            $query = $query->join("contentitem_tag_map", "contentitem_tag_map.content_item_id", "=", "fmevents_events.id")->where("contentitem_tag_map.tag_id", "=", (int) $tagId)->where("contentitem_tag_map.type_alias", "=", "com_fmevents.event");
        }

        // Order
        $orderCol = $this->state->get('list.ordering', '');

        switch ($orderCol)
        {
            case "categories.title" :
                $query = $this->_addSort($query, "fmevents_events.ordering");
                break;
        }

        return $query;

	}

    protected function _getModel() {
        return new FMEvents\Database\Models\Event();
    }

}