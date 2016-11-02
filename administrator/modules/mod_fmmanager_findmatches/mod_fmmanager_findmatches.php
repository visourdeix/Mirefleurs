<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  mod_latest
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include dependencies
jimport('FMManager.framework');

$params->set("ajax_loading", true);
$params->set("isEditable", true);
$params->set("return_page", base64_encode(JUri::getInstance()));
$objects["filterForm"] = FootManager\Helpers\Module::getForm("mod_fmmanager_findmatches", "com_fmmanager", $params);

\FootManager\UI\Loader::addScript('com_fmmanager/backend/mod_events.min.js');
FootManager\Helpers\Module::initialize('mod_fmmanager_findmatches', $params, false, $objects);