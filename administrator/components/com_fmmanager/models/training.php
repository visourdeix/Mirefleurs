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
class FmmanagerModelTraining extends FMManager\Model\Backend\Event
{

    /**
     * Allowed batch commands
     *
     * @var array
     */
	protected $batch_commands = array(
		'stadium' => 'batchStadium',
        'roster' => 'batchRoster'
	);

    /**
     * Batch change a linked category.
     *
     * @param   integer  $value     The new value matching a Category ID.
     * @param   array    $pks       An array of row IDs.
     * @param   array    $contexts  An array of item contexts.
     *
     * @return  boolean  True if successful, false otherwise and internal error is set.
     *
     * @since   2.5
     */
    protected function batchStadium($value, $pks, $contexts)
    {
        if($value != -1) {
            foreach ($pks as $pk)
            {
                if ($this->user->authorise('trainings.edit', $contexts[$pk]))
                {
                    $this->table->reset();
                    $this->table->load($pk);
                    $this->table->stadium_id = (int) $value;

                    if (!$this->table->store())
                    {
                        $this->setError($this->table->getError());

                        return false;
                    }
                }
                else
                {
                    $this->setError(JText::_('JLIB_APPLICATION_ERROR_BATCH_CANNOT_EDIT'));

                    return false;
                }
            }
        }

        // Clean the cache
        $this->cleanCache();

        return true;
    }

    /**
     * Batch change a linked category.
     *
     * @param   integer  $value     The new value matching a Category ID.
     * @param   array    $pks       An array of row IDs.
     * @param   array    $contexts  An array of item contexts.
     *
     * @return  boolean  True if successful, false otherwise and internal error is set.
     *
     * @since   2.5
     */
    protected function batchRoster($value, $pks, $contexts)
    {
        if($value != -1) {
            foreach ($pks as $pk)
            {
                if ($this->user->authorise('trainings.edit', $contexts[$pk]))
                {
                    $this->table->reset();
                    $this->table->load($pk);
                    $new_rosters = (array)$this->table->rosters;
                    array_push($new_rosters, $value);

                    $this->table->rosters = array_unique($new_rosters);

                    if (!$this->table->store())
                    {
                        $this->setError($this->table->getError());

                        return false;
                    }
                }
                else
                {
                    $this->setError(JText::_('JLIB_APPLICATION_ERROR_BATCH_CANNOT_EDIT'));

                    return false;
                }
            }
        }

        // Clean the cache
        $this->cleanCache();

        return true;
    }

    /**
     * Method to add several matchdays.
     *
     * @param   array    $pks    The ids of the items to toggle.
     * @param   integer  $value  The value to toggle to.
     *
     * @return  boolean  True on success.
     */
	public function addmultiple($data)
	{
        $inserted = 0;
        $row = 0;
        $errors = array();
        $start_date = isset($data["start_date"]) ? $data["start_date"] : "";
        $end_date = isset($data["end_date"]) ? $data["end_date"] : "";
        $start_time = isset($data["start_time"]) ? $data["start_time"] : "";
        $end_time = isset($data["end_time"]) ? $data["end_time"] : "";
        $days = isset($data["days"]) ? $data["days"] : array();
        $rosters = isset($data["rosters"]) ? $data["rosters"] : array();
        $stadium_id = isset($data["stadium_id"]) ? $data["stadium_id"] : 0;

        if($start_date && $end_date && $start_time && $end_time && $days && $rosters && $stadium_id) {

            for ($i = strtotime($start_date); $i <= strtotime($end_date); $i = strtotime('+1 day', $i)) {

                if (in_array(date('N', $i), $days)) {

                    $row += 1;

                    $table = $this->getTable();
                    $table->reset();

                    $table->date = date('Y-m-d', $i);
                    $table->start_time = $start_time;
                    $table->end_time = $end_time;
                    $table->stadium_id = $stadium_id;
                    $table->rosters = $rosters;

                    if (!$table->check())
                    {
                        continue;
                    }

                    if (!$table->store())
                    {
                        continue;
                    }
                    $inserted += 1;

                }
            }
        }

		$this->cleanCache();

		return $inserted;
	}

}