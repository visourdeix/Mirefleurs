<?php
/**
 * @package     Fmmanager
 * @subpackage  Positions
 *
 * @copyright   Copyright (C) 2015 STéphane ANDRE. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\Registry\Registry;

/**
 * Positions Table.
 *
 */
class FmactivityTableActivity extends FootManager\Table\Table
{

    function __construct(&$db)
    {
        parent::__construct(FMActivity\Database\Models\Activity::class, $db);

        // Set the alias since the column is called state
		$this->setColumnAlias('published', 'state');
    }

    /**
     * Overloaded check function
     *
     * @return  boolean  True on success, false on failure
     *
     * @see     JTable::check()
     * @since   11.1
     */
	public function check()
	{

		// Check the publish down date is not earlier than publish up.
		if ($this->publish_down > $this->_db->getNullDate() && $this->publish_down < $this->publish_up)
		{
			// Swap the dates.
			$temp = $this->publish_up;
			$this->publish_up = $this->publish_down;
			$this->publish_down = $temp;
		}

		return true;
	}

    /**
     * Method to set the publishing state for a row or list of rows in the database
     * table.  The method respects checked out rows by other users and will attempt
     * to checkin rows that it can after adjustments are made.
     *
     * @param   mixed    $pks     An optional array of primary key values to update.
     *                            If not set the instance property value is used.
     * @param   integer  $state   The publishing state. eg. [0 = unpublished, 1 = published]
     * @param   integer  $userId  The user id of the user performing the operation.
     *
     * @return  boolean  True on success; false if $pks is empty.
     *
     * @link    https://docs.joomla.org/JTable/publish
     * @since   11.1
     */
	public function featured($pks = null, $featured = 1)
	{

		$featured  = (int) $featured;

		if (!is_null($pks))
		{
			if (!is_array($pks))
			{
				$pks = array($pks);
			}

			foreach ($pks as $key => $pk)
			{
				if (!is_array($pk))
				{
					$pks[$key] = array($this->_tbl_key => $pk);
				}
			}
		}

		// If there are no primary keys set check to see if the instance key is set.
		if (empty($pks))
		{
			$pk = array();

			foreach ($this->_tbl_keys AS $key)
			{
				if ($this->$key)
				{
					$pk[$key] = $this->$key;
				}
				// We don't have a full primary key - return false
				else
				{
					$this->setError(JText::_('JLIB_DATABASE_ERROR_NO_ROWS_SELECTED'));

					return false;
				}
			}

			$pks = array($pk);
		}

		foreach ($pks as $pk)
		{
			// Update the publishing state for rows with the given primary keys.
			$query = $this->_db->getQuery(true)
				->update($this->_tbl)
				->set('featured = ' . (int) $featured);

			// Build the WHERE clause for the primary keys.
			$this->appendPrimaryKeys($query, $pk);

			$this->_db->setQuery($query);

			try
			{
				$this->_db->execute();
			}
			catch (RuntimeException $e)
			{
				$this->setError($e->getMessage());

				return false;
			}

		}

		$this->setError('');

		return true;
	}

}
?>