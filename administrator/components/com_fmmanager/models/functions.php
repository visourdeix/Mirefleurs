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
 * Methods supporting a list of records.
 *
 */
class FmmanagerModelFunctions extends FMManager\Model\Backend\DataList
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
			$config['filter_fields'] = array("extra");
		}

		parent::__construct($config);
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
        $id .= ':' . $this->getState('filter.extra');

		return parent::getStoreId($id);
	}

    /**
     * Set the query.
     * @param JDatabaseQuery $query
     */
    protected function getListQuery() {

        $query = parent::getListQuery();

        $extra = $this->getState('filter.extra', -1);
        $extra = ($extra =="") ? -1 : $extra;

        if ($extra > -1) $query->where("extra", "=", $extra);

        return $query;
    }

    protected function _getModel() {
        return new FMManager\Database\Models\_Function();
    }
}