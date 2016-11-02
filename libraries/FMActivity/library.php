<?php
/**
 * @package      FootManager
 * @subpackage   Initialization
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

defined('JPATH_PLATFORM') or die;

if(!defined('DS')) define('DS', DIRECTORY_SEPARATOR);

// Make sure the cms libraries are loaded
if (!defined('JPATH_PLATFORM')) {
    require_once dirname(__FILE__) . '/../cms.php';
}

if (!defined('FM_ACTIVITY_LIBRARY')) {
    define('FM_ACTIVITY_LIBRARY', 1);
}
else {
    // Make sure we run the code below only once
    return;
}

// Include dependencies
jimport('FootManager.library');

// Paths
define('FM_ACTIVITY', 'fmactivity');
define("FM_ACTIVITY_COMPONENT","com_".FM_ACTIVITY);
define('FM_ACTIVITY_PATH_ADMIN', JPATH_ADMINISTRATOR.'/components/'.FM_ACTIVITY_COMPONENT);
define('FM_ACTIVITY_PATH_SITE', JPATH_SITE.'/components/'.FM_ACTIVITY_COMPONENT);
define('FM_ACTIVITY_PATH_LIBRARY', JPATH_LIBRARIES . '/'.FM_ACTIVITY);
define('FM_ACTIVITY_NAMESPACE', 'FMActivity');

// Load Namespace
JLoader::registerNamespace(FM_ACTIVITY_NAMESPACE, JPATH_LIBRARIES);

// Include language
JFactory::getLanguage()->load(FM_ACTIVITY_COMPONENT, JPATH_ADMINISTRATOR);
if(!JFactory::getApplication()->isAdmin()) JFactory::getLanguage()->load(FM_ACTIVITY_COMPONENT);