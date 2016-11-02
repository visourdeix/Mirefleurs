<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
/**
 * Content Component Article Model
 *
 * @since  1.5
 */
class FmmanagerModelStaff extends \FMManager\Model\Frontend\Season
{

    public function getData($id, &$params = array()) {

        // Params
        $group = JArrayHelper::getValue($params, "staff_group_by", "");
        $show_function = JArrayHelper::getValue($params, "staff_show_function", true);
        $show_diploma = JArrayHelper::getValue($params, "staff_show_diploma", true);
        $show_contacts = JArrayHelper::getValue($params, "staff_show_contacts", true);

        // Gets the roster persons.
        $roster_persons = \FMManager\Database\Models\RosterStaff::with(["roster", "person"])
                            ->where("fm_rosters.season_id", $id)
                            ->orderByTeam()
                            ->orderByFunction();

        if($show_function) $roster_persons->with("_function");
        if($show_diploma) $roster_persons->with("person.diplomas");
        if($show_contacts) $roster_persons->with("person.contacts");

        $roster_persons = $roster_persons->get();

        // Group the persons.
        switch ($group)
        {
            case "categories":
                $roster_persons = $roster_persons->groupBy(function($obj) {
                    return $obj->roster->category->label;
                });
                break;

            default:
                $roster_persons = $roster_persons->groupBy(function($obj) {
                    return $obj->roster->small_name;
                });

        }

        // Get the persons
        $persons = array();
        foreach ($roster_persons as $key => $items)
        {
            $persons[$key] = $items->map(function ($obj) use($show_function) {

                // Define the function.
               if($show_function)  $obj->person->_function = $obj->_function;
                return $obj->person;
            });
        }

        return $persons;

    }
}