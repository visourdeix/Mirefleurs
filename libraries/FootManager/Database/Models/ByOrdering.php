<?php
/**
 * @package      FMEvents
 * @subpackage   Calendar
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FootManager\Database\Models;

defined('JPATH_PLATFORM') or die;

/**
 * This class contains common methods and properties for a database item
 *
 * @package      FMEvents
 * @subpackage   Calendar
 */
abstract class ByOrdering extends \FootManager\Database\Eloquent\Model {

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new \FootManager\Database\Scopes\OrderByOrdering());
    }

}

?>