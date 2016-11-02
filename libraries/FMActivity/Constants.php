<?php
/**
 * @package      FootManager
 * @subpackage   Constants
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FMActivity;

defined('JPATH_PLATFORM') or die;

/**
 * FootManager constants
 *
 * @package      FootManager
 * @subpackage   Constants
 */
class Constants
{
    // States
    const SAVE_NEW          = "new";
    const SAVE_UPDATE          = "update";
    const PUBLISH          = "publish";
    const UNPUBLISH          = "unpublish";
    const ARCHIVE          = "archive";
    const TRASH          = "trash";
    const DELETE          = "delete";

}