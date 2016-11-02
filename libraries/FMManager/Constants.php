<?php
/**
 * @package      FootManager
 * @subpackage   Constants
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FMManager;

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
    const NOT_PLAYED          = 0;
    const PLAYED          = 1;
    const REPORTED          = 2;
    const CANCELLED          = 3;
    const STOPPED          = 4;

    const VICTORY          = 1;
    const VICTORY_TO_PENALTIES        = 2;
    const DRAW            = 3;
    const DEFEAT            = 4;
    const DEFEAT_TO_PENALTIES            = 5;

    const NOT_IN_MATCH          = 0;
    const IN_MATCH        = 1;
    const FIRST_TEAM_PLAYER            = 2;
    const SUBSTITUTE            = 3;

    const GENERAL            = "general";
    const HOME            = "home";
    const AWAY            = "away";
    const NEUTRAL            = "neutral";

    const AVG            = "avg";
    const SUM            = "sum";
}