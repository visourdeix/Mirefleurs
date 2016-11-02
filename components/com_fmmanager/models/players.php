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
class FmmanagerModelPlayers extends FMManager\Model\Frontend\Roster
{

    public function getData($id, &$params = array()) {

        $item = new stdClass();

        // Params
        $group = JArrayHelper::getValue($params, "players_group_by", "");
        $show_outclassed = JArrayHelper::getValue($params, "players_show_outclassed", false);
        $show_category = JArrayHelper::getValue($params, "players_show_category", true);
        $show_position = JArrayHelper::getValue($params, "players_show_position", true);
        $show_contacts = JArrayHelper::getValue($params, "players_show_contacts", true);

        // Gets the players
        $roster = \FMManager\Database\Models\Roster::find($id);
        $players = $roster->players();

        // Relation team
        if($roster->relation_team_id) {
            $relation_roster = \FMManager\Database\Models\Roster::where([["season_id", "=", $roster->season_id], ["team_id", "=", $roster->relation_team_id]])->first();
            if($relation_roster) {
                $relation_players = $relation_roster->players()->orderByName();
                $players = $players->union($relation_players);
            }
        }

        if(!$show_outclassed) $players = $players->where("outclassed", "=", 0);
        $players = $players->get();

        // Load attributes
        $players->load("person");
        if($show_position || $group == "positions") $players->load("position");
        if($show_category || $group == "categories") $players->load("category");
        if($show_contacts) $players->load("person.contacts");

        // Define attributes
        $players->each(function ($obj) use($roster, $show_position, $show_category) {
                   if($show_position)  $obj->person->position = $obj->position;
                   if($show_category)  $obj->person->category = $obj->category;
                   if($roster->id !== $obj->roster->id) $obj->person->team = $obj->roster->team;
                });

        // Group the persons.
        $null_group = "";
        switch ($group)
        {
            case "positions":
                $players = $players->sortMulti(["position.ordering", "person.inverse_name"]);
                $null_group = JText::_("FMLIB_NONE_2");
                $players = $players->groupBy(function($obj) use($null_group) {
                    return (isset($obj->position)) ? $obj->position->label : $null_group;
                });
                break;

            case "categories":
                $players = $players->sortMulti(["category.ordering", "person.inverse_name"]);
                $null_group = JText::_("FMLIB_NONE_2");
                $players = $players->groupBy(function($obj) use($null_group) {
                    return (isset($obj->category)) ? $obj->category->label : $null_group;
                });
                break;

        }

        // Get the persons
        $persons = new Illuminate\Support\Collection();
        if($group) {
            foreach ($players as $key => $items) $persons[$key] = $items->map(function ($obj) { return $obj->person;})->unique("id");
            $null_persons = $persons->pull($null_group);
            if($null_persons) $persons = $persons->put($null_group, $null_persons);

        } else {
            $persons = $players->map(function ($obj) { return $obj->person;})->unique("id");
        }

        $item->persons = $persons;
        $item->layout = ($group) ? "html.thumbnails.grouped" : "html.thumbnails";

        return $item;

    }

}