<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;
use Joomla\Registry\Registry;
/**
 * Item Model for an Article.
 *
 * @since  1.6
 */
class FmactivityModelActivity extends FootManager\Model\Admin
{

    /**
     * Stock method to auto-populate the model state.
     *
     * @return  void
     *
     * @since   12.2
     */
	protected function populateState()
	{
		// Load the parameters.
		$value = JComponentHelper::getParams($this->option);
		$this->setState('params', $value);
	}

	/**
     * Method to test whether a record can be deleted.
     *
     * @param   object  $record  A record object.
     *
     * @return  boolean  True if allowed to delete the record. Defaults to the permission set in the component.
     *
     * @since   1.6
     */
	protected function canDelete($record)
	{
		if (!empty($record->id))
		{
			if ($record->state != -2)
			{
				return false;
			}

			return true;
		}
		return false;
	}

	/**
     * Prepare and sanitise the table data prior to saving.
     *
     * @param   JTable  $table  A JTable object.
     *
     * @return  void
     *
     * @since   1.6
     */
	protected function prepareTable($table)
	{

		// Set the publish date to now
		$db = $this->getDbo();
		if ($table->state == 1 && (int) $table->publish_up == 0)
		{
			$table->publish_up = JFactory::getDate()->toSql();
		}
		if ($table->state == 1 && intval($table->publish_down) == 0)
		{
			$table->publish_down = $db->getNullDate();
		}
	}

	/**
     * Method to get the data that should be injected in the form.
     *
     * @return  mixed  The data for the form.
     *
     * @since   1.6
     */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$app = JFactory::getApplication();
		$data = $app->getUserState(FM_ACTIVITY_COMPONENT.'.edit.activity.data', array());
		if (empty($data))
		{
			$data = $this->getItem();
			// Pre-select some filters (Status, Category, Language, Access) in edit form if those have been selected in Article Manager: Articles
			if ($this->getState('activity.id') == 0)
			{
				$filters = (array) $app->getUserState(FM_ACTIVITY_COMPONENT.'.activities.filter');
				$data->set(
					'state',
					$app->input->getInt(
						'state',
						((isset($filters['published']) && $filters['published'] !== '') ? $filters['published'] : null)
					)
				);
				$data->set('access', $app->input->getInt('access', (!empty($filters['access']) ? $filters['access'] : JFactory::getConfig()->get('access'))));
			}
		}
		// If there are params fieldsets in the form it will fail with a registry object
		if (isset($data->params) && $data->params instanceof Registry)
		{
			$data->params = $data->params->toArray();
		}
		$this->preprocessData(FM_ACTIVITY_COMPONENT.'.activity', $data);
		return $data;
	}

	/**
     * Custom clean the cache of com_content and content modules
     *
     * @param   string   $group      The cache group
     * @param   integer  $client_id  The ID of the client
     *
     * @return  void
     *
     * @since   1.6
     */
	protected function cleanCache($group = null, $client_id = 0)
	{
		parent::cleanCache(FM_ACTIVITY_COMPONENT);
	}

    /**
     * Method to toggle the featured setting of articles.
     *
     * @param   array    $pks    The ids of the items to toggle.
     * @param   integer  $value  The value to toggle to.
     *
     * @return  boolean  True on success.
     */
	public function featured($pks, $value = 0)
	{
		$user = JFactory::getUser();
		$table = $this->getTable();
		$pks = (array) $pks;

		// Access checks.
		foreach ($pks as $i => $pk)
		{
			$table->reset();

			if ($table->load($pk))
			{
				if (!$this->canEditState($table))
				{
					// Prune items that you can't change.
					unset($pks[$i]);
					JLog::add(JText::_('JLIB_APPLICATION_ERROR_EDITSTATE_NOT_PERMITTED'), JLog::WARNING, 'jerror');

					return false;
				}
			}
		}

		// Attempt to change the state of the records.
		if (!$table->featured($pks, $value, $user->get('id')))
		{
			$this->setError($table->getError());

			return false;
		}

		if (in_array(false, $result, true))
		{
			$this->setError($table->getError());

			return false;
		}

		// Clear the component's cache
		$this->cleanCache();

		return true;
	}

    /**
     * Method to find an item type by extension and item name.
     *
     * @param     string     $extension    The extension name
     * @param     string     $name         The item name
     * @param     string     $plugin       Optional. If the plugin is provided, the type will be auto-created if not found
     *
     * @return    integer                  The extension type id
     */
    public function getEvent($name)
    {
        static $cache = array();

        // Check the cache
        $key = $name;
        if (isset($cache[$key])) return $cache[$key];

        $event = FMActivity\Database\Models\Event::where("name", "=", $name)->first();
        $cache[$key] = $event ? $event->id : 0;

        if (!$cache[$key]) {
            $obj = new stdClass();

            $obj->id        = null;
            $obj->name      = $name;

            if (!$this->_db->insertObject('#__fmactivity_events', $obj, 'id')) {
                $cache[$key] = 0;
                return $cache[$key];
            }

            $cache[$key] = $obj->id;
        }

        return $cache[$key];
    }

}