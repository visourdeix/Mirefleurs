<?php
/**
 * @package     Fmmanager
 * @subpackage  Positions
 *
 * @copyright   Copyright (C) 2015 STéphane ANDRE. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

jimport('joomla.database.table');

/**
 * Positions Table.
 *
 */
class FmmanagerTableCallup extends \FootManager\Table\Table
{

    function __construct(&$db)
    {
        parent::__construct(FMManager\Database\Models\Callup::class, $db);

        // Empty Fields
        $this->addNotEmptyFields("date", "time");

        // References
        $this->addColumnReference("persons", FMManager\Database\Models\CallupPersons::class);
        $this->addColumnReference("contacts", FMManager\Database\Models\CallupContacts::class);
    }

    /**
     * Overloaded check function
     *
     * @return  boolean  True on success, false on failure
     *
     * @see JTable::check
     * @since 1.5
     */
	public function check()
	{

        /** check for valid name */
		if ($this->stadium_id == 0 && trim($this->venue) == '')
		{
			$this->setError(JText::_('COM_FMMANAGER_ERROR_EMPTY_LOCATION'));

			return false;
		}

		return parent::check();
	}
}
?>