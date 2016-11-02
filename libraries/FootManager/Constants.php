<?php
/**
 * @package      FootManager
 * @subpackage   Constants
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FootManager;

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
    const PUBLISHED          = 1;
    const UNPUBLISHED        = 0;
    const TRASHED            = -2;

    const FEATURED = 1;
    const NOT_FEATURED = 0;

    const ENABLED = 1;
    const DISABLED = 0;

    const INACTIVE = 0;
    const ACTIVE = 1;

    const TO_BE_COME = 0;
    const DONE = 1;
    const REPORTED = 2;
    const CANCELLED = 3;
    const STOPPED = 4;

    // Gender
    const MALE = 1;
    const FEMALE = 2;

    // Contacts
    const MOBILE = 1;
    const FIXE = 2;
    const MAIL = 3;
    const FAX = 4;

    // Categories
    const CATEGORY_ROOT = 1;

}