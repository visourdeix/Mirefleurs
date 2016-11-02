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
class FmmanagerModelStadium extends FootManager\Model\Admin
{

    /**
     * Allowed batch commands
     *
     * @var array
     */
	protected $batch_commands = array(
		'ground' => 'batchGround'
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
    protected function batchGround($value, $pks, $contexts)
    {
        if($value != -1) {
            foreach ($pks as $pk)
            {
                if ($this->user->authorise('stadiums.edit', $contexts[$pk]))
                {
                    $this->table->reset();
                    $this->table->load($pk);
                    $this->table->ground_id = (int) $value;

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

}