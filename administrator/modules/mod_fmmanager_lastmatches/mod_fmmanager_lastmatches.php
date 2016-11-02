<?php
/**
 * @package     mod_fmmanager_lastmatches
 * @subpackage  mod_#modulename#.php
 *
 * @copyright   Copyright (C) 2016 Stéphane ANDRE. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
// Include dependencies
jimport('FMManager.framework');

if(in_array("allowed", $params->get("categories", array()))) {
    require_once(JPATH_ROOT.DS.'administrator/modules/mod_fmmanager_lastmatches/helper.php');
    $allowed_categories = ModFmmanagerLastmatchesHelper::getAllowedCategories();
    $params->set("categories", $allowed_categories);
}

$params->set("ajax_loading", true);
$params->set("return_page", base64_encode(JUri::getInstance()));
$objects["filterForm"] = FootManager\Helpers\Module::getForm("mod_fmmanager_lastmatches", "com_fmmanager", $params);

\FootManager\UI\Loader::addScript('com_fmmanager/backend/mod_events.min.js');
FootManager\Helpers\Module::initialize('mod_fmmanager_lastmatches', $params, false, $objects);