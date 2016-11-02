<?php
/**
 * @package      pkg_useractivity
 * @subpackage   plg_content_useractivity
 *
 * @author       Tobias Kuhn (eaxs)
 * @copyright    Copyright (C) 2013 Tobias Kuhn. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 */

defined('_JEXEC') or die();

use Joomla\Registry\Registry;

jimport("FMActivity.library");

if (!defined('FM_ACTIVITY_LIBRARY')) return;

// Register the component model and table
\JModelLegacy::addIncludePath(FM_ACTIVITY_PATH_ADMIN . '/models', 'FmactivityModel');

\JLoader::register('FmactivityTableItem', FM_ACTIVITY_PATH_ADMIN . '/tables/item.php');
\JLoader::register('FmactivityTableActivity',    FM_ACTIVITY_PATH_ADMIN . '/tables/activity.php');

// Include the user activity plugins
JPluginHelper::importPlugin('fmactivity');

/**
 * User Activity Content Plugin.
 *
 */
class plgContentFmactivity extends JPlugin
{
    /**
     * Event dispatcher instance
     *
     * @var    object
     */
    protected $dispatcher;

    /**
     * Instance of the component activity model
     *
     * @var    object
     */
    protected $activity_model;

    /**
     * Instance of the component activity item model
     *
     * @var    object
     */
    protected $item_model;

    /**
     * Constructor
     *
     * @param    object    $subject    The object to observe
     * @param    array     $config     An optional associative array of configuration settings.
     */
    public function __construct(&$subject, $config = array())
    {
        // Call parent contructor first
        parent::__construct($subject, $config);

        // Get the dispatcher
        $this->dispatcher = JDispatcher::getInstance();

        // Get the models
        $this->activity_model = \JModelLegacy::getInstance('Activity', 'FmActivityModel');
        $this->item_model     = \JModelLegacy::getInstance('Item', 'FmActivityModel');

    }

    /**
     * Triggers User Activity Plugins for the "onContentAfterSave" event
     *
     * @param     string     $context    The item context
     * @param     object     $table      The item table object
     * @param     boolean    $is_new     New item indicator (True is new, False is update)
     *
     * @return    boolean                True
     */
    public function onContentAfterSave($context, $table, $is_new)
    {
        return $this->saveActivities($context, $table, ($is_new) ? FMActivity\Constants::SAVE_NEW : FMActivity\Constants::SAVE_UPDATE);
    }

    /**
     * Triggers User Activity Plugins for the "onContentAfterDelete" event
     *
     * @param     string     $context    The item context
     * @param     object     $table      The item table object
     *
     * @return    boolean                True
     */
    public function onContentAfterDelete($context, $table)
    {
        return $this->saveActivities($context, $table, FMActivity\Constants::DELETE);
    }

    /**
     * Triggers User Activity Plugins for the "onContentAfterDelete" event
     *
     * @param     string     $context    The item context
     * @param     object     $table      The item table object
     *
     * @return    boolean                True
     */
    public function onContentChangeState($context, $pks, $value)
    {
        $eventType = FMActivity\Constants::PUBLISH;
        switch ($value)
        {
            case \FootManager\Constants::UNPUBLISHED :
                $eventType = FMActivity\Constants::UNPUBLISH;
                break;

            case \FootManager\Constants::TRASHED :
                $eventType = FMActivity\Constants::TRASH;
                break;

            case 2 :
                $eventType = FMActivity\Constants::ARCHIVE;
                break;
        }

        // Break the context into its parts
        list($extension, $name) = explode('.', $context, 2);

        $table = "";
        switch ($name)
        {
            case "article":
                $table = \JTable::getInstance("Content", "JTable");
                break;

            case "module" :
            case "item" :
                break;

        	default:
                $table = \JTable::getInstance(ucfirst($name), ucfirst(str_replace("com_", "", $extension))."Table");
        }

        if($table) {
            foreach ($pks as $pk)
            {
                $table->reset();
                $table->load($pk);
                $this->saveActivities($context, $table, $eventType);
            }
        }

        return true;

    }

    protected function saveActivities($context, $table, $eventType) {
        if (JFactory::getUser()->authorise('core.create', FM_ACTIVITY_COMPONENT)) {
            $activities = $this->dispatcher->trigger('onGetActivity', array($context, $table, $eventType));

            // Break the context into its parts
            list($extension, $item_name) = explode('.', $context, 2);

            foreach ($activities as $activity)
            {
                if(!empty($activity)) {
                    if(!isset($activity->extension)) $activity->extension = $extension;
                    if(!isset($activity->name)) $activity->name = $item_name;
                    if(!isset($activity->client_id)) $activity->client_id = (\JFactory::getApplication()->isAdmin() ? 1 : 0);
                    if(!isset($activity->state)) $activity->state = FootManager\Constants::ACTIVE;
                    if(!isset($activity->featured)) $activity->featured = FootManager\Constants::ACTIVE;
                    if(!isset($activity->access)) $activity->access = FootManager\Constants::ACTIVE;
                    if(!isset($activity->event)) $activity->event = $eventType;

                    if(!isset($activity->date)) {
                        $date	= \JFactory::getDate("now", \JFactory::getApplication()->getCfg("offset"));
                        $activity->date = $date->toSql(true);
                    }

                    if(!isset($activity->item->extension)) $activity->item->extension = $extension;
                    if(!isset($activity->item->name)) $activity->item->name = $item_name;
                    if(!isset($activity->item->item_id)) $activity->item->item_id = $table->id;
                    if(!isset($activity->item->state)) $activity->item->state = FootManager\Constants::ACTIVE;
                    if(!isset($activity->item->access)) $activity->item->access = FootManager\Constants::ACTIVE;
                    if(!isset($activity->item->metadata)) $activity->item->metadata = new Registry();

                    // Save the item
                    if (!$this->item_model->save(JArrayHelper::fromObject($activity->item, false))) {
                        return false;
                    }

                    // Update event id
                    $activity->event_id = $this->activity_model->getEvent($activity->event);

                    // Update Item id
                    $activity->item_id = $this->item_model->getState($this->item_model->getName() . '.id');

                    // Save the activity
                    if (!$this->activity_model->save(JArrayHelper::fromObject($activity, false))) {
                        return false;
                    }

                    // Reset Item Id
                    $this->activity_model->setState($this->activity_model->getName() . '.id', 0);
                    $this->item_model->setState($this->item_model->getName() . '.id', 0);

                }
            }
        }

        return true;

    }

}