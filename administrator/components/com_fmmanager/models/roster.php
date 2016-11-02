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
 * Methods supporting a record.
 *
 */
class FmmanagerModelRoster extends FootManager\Model\Admin {

    /**
     * Method to get a menu item.
     *
     * @param   integer  $pk  An optional id of the object to get, otherwise the id from the model state is used.
     *
     * @return  mixed  Menu item data object on success, false on failure.
     *
     * @since   1.6
     */
	public function getItem($pk = null)
	{
        $item = parent::getItem($pk);

        $item->team = FMManager\Database\Models\Team::withoutGlobalScopes()->find($item->team_id);

        return $item;

    }
}