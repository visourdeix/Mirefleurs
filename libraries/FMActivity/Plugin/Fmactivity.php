<?php
/**
 * @package      pkg_useractivity
 * @subpackage   plg_content_useractivity
 *
 * @author       Tobias Kuhn (eaxs)
 * @copyright    Copyright (C) 2013 Tobias Kuhn. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 */

namespace FMActivity\Plugin;

defined('_JEXEC') or die();

use Joomla\Registry\Registry;

/**
 * User Activity Plugin.
 *
 */
class Fmactivity extends \JPlugin
{
    /**
     * The activity data to save in an assoc array
     *
     * @var    \stdClass
     */
    protected $activity_data;

    /**
     * The activity item data to save in an assoc array
     *
     * @var    \stdClass
     */
    protected $item_data;

    /**
     * The activity item data to save in an assoc array
     *
     * @var    \stdClass
     */
    protected $pluginClass;

    protected $unfeaturePreviousItem;

    /**
     * Constructor
     *
     * @param    object    $subject    The object to observe
     * @param    array     $config     An optional associative array of configuration settings.
     */
    public function __construct(&$subject, $config = array())
    {
        parent::__construct($subject, $config);

        $this->unfeaturePreviousItem = true;

        // Prepare activity data
        $this->activity_data = new \stdClass();
        $this->item_data     = new \stdClass();

        $this->loadLanguage();

    }

    /**
     * Method to store user activity after a save event
     *
     * @param     string     $context    The item context
     * @param     object     $table      The item table object
     * @param     boolean    $is_new     New item indicator (True is new, False is update)
     * @param     boolean    $store      Indicates whether to store the data or not
     *
     * @return    \stdClass                True on success, False on error
     */
    public function onGetActivity($context, $table, $eventType)
    {

        // Check if the context is supported
        if (!$this->isSupported($context)) return null;

        $this->pluginClass = $this->getPluginClass($context);

        // Save plugin
        $this->item_data->plugin = $this->_type.".".$this->_name;

        // Set Data by pecific plugin
        $this->activity_data->event = $this->getEvent($table, $eventType);

        // Featured
        $this->activity_data->featured = $this->getFeatured($context, $table, $this->activity_data->event);

        if($this->unfeaturePreviousItem && $table->id) {
            $query = \JFactory::getDbo()->getQuery(true)->update("#__fmactivity_activities a")->set("featured = 0")->where("a.event_id = ".\FMActivity\Helper::getEventId($this->activity_data->event))->where("a.item_id IN (select i.id from #__fmactivity_items i where i.item_id = ".$table->id.")");
            \JFactory::getDbo()->setQuery($query)->execute();
        }

        // Set Data
        $this->setDataFromTable($context, $table, $this->activity_data->event);

        // Set Activity by pecific plugin
        $this->setActivityFromPlugin($table, $this->activity_data->event);

        // Set Data by pecific plugin
        $this->setDataFromPlugin($table, $this->activity_data->event);

        // Save Item
        $this->activity_data->item = $this->item_data;

        return $this->activity_data;
    }

    /**
     * Summary of isSupported
     * @param mixed $context
     * @return mixed
     */
    protected function isSupported($context) {
        return true;
    }

    /**
     * Summary of setDataFromTable
     * @param mixed $context
     * @param mixed $table
     * @param mixed $eventType
     */
    protected function setDataFromTable($context, $table, $eventType) {

        $pk = $table->getKeyName();

        $this->item_data->item_id = $table->$pk;
        $this->item_data->title = isset($table->title) ? $table->title : (isset($table->name) ? $table->name : (isset($table->label) ? $table->label : ""));
        $this->item_data->description = isset($table->description) ? $table->description : "";
        $this->item_data->category = isset($table->category) ? $table->category : "";
        $this->item_data->state = isset($table->state) ? $table->state : (isset($table->published) ? (int) $table->published : 1);
        $this->item_data->access = isset($table->access) ? $table->access : \JFactory::getConfig()->get('access');
        $this->item_data->metadata = new Registry();
    }

    protected function setDataFromPlugin($table, $eventType) {
        if(!empty($this->pluginClass) && method_exists($this->pluginClass, "setData")) {
            $class = $this->pluginClass;
            $class::setData($this->item_data, $table, $eventType);
        }
    }

    protected function setActivityFromPlugin($table, $eventType) {
        if(!empty($this->pluginClass) && method_exists($this->pluginClass, "setActivity")) {
            $class = $this->pluginClass;
            $class::setActivity($this->activity_data, $table, $eventType);
        }
    }

    protected function getEvent($table, $eventType) {
        if(!empty($this->pluginClass) && method_exists($this->pluginClass, "getEvent")) {
            $currentItem = \FMActivity\Database\Models\Item::where("item_id", "=", $table->id)->first();
            $class = $this->pluginClass;
            return $class::getEvent($currentItem, $table, $eventType);
        }

        return $eventType;
    }

    /**
     * Method to set some of the activity data from the item id and state
     *
     * @param     integer    $id       The item id
     * @param     integer    $state    The item state
     *
     * @return    boolean
     */
    protected function getFeatured($context, $table, $eventType)
    {

        // Set Featured by pecific plugin
        if(!empty($this->pluginClass) && method_exists($this->pluginClass, "isFeatured")) {
            $class = $this->pluginClass;
            return $class::isFeatured($table, $eventType);
        }

        return 0;
    }

    /**
     * Method to get the translation helper for the corresponding extension
     *
     * @param     string    $name    The name of the item
     *
     * @return    mixed                   Helper class instance on success, False on error
     */
    private function getPluginClass($context)
    {
        static $cache = array();

        list($extension, $name) = explode(".", $context);

        $file  = JPATH_PLUGINS.DS.$this->_type.DS.$this->_name.DS."plugins".DS.$name.".php";
        $class = "plg".ucfirst($this->_type).ucfirst($this->_name).ucfirst($name);

        // Check the cache
        if (isset($cache[$class])) {
            return $cache[$class];
        }

        if (is_null($file) || !file_exists($file)) return null;

        require_once $file;

        if (!class_exists($class)) return null;

        $cache[$class] = $class;

        return $cache[$class];
    }
}