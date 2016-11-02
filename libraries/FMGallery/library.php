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

if (!defined('FM_GALLERY_LIBRARY')) {
    define('FM_GALLERY_LIBRARY', 1);
}
else {
    // Make sure we run the code below only once
    return;
}

// Include dependencies
jimport('FootManager.library');

// Paths
define('FM_GALLERY', 'fmgallery');
define("FM_GALLERY_COMPONENT","com_".FM_GALLERY);
define('FM_GALLERY_PATH_ADMIN', JPATH_ADMINISTRATOR.'/components/'.FM_GALLERY_COMPONENT);
define('FM_GALLERY_PATH_SITE', JPATH_SITE.'/components/'.FM_GALLERY_COMPONENT);
define('FM_GALLERY_PATH_LIBRARY', JPATH_LIBRARIES . '/'.FM_GALLERY);
define("FM_GALLERY_PATH_IMAGES_REL", 'images'.DS.FM_GALLERY);
define('FM_GALLERY_PATH_IMAGES', JPATH_ROOT . DS.FM_GALLERY_PATH_IMAGES_REL);
define('FM_GALLERY_NAMESPACE', 'FMGallery');

// Load Namespace
JLoader::registerNamespace(FM_GALLERY_NAMESPACE, JPATH_LIBRARIES);

// Include language
JFactory::getLanguage()->load(FM_GALLERY_COMPONENT, JPATH_ADMINISTRATOR);
if(!JFactory::getApplication()->isAdmin()) JFactory::getLanguage()->load(FM_GALLERY_COMPONENT);

// Require route site
require_once FM_GALLERY_PATH_SITE . '/helpers/route.php';