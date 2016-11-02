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
class FmactivityModelActivities extends FootManager\Model\Items
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
				'state',
				'access', 'viewlevels.title',
				'created',
				'created_by',
				'published',
				'modified',
				'modified_by',
                'extension',
                'featured',
                'type', 'event_id', 'client_id'
			);
		}

        $this->default_search = ["fmactivity_items.title"];

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
		parent::populateState('created', 'desc');

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
        $id .= ':' . $this->getState('filter.extension');
        $id .= ':' . $this->getState('filter.user');
        $id .= ':' . $this->getState('filter.event');
        $id .= ':' . $this->getState('filter.featured');

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
            ->joinViewLevel()
            ->joinType()
                    ->with(["viewLevel", "item.type"]);

        // Filter by access level.
		if ($access = $this->getState('filter.access'))
			$query = $query->where('fmactivity_activities.access', "=", (int) $access);

        // Implement View Level Access
        $user = JFactory::getUser();
        $groups = $user->getAuthorisedViewLevels();
		if (!$user->authorise('core.admin'))
		{
			$query = $query->whereIn('fmactivity_activities.access', $groups );
		}

        // Filter by published state
		$published = $this->getState('filter.published');

		if (is_numeric($published))
			$query = $query->where('fmactivity_activities.state', "=", (int) $published);
		elseif ($published === '')
			$query = $query->where(function($query) {
                $query->where("fmactivity_activities.state", "=", 0)->orWhere("fmactivity_activities.state", "=", 1);
        });

        // Filter by featured state
		$featured = $this->getState('filter.featured');

        if($featured) {
            if($featured == -1)
                $query = $query->where('fmactivity_activities.featured', "=", 0);
            else
                $query = $query->where('fmactivity_activities.featured', "=", 1);
        }

        // Filter by published state
		$extension = $this->getState('filter.extension');

		if ($extension)
			$query = $query->where('fmactivity_item_types.extension', "=", $extension);

        // Filter by published state
		$event = $this->getState('filter.event');

		if ($event)
			$query = $query->where('fmactivity_activities.event_id', "=", $event);

        // Filter by published state
		$user = $this->getState('filter.user');

		if ($user)
			$query = $query->where('fmactivity_activities.created_by', "=", $user);

        return $query;

	}

    protected function _getModel() {
        return new FMActivity\Database\Models\Activity();
    }

    /**
     * Method to get an array of data items.
     *
     * @return  mixed  An array of data items on success, false on failure.
     *
     * @since   12.2
     */
	public function getItems()
	{
        $items = parent::getItems();
        return $items->map(function($obj) { return $obj->getActivityModel(); });

    }

}