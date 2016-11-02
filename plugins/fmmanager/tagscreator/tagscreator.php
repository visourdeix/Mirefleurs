<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Content.Contact
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

jimport("FootManager.library");

/**
 * Contact Plugin
 *
 * @since  3.2
 */
class PlgFmmanagerTagscreator extends \FootManager\Plugin\Tagscreator
{

    protected function getTitle($context, $table, $isNew) {

        if(!FootManager\Helpers\Application::enabled("com_fmmanager")) return "";

        jimport("FMManager.library");

        $title = "";
        switch ($context)
        {
        	case FM_MANAGER_COMPONENT.".person":

                if($this->params->get('person', true))
                    $title = $table->first_name." ".$table->last_name;
                break;

            case FM_MANAGER_COMPONENT.".stadium":

                if($this->params->get('stadium', true)) {
                    $stadium = FMManager\Database\Models\Stadium::find($table->id);
                    $title = $stadium->name_and_city;
                }
                break;

            case FM_MANAGER_COMPONENT.".match":

                if($this->params->get('match', true)) {
                    $match = FMManager\Database\Models\Match::find($table->id);

                    if($match->matchday->competition->tournament->type->by_match && $match->isMyEvent())
                        $title = $match->matchday->competition->name." - ".$match->matchday->name." - ".$match->team1->small_name." vs ".$match->team2->small_name;
                }
                break;

            case FM_MANAGER_COMPONENT.".matchday":

                if($this->params->get('matchday', true)) {
                    $matchday = FMManager\Database\Models\Matchday::find($table->id);
                    if(!$matchday->competition->tournament->type->by_match)
                        $title = $matchday->competition->name.' - '.$matchday->name;
                }
                break;

        }

        return $title;
    }

}