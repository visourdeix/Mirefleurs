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
 * Positions Table.
 *
 */
class FmmanagerTablePerson extends \FootManager\Table\Table
{

    /**
     * Object constructor to set table and key fields.  In most cases this will
     * be overridden by child classes to explicitly set the table and key fields
     * for a particular database table.
     *
     * @param   string           $table  Name of the table to model.
     * @param   mixed            $key    Name of the primary key field in the table or array of field names that compose the primary key.
     * @param   \JDatabaseDriver  $db     JDatabaseDriver object.
     *
     * @since   11.1
     */
    function __construct(&$db)
    {
        parent::__construct(FMManager\Database\Models\Person::class, $db);

        // Empty Fields
        $this->addNotEmptyFields("first_name", "last_name");

        // References
        $this->addReference("contacts", FMManager\Database\Models\Contact::class, function($item) { return !is_null($item["type"]) && !empty($item["value"]);});
        $this->addColumnReference("diplomas", FMManager\Database\Models\PersonDiplomas::class);

        // References In
        $this->addReferenceIn(FMManager\Database\Models\MatchPlayers::class);
        $this->addReferenceIn(FMManager\Database\Models\MatchPlayerStatistics::class);
        $this->addReferenceIn(FMManager\Database\Models\MatchStaff::class);
        $this->addReferenceIn(FMManager\Database\Models\MatchStaffStatistics::class);
        $this->addReferenceIn(FMManager\Database\Models\RosterPlayers::class);
        $this->addReferenceIn(FMManager\Database\Models\RosterStaff::class);
        $this->addReferenceIn(FMManager\Database\Models\MatchSubstitutions::class, "playerIn_id");
        $this->addReferenceIn(FMManager\Database\Models\MatchSubstitutions::class, "playerOut_id");
        $this->addReferenceIn(FMManager\Database\Models\MatchdayPlayerStatistics::class);
        $this->addReferenceIn(FMManager\Database\Models\MatchGoals::class, "striker_id");
        $this->addReferenceIn(FMManager\Database\Models\MatchGoals::class, "passer_id");
        $this->addReferenceIn(FMManager\Database\Models\CallupPersons::class);
        $this->addReferenceIn(FMManager\Database\Models\CallupContacts::class);

    }

    /**
     * Method to load referenced data.
     * @return array
     */
    public function loadReference($property, $modelName, $foreignKey, $column = false, $id = null) {

        switch ($property)
        {
            case "contacts" :
                return FMManager\Database\Models\Contact::withoutGlobalScopes()->where("person_id", "=", $id)->orderBy("type")->orderBy("default", "DESC")->get()->toArray();

        	default:
                return parent::loadReference($property, $modelName, $foreignKey, $column, $id);
        }

    }

    /**
     * Method to store a row in the database from the JTable instance properties.
     * If a primary key value is set the row with that primary key value will be
     * updated with the instance property values.  If no primary key value is set
     * a new row will be inserted into the database with the properties from the
     * JTable instance.
     *
     * @param   boolean  $updateNulls  True to update fields even if they are null.
     *
     * @return  boolean  True on success.
     *
     * @link    http://docs.joomla.org/JTable/store
     * @since   11.1
     */
	public function store($updateNulls = false)
	{
        $this->last_name = utf8_strtoupper($this->last_name);

        return parent::store($updateNulls);
	}

}
?>