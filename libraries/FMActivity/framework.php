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

if (!defined('FM_ACTIVITY_FRAMEWORK')) {
    define('FM_ACTIVITY_FRAMEWORK', 1);
}
else {
    // Make sure we run the code below only once
    return;
}

// Include the library
jimport("FMActivity.library");

// Include the global framework
jimport("FootManager.framework");