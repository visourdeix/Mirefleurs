<?php
/**
 * @package      FootManager
 * @subpackage   Initialization
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

defined('JPATH_PLATFORM') or die;

// Make sure the cms libraries are loaded
if (!defined('JPATH_PLATFORM')) {
    require_once dirname(__FILE__) . '/../cms.php';
}

if (!defined('FM_GALLERY_FRAMEWORK')) {
    define('FM_GALLERY_FRAMEWORK', 1);
}
else {
    // Make sure we run the code below only once
    return;
}

// Include the library
jimport("FootManager.framework");
jimport("FMGallery.library");

// Include Framework
$file = (JFactory::getApplication()->isAdmin()) ? "backend" : "frontend";
FootManager\UI\Loader::addStyle(FM_GALLERY_COMPONENT.'/'.$file.'.min.css');