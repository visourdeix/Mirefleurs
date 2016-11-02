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
class FmmanagerControllerResults extends \FootManager\Controller\Ajax
{

    public function getData($data, $params) {
        if(isset($data->matches))
            return \FootManager\Helpers\Layout::render('html.list.grouped', array("items" => $data->matches, "layout" => "match.item", "params" => $params, "component" => FM_MANAGER_COMPONENT));
        if(isset($data->matchdays))
            return \FootManager\Helpers\Layout::render('html.list', array("items" => $data->matchdays, "layout" => "matchday.item", "params" => $params, "component" => FM_MANAGER_COMPONENT));
        return "";
    }

}