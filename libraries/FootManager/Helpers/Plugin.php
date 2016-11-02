<?php
/**
 * @package      FootManager
 * @subpackage   Helpers
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FootManager\Helpers;

defined('JPATH_PLATFORM') or die;
/**
 * This class contains common methods and properties for a database item
 *
 * @package      FootManager
 * @subpackage   Helpers
 */
abstract class Plugin
{
	/**
     * A default base path that will be used if none is provided when calling the render method.
     * Note that JLayoutFile itself will defaults to JPATH_ROOT . '/layouts' if no basePath is supplied at all
     *
     * @var    string
     * @since  3.1
     */
	public static $defaultBasePath = '';

	/**
     * Trigger an event of plugin.
     * @param string $group
     * @param string $event
     * @param array $args
     * @return mixed
     */
	public static function trigger($group, $event, $args = array(), $plugin = null) {
        \JPluginHelper::importPlugin($group, $plugin);
        $dispatcher  = \JEventDispatcher::getInstance();
        $results = $dispatcher->trigger($event, $args);
        return $results;
    }

    /**
     * Method to set the publishing state of a plugin
     *
     * @param     string     $name     The name of the plugin
     * @param     integer    $state    The new state of the plugin
     *
     * @return    boolean              True on success, False on error
     */
    public static function publish($name, $state = 1)
    {
        $db    = \JFactory::getDbo();
        $query = $db->getQuery(true);

        // Get the plugin id
        $query->select('extension_id')
              ->from('#__extensions')
              ->where('name = ' . $db->quote($name))
              ->where('type = ' . $db->quote('plugin'));

        $db->setQuery((string) $query);
        $id = (int) $db->loadResult();

        if (!$id) return false;

        // Update params
        $query->clear();
        $query->update('#__extensions')
              ->set('enabled = ' . $db->quote($state))
              ->where('extension_id = ' . $db->quote($id));

        $db->setQuery((string) $query);
        $db->execute();

        return true;
    }
}