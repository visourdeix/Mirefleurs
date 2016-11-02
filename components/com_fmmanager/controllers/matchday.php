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
class FmmanagerControllerMatchday extends JControllerLegacy
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

    public function displayMatches($data, $params) {
        return FootManager\Helpers\Layout::render("html.thumbnails", array("items" => $data, "layout" => "match.thumbnail", "params" => $params, "component" => FM_MANAGER_COMPONENT));
    }

    public function displayStats($data, &$params) {
        return FootManager\Helpers\Layout::render("stats.players", array("allowed_statistics" => $data->allowed_statistics, "statistics" => $data->stats, "params" => $params));
    }

}