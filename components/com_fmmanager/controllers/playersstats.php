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
class FmmanagerControllerPlayersstats extends \FootManager\Controller\Ajax
{
    public function getData($data, $params) {
        return \FootManager\Helpers\Layout::render("stats.players", array("allowed_statistics" => $data->allowed_statistics, "statistics" => $data->stats, "podium_goals" => $data->podium_goals, "podium_assists" => $data->podium_assists, "params" => $params));
    }

}