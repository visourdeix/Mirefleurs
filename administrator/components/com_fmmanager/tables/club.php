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
class FmmanagerTableClub extends \FootManager\Table\Table
{
    function __construct(&$db)
    {
        parent::__construct(FMManager\Database\Models\Club::class ,$db);

        $this->addNotEmptyFields("name", "small_name", "abbreviation");
        $this->addUniqueFields("name");

        // References
        $this->addReference("teams", FMManager\Database\Models\Team::class, function($item) { return !empty($item["category_id"]);});
    }

    /**
     * Method to load referenced data.
     * @return array
     */
    public function loadReference($property, $modelName, $foreignKey, $column = false, $id = null) {

        switch ($property)
        {
            case "teams" :
                return FMManager\Database\Models\Team::withoutGlobalScopes()->where("club_id", "=", $id)->orderByCategory()->get()->toArray();

        	default:
                return parent::loadReference($property, $modelName, $foreignKey, $column, $id);
        }

    }

    /**
     * Stores items related to this.
     * @param string $property
     * @param string $referenceModel
     */
    protected function storeReference($property, $modelName, $foreignKey, $column = false) {
        switch ($property)
        {
            case "teams" :
                return $this->storeComplexReferences($this->$property, "Team", "club_id", 'FmmanagerTable');

        	default:
                return parent::storeReference($property, $modelName, $foreignKey, $column);
        }
    }

    /**
     * Method to delete referenced data of an item.
     *
     * @param     mixed      $pk    An primary key value to delete.
     *
     * @return    boolean
     */
    public function deleteReferences($id = null)
    {
        if($this->getId($id) == \FMManager\Helper::getMyClubId()) {
            $this->setError(JText::_('COM_FMMANAGER_ERROR_CANNOT_DELETE_MY_CLUB'));
            return false;
        }

        return parent::deleteReferences($id);
    }

    /**
     * Method to load referenced data.
     * @return boolean
     */
    protected function deleteReference($property, $modelName, $foreignKey, $id = null) {
        switch ($property)
        {
            case "teams" :
                return $this->deleteComplexReferences("Team", "club_id", 'FmmanagerTable', $id);

        	default:
                return parent::deleteReference($property, $modelName, $foreignKey, $id);
        }
    }
}
?>