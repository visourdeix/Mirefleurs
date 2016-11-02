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
class FmmanagerModelCategories extends FMManager\Model\Backend\DataList
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
			$config['filter_fields'] = array("year");
		}

		parent::__construct($config);
	}

    protected function _getModel() {
        return new FMManager\Database\Models\Category();
    }
}