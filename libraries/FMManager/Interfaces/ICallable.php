<?php
/**
 * @package      FootManager
 * @subpackage   Calendar
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FMManager\Interfaces;

defined('JPATH_PLATFORM') or die;
/**
 * This class contains common methods and properties for a database item
 *
 * @package      FootManager
 * @subpackage   Calendar
 */
interface ICallable {

    /**
     * Get all callable persons.
     */
    function type();

    /**
     * Get all callable persons.
     */
    function category();

    /**
     * Get default date.
     */
    function defaultDate();

    /**
     * Get default start time.
     */
    function defaultStartTime();

    /**
     * Get default end time.
     */
    function defaultEndTime();

    /**
     * Get default stadium.
     */
    function defaultStadium();

    /**
     * Get default contacts.
     */
    function defaultContacts();

    /**
     * Get all contacts.
     */
    function allContacts();

    /**
     * Get all callable persons.
     */
    function allPersons();

}