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

$ajax_loading = $params->get("ajax_loading", false);

FootManager\Helpers\Module::initialize('mod_fmmanager_ranking', $params, $ajax_loading);