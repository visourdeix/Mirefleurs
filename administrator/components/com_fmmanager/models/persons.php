<?php
/**
 * @package     Fmmanager
 * @subpackage  com_fmmanager
 *
 * @copyright   Copyright (C) 2015 STéphane ANDRE. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Methods supporting a list of persons records.
 *
 */
class FmmanagerModelPersons extends FootManager\Model\Items
{
	/**
     * Constructor.
     *
     * @param   array  $config  An optional associative array of configuration settings.
     *
     * @see     JController
     * @since   1.6
     */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'last_name',
                'first_name',
				'license',
                'active',
                'gender',
				'fm_categories.ordering',
                'birthdate',
                'categories',
                'id'
			);
		}

        $this->default_search = ["fm_persons.last_name", "fm_persons.first_name"];

		parent::__construct($config);
	}

    /**
     * Method to auto-populate the model state.
     *
     * This method should only be called once per instantiation and is designed
     * to be called on the first call to the getState() method unless the model
     * configuration flag to ignore the request is set.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @param   string  $ordering   An optional ordering field.
     * @param   string  $direction  An optional direction (asc|desc).
     *
     * @return  void
     *
     * @since   12.2
     */
	protected function populateState($ordering = null, $direction = null)
	{
        parent::populateState("last_name", "ASC");
    }

	/**
     * Method to get a store id based on model configuration state.
     *
     * This is necessary because the model is used by the component and
     * different modules that might need different sets of data or different
     * ordering requirements.
     *
     * @param   string  $id    A prefix for the store id.
     *
     * @return  string  A store id.
     * @since   1.6
     */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id .= ':' . $this->getState('filter.search');
        $id .= ':' . $this->getState('filter.gender');
        $id .= ':' . implode(",", (array)$this->getState('filter.categories'));
        $id .= ':' . $this->getState('filter.active');

		return parent::getStoreId($id);
	}

    /**
     * Build an SQL query to load the list data.
     *
     * @return  \FootManager\Database\Eloquent\Builder
     * @since   1.6
     */
	protected function getListQuery()
	{
        $query = parent::getListQuery()->with('category', 'contacts')->joinCategory();

        // Where
        $gender = $this->getState('filter.gender');
        $active = $this->getState('filter.active', 1);
        $active = ($active =="") ? 1 : $active;
        $categories = $this->getState('filter.categories');

        if($categories) $query = $query->whereIn("category_id", $categories);
        if($gender) $query = $query->where("gender", "=", $gender);
        if(isset($active) && $active > -1) $query = $query->where("active", "=", $active);

        // Order
        $orderCol = $this->state->get('list.ordering', '');

        switch ($orderCol)
        {
            case "last_name" :
                $query = $this->_addSort($query, "first_name");
                break;
        }

        return $query;

	}

    protected function _getModel() {
        return new FMManager\Database\Models\Person();
    }

}