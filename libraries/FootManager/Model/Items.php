<?php
/**
 * @package      FootManager
 * @subpackage   Models
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FootManager\Model;

defined('JPATH_PLATFORM') or die;
/**
 * This class contains common methods and properties
 * used in work with ajax actions.
 *
 * @package      FootManager
 * @subpackage   Models
 */
abstract class Items extends \JModelList
{

    /**
     * An internal cache for the last query used.
     *
     * @var    \FootManager\Database\Eloquent\Builder
     * @since  12.2
     */
	protected $query;

    /**
     * Field used in default search
     *
     * @var    array
     * @since  12.2
     */
	protected $default_search;

    /**
     * Method to get a table object, load it if necessary.
     *
     * @param   string  $name     The table name. Optional.
     * @param   string  $prefix   The class prefix. Optional.
     * @param   array   $options  Configuration array for model. Optional.
     *
     * @return  \JTable  A JTable object
     *
     * @since   12.2
     * @throws  \Exception
     */
    public function getTable($name = '', $prefix = '', $options = array()) {
        if($name =='')
            if(!\FootManager\Utilities\StringHelper::isSingular($this->getName()))
                $name = \FootManager\Utilities\StringHelper::singularize($this->getName());
        if($prefix == '')
            $prefix = ucfirst(strtolower(str_replace('com_', '', $this->option)))."Table";
        return parent::getTable($name, $prefix, $options);
    }

    /**
     * Gets the table name.
     * @return string
     */
    protected function getTableName() {
        return $this->getTable()->getTableName();
    }

    /**
     * Build an SQL query to load the list data.
     *
     * @return  \FootManager\Database\Eloquent\Builder
     * @since   1.6
     */
	protected function getListQuery()
	{
        $model = $this->_getModel();
        $table = $model->getTable();

        // Select
        $query = $model->withoutGlobalScopes()->select($table.".*");

        // Default Where
        $search = $this->getState('filter.search');
		if (!empty($search) && $this->default_search)
		{
			if (stripos($search, 'id:') === 0)
                $query = $query->where("id", "=", (int) substr($search, 3));
			else
			{
                $fields = $this->default_search;
                if($fields)
                    $query = $query->where(function($query)use($fields, $search) {
                                        foreach ($fields as $field)
                    	                    $query->orWhere($field, "LIKE", '%' . $search . '%');
                                });
			}
		}

        // Order By
		$orderCol = $this->state->get('list.ordering', '');
		$orderDirn = $this->state->get('list.direction', 'ASC');

        if($orderCol) $query = $this->_addSort($query, $orderCol, $orderDirn);

        return $query;

	}

    /**
     * Add a sort.
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $orderCol
     * @param string $orderDirn
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function _addSort(&$query, $orderCol, $orderDirn = 'ASC') {
        $model = $this->_getModel();
        $table = $model->getTable();
        if (!stripos($orderCol, '.')) $orderCol = $table.".".$orderCol;
        return $query->orderBy($orderCol, $orderDirn);
    }

    /**
     * Returns a record count for the query.
     *
     * @param   \JDatabaseQuery|string|\Illuminate\Database\Eloquent\Builder  $query  The query.
     *
     * @return  integer  Number of rows for query.
     *
     * @since   12.2
     */
	protected function _getListCount($query)
	{
        if($query instanceof \Illuminate\Database\Eloquent\Builder) {
            $clone = clone($query);
            $clone->getQuery()->orders = null;
            return $clone->count();
        } else {
            return parent::_getListCount($query);
        }
	}

    /**
     * Gets an array of objects from the results of database query.
     *
     * @param   string   $query       The query.
     * @param   integer  $limitstart  Offset.
     * @param   integer  $limit       The number of records.
     *
     * @return  array  An array of results.
     *
     * @since   12.2
     * @throws  \RuntimeException
     */
	protected function _getList($query, $limitstart = 0, $limit = 0)
	{
        if($query instanceof \Illuminate\Database\Eloquent\Builder) {
            if($limitstart > 0) $query = $query->skip($limitstart);
            if($limit > 0) $query = $query->take($limit);
            return $query->get();
        } else {
            return parent::_getList($query, $limitstart, $limit);
        }
	}

    /**
     * @return \Illuminate\Database\Eloquent\Model the model.
     */
    protected abstract function _getModel();

}