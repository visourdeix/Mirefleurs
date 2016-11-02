<?php
/**
 * @package      FMEvents
 * @subpackage   Calendar
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FootManager\Database\Eloquent\Query;

defined('JPATH_PLATFORM') or die;

/**
 * This class contains common methods and properties for a database item
 *
 * @package      FMEvents
 * @subpackage   Calendar
 */
class Builder extends \Watson\Rememberable\Query\Builder {

    private static $_cached  = [];

    /**
     * Execute the query as a "select" statement.
     *
     * @param  array  $columns
     * @return array|static[]
     */
    public function get($columns = ['*'])
    {
        $original = $this->columns;

        if (is_null($original)) {
            $this->columns = $columns;
        }

        $hash = md5($this->toSql().json_encode($this->getBindings()));

        $this->columns = $original;

        if(!isset(self::$_cached[$hash])) {
            self::$_cached[$hash] = parent::get($columns);
        }

        return self::$_cached[$hash];
    }

}

?>