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
class FmmanagerTableSeason extends FMManager\Table\Data
{

    function __construct(&$db)
    {
        parent::__construct(FMManager\Database\Models\Season::class ,$db);

        $this->addReference("managers", FMManager\Database\Models\SeasonManagers::class, function($item) { return !empty($item["person_id"]);});

        $this->addReferenceIn(FMManager\Database\Models\Competition::class);
        $this->addReferenceIn(FMManager\Database\Models\Roster::class);

    }

    /**
     * Method to load referenced data.
     * @return array
     */
    public function loadReference($property, $modelName, $foreignKey, $column = false, $id = null) {

        switch ($property)
        {
            case "managers" :
                return FMManager\Database\Models\SeasonManagers::where("season_id", "=", $id)->orderByFunction()->orderByName()->get()->toArray();

        	default:
                return parent::loadReference($property, $modelName, $foreignKey, $column, $id);
        }

    }

}
?>