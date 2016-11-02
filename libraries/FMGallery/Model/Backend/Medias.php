<?php
/**
 * @package     Fmmanager
 * @subpackage  Positions
 *
 * @copyright   Copyright (C) 2015 STéphane ANDRE. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace FMGallery\Model\Backend;

defined('_JEXEC') or die;

/**
 * Methods supporting a list of positions records.
 *
 */
abstract class Medias extends \FootManager\Model\Items
{
    protected $table;

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
                'date',
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

        if(\FootManager\Utilities\StringHelper::isSingular($this->getName()))
            $name = \FootManager\Utilities\StringHelper::pluralize($this->getName());
        else
            $name = $this->getName();

        $this->table = "fmgallery_".$name;

        $this->default_search = [$this->table.".title"];

		parent::__construct($config);
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
			$query = $query->where($this->table.'.access', "=", (int) $access);

        // Implement View Level Access
        $user = \JFactory::getUser();
		if (!$user->authorise('core.admin'))
		{
			$groups = implode(',', $user->getAuthorisedViewLevels());
			$query = $query->whereIn($this->table.'.access', $groups );
		}

        // Filter by published state
		$published = $this->getState('filter.published');

		if (is_numeric($published))
			$query = $query->where($this->table.'.state', "=", (int) $published);
		elseif ($published === '')
			$query = $query->where(function($query) {
                $query->where($this->table.".state", "=", 0)->orWhere($this->table.".state", "=", 1);
        });

        // Filter by a single or group of categories.
		$baselevel = 1;
		$categoryId = $this->getState('filter.category_id');

		if (is_numeric($categoryId))
		{
			$cat_tbl = \JTable::getInstance('Category', 'JTable');
			$cat_tbl->load($categoryId);
			$rgt = $cat_tbl->rgt;
			$lft = $cat_tbl->lft;
			$baselevel = (int) $cat_tbl->level;
            $query = $query->where('categories.lft', ">=", (int) $lft)->where('categories.rgt', "<=", (int) $rgt);
		}
		elseif (is_array($categoryId))
		{
			\JArrayHelper::toInteger($categoryId);
			$categoryId = implode(',', $categoryId);
            $query = $query->whereIn($this->table.'.catid', $categoryId );
		}

        // Filter on the level.
		if ($level = $this->getState('filter.level'))
            $query = $query->where('categories.level', "<=", ((int) $level + (int) $baselevel - 1));

		// Filter by a single tag.
		$tagId = $this->getState('filter.tag');

        if (is_numeric($tagId))
        {
            $name = \FootManager\Utilities\StringHelper::singularize($this->getName());
            $query = $query->join("contentitem_tag_map", "contentitem_tag_map.content_item_id", "=", "fmgallery_photos.id")->where("contentitem_tag_map.tag_id", "=", (int) $tagId)->where("contentitem_tag_map.type_alias", "=", FM_GALLERY_COMPONENT.".".$name);
        }

        // Order
        $orderCol = $this->state->get('list.ordering', '');

        switch ($orderCol)
        {
            case "categories.title" :
                $query = $this->_addSort($query, $this->table.".ordering");
                break;
        }

        return $query;

	}

}