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

if (!defined('FM_LIBRARY')) {
    define('FM_LIBRARY', 1);
}
else {
    // Make sure we run the code below only once
    return;
}

// Paths
define('FM', 'FootManager');
define('FM_PATH_LIBRARY', JPATH_LIBRARIES . '/'.FM);
define('FM_NAMESPACE', 'FootManager');
define('FM_NAMESPACE_MODELS', FM_NAMESPACE.'\Database\Models\\');

// Import
jimport('joomla.application.component.view');
jimport('joomla.application.component.model');
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');
jimport('joomla.client.helper');

// Load Namespace
JLoader::registerNamespace(FM_NAMESPACE, JPATH_LIBRARIES);

// Add Logger
FootManager\Helpers\Log::initialise(FM);

// Load libraries
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/Database/Configuration.php';

// Include language
JFactory::getLanguage()->load('lib_'.FM, JPATH_SITE);
JFactory::getLanguage()->load('com_content');

// Log SQL Queries

// Mobile
jimport("joomla.environment.browser");
$browser = JBrowser::getInstance();

$isMobile = $browser->isMobile();
// Joomla isMobile method doesn't identify all android phones
if (!$isMobile && isset($_SERVER['HTTP_USER_AGENT']))
{
	if (stripos($_SERVER['HTTP_USER_AGENT'], 'android') > 0 || stripos($_SERVER['HTTP_USER_AGENT'], 'blackberry') > 0)
	{
		$isMobile = true;
	}
	else if (stripos($_SERVER['HTTP_USER_AGENT'], 'iphone') > 0 || stripos($_SERVER['HTTP_USER_AGENT'], 'ipod') > 0)
	{
		$isMobile = true;
	}
}
define("IS_MOBILE", $isMobile);