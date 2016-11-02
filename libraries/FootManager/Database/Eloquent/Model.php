<?php
/**
 * @package      FMEvents
 * @subpackage   Calendar
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FootManager\Database\Eloquent;

defined('JPATH_PLATFORM') or die;

/**
 * This class contains common methods and properties for a database item
 *
 * @package      FMEvents
 * @subpackage   Calendar
 */
abstract class Model extends \Illuminate\Database\Eloquent\Model {

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $rememberFor = 30;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get a new query builder instance for the connection.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    protected function newBaseQueryBuilder()
    {
        $conn = $this->getConnection();

        $grammar = $conn->getQueryGrammar();

        $builder = new Query\Builder($conn, $grammar, $conn->getPostProcessor());

        if (isset($this->rememberFor) && \JFactory::getApplication()->isSite() && !\JDEBUG) {
            $builder->remember($this->rememberFor);
        }

        return $builder;
    }

    /**
     * Create a new Eloquent query builder for the model.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @return \FootManager\Database\Eloquent\Builder|static
     */
    public function newEloquentBuilder($query)
    {
        return new Builder($query);
    }

    /**
     * Create a new Eloquent Collection instance.
     *
     * @param  array  $models
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function newCollection(array $models = [])
    {
        return new Collection($models);
    }

}

?>