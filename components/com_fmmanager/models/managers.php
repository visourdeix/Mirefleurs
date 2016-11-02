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
class FmmanagerModelManagers extends \FMManager\Model\Frontend\Season
{

    public function getData($id, &$params = array()) {

        $item = new stdClass();

        // Params
        $group = JArrayHelper::getValue($params, "managers_group_by", "");
        $show_function = JArrayHelper::getValue($params, "managers_show_function", true);
        $show_managers = JArrayHelper::getValue($params, "managers_show_managers", true);
        $show_contacts = JArrayHelper::getValue($params, "managers_show_contacts", true);

        // Gets the managers
        $season_managers = \FMManager\Database\Models\SeasonManagers::with(["person"])->where("season_id", $id);

        $null_group = "";
        switch ($group)
        {
        	case "functions":
                $season_managers = $season_managers->orderByFunction();
                $null_group = JText::_("FM_MANAGERS");
                break;

            case "genders":
                $season_managers = $season_managers->orderBy("fm_persons.gender");
                $null_group = JText::_("FMLIB_NONE_1");
                break;
        }

        if(!$show_managers) $season_managers = $season_managers->where("function_id", "<>", 0);
        $season_managers = $season_managers->orderByName()->get();
        if($show_function || $group == "functions") $season_managers->load("_function");
        if($show_contacts) $season_managers->load("person.contacts");

        // Group the persons.
        switch ($group)
        {
            case "functions":
                $season_managers = $season_managers->groupBy(function($obj) use($null_group) {
                    return (isset($obj->_function)) ? $obj->_function->label : $null_group;
                });
                break;

            case "genders":
                $season_managers = $season_managers->groupBy(function($obj) use($null_group) {
                    return $obj->person->gender ? JText::_("FMLIB_GENDER_".$obj->person->gender) : $null_group;
                });
                break;

        }

        // Get the persons
        $persons = new Illuminate\Support\Collection();
        if($group) {
            foreach ($season_managers as $key => $items)
            {
                $persons[$key] = $items->map(function ($obj) use($show_function) {

                    // Define the function.
                   if($show_function)  $obj->person->_function = $obj->_function;
                    return $obj->person;
                })->unique("id");
            }
            if($persons->has($null_group)) {
                $null_persons = $persons->get($null_group, new Illuminate\Database\Eloquent\Collection());
                $other_persons = $persons->except($null_group);
                $persons = $other_persons->put($null_group, $null_persons);
            }

        } else {
            $persons = $season_managers->map(function ($obj) use($show_function) {

                       // Define the function.
                      if($show_function)  $obj->person->_function = $obj->_function;
                       return $obj->person;
                   })->unique("id");
        }

        $item->persons = $persons;
        $item->layout = ($group) ? "html.thumbnails.grouped" : "html.thumbnails";

        return $item;
    }
}