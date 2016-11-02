<?php
/**
 * @package      FootManager
 * @subpackage   Database
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

defined('JPATH_PLATFORM') or die;

use Illuminate\Database\Capsule\Manager as Capsule;
use \Illuminate\Cache\CacheManager;
use \Illuminate\Filesystem\Filesystem;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use \Illuminate\Support\Facades\Facade;

/**
 * Configure the database and boot Eloquent
 */
$capsule = new Capsule;

// Define the container

/**
 * @var Illuminate\Container\Container
 */
$container = $capsule->getContainer();

// Add connection
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => JFactory::getApplication()->getCfg("host"),
    'database'  => JFactory::getApplication()->getCfg("db"),
    'username'  => JFactory::getApplication()->getCfg("user"),
    'password'  => JFactory::getApplication()->getCfg("password"),
    'charset'   => 'utf8',
    'collation' => 'utf8_general_ci',
    'prefix'    => JFactory::getApplication()->getCfg("dbprefix")
]);

$container["config"]['path.storage'] = JPATH_CACHE.'/Database';
$container["config"]['cache.default'] = 'file';
$container["config"]['cache.stores.file'] = [
            'driver' => 'file',
            'path' => JPATH_CACHE.'/Database' // bind singleton for path.storage!
        ];

$cache = new \Illuminate\Cache\CacheManager($container);

$container->singleton('cache', function () use ($cache) {
		return $cache;
	});

$container->singleton('files', function () {
		return new Filesystem();
	});

// Set $app as FacadeApplication handler
Facade::setFacadeApplication($container);

// Set the event dispatcher used by Eloquent models... (optional)
$capsule->setEventDispatcher(new Dispatcher(new Container));

$capsule->setAsGlobal();
$capsule->bootEloquent();

if(JDEBUG) {
    Capsule::enableQueryLog();

    // Add Logger
    FootManager\Helpers\Log::initialise("Eloquent", \JLog::INFO, "databasequery");

    \Illuminate\Database\Capsule\Manager::listen(function($query) {

        $sql = $query->sql;
        $bindings = isset($query->bindings) ? $query->bindings : array() ;
        foreach( $bindings as $binding ) :
                $sql = preg_replace("#\?#", $binding, $sql, 1);
            endforeach;
    \FootManager\Helpers\Log::add($query->time." : ".$sql, \JLog::INFO, 'databasequery');
});

} else
    Capsule::disableQueryLog();
?>