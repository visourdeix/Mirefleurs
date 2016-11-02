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
class FmmanagerControllerTeamstats extends \FootManager\Controller\Ajax
{
    public function getData($data, $params) {
        return \FootManager\Helpers\Layout::render("stats.team", array("statistics" => $data->stats, "serie" => $data->serie, "team" => $data->team, "params" => $params));
    }
}