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
 * Content article class.
 *
 * @since  1.6.0
 */
class FmmanagerControllerMatch extends JControllerLegacy
{

    public function displayContent() {
        $input = JFactory::getApplication()->input;
		$id = $input->get('id', 0, 'post');
        $params = (array)json_decode(base64_decode($input->get('params', "", 'BASE64')));
        $model_name = $input->get('model', '', 'post', true);
        $content = $input->get('content', '', 'post', true);
        $model = $this->getModel(ucfirst($model_name), 'FmmanagerModel');
        $method = "get".ucfirst($content);
        $data = $model->$method($id, $params);

        $method = "display".ucfirst($content);
        $result = $this->$method($data, $params);
        echo new JResponseJson($result, null, false, $input->get('ignoreMessages', true, 'bool'));
        exit;
    }

    public function displayCallUp($data, $params) {
        return FootManager\Helpers\Layout::render("event.callup", array("callup" => $data, "params" => $params));
    }

    public function displayResults($data, $params) {
        return FootManager\Helpers\Layout::render("html.list", array("items" => $data, "params" => $params, "layout" => "match.item", "component" =>FM_MANAGER_COMPONENT));
    }

    public function displayRanking($data, $params) {
        return FootManager\Helpers\Layout::render('stats.ranking', array("ranking" => $data->ranking, "legend" => $data->legend, "columns" => $data->columns, "params" => $params ));
    }

    public function displayStats($data, &$params) {
        return FootManager\Helpers\Layout::render('stats.teamsAndPlayers', array("team1" => $data->team1, "team2" => $data->team2, "teams_stats" => $data->teams_stats, "players_stats" => $data->players_stats, "params" => $params ));
    }

    public function displayFaceToFace($data, $params) {
        return FootManager\Helpers\Layout::render('stats.face_to_face', array("team1" => $data->team1, "team2" => $data->team2,"team1_last_matches" => $data->team1_last_matches, "team2_last_matches" => $data->team2_last_matches,"team1_next_events" => $data->team1_next_events, "team2_next_events" => $data->team2_next_events , "confrontations" => $data->confrontations, "params" => $params ));
    }

    public function displayTeams($data, $params) {
        return FootManager\Helpers\Layout::render('match.info.teams', array("team1" => $data->team1, "team2" => $data->team2,"tactic1" => $data->tactic1, "tactic2" => $data->tactic2,"players1" => $data->players1, "players2" => $data->players2 , "staff1" => $data->staff1 , "staff2" => $data->staff2, "params" => $params ));
    }

}