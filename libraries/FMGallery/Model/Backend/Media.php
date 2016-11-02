<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace FMGallery\Model\Backend;

defined('_JEXEC') or die;
use Joomla\Registry\Registry;
/**
 * Item Model for an Article.
 *
 * @since  1.6
 */
abstract class Media extends \FootManager\Model\Admin
{
	/**
     * @var        string    The prefix to use with controller messages.
     * @since   1.6
     */
	protected $text_prefix = 'COM_FMGALLERY';

    protected $image = "file";

    /**
     * Constructor.
     *
     * @param   array  $config  An optional associative array of configuration settings.
     *
     * @since   3.2
     */
	public function __construct($config = array())
	{
		parent::__construct($config);

		// Load the Joomla! RAD layer
		if (!defined('FOF_INCLUDED'))
		{
			include_once JPATH_LIBRARIES . '/fof/include.php';
		}
	}

    /**
     * Stock method to auto-populate the model state.
     *
     * @return  void
     *
     * @since   12.2
     */
	protected function populateState()
	{
        parent::populateState();

        // Load the parameters.
        $app = \JFactory::getApplication('administrator');

		$catid = $app->input->getInt('catid', 0);
		$this->setState('catid', $catid);
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
			$user = \JFactory::getUser();
			return $user->authorise('core.edit.state', FM_GALLERY_COMPONENT.'.category.' . (int) $record->catid);
		}
		return false;
	}
	/**
     * Method to test whether a record can have its state edited.
     *
     * @param   object  $record  A record object.
     *
     * @return  boolean  True if allowed to change the state of the record. Defaults to the permission set in the component.
     *
     * @since   1.6
     */
	protected function canEditState($record)
	{
		$user = \JFactory::getUser();
		if (!empty($record->catid))
		{
			return $user->authorise('core.edit.state', FM_GALLERY_COMPONENT.'.category.' . (int) $record->catid);
		}
		// Default to component settings if neither article nor category known.
		else
		{
			return parent::canEditState(FM_GALLERY_COMPONENT);
		}
	}
	/**
     * Prepare and sanitise the table data prior to saving.
     *
     * @param   \JTable  $table  A JTable object.
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
			$table->publish_up = \JFactory::getDate()->toSql();
		}
		if ($table->state == 1 && intval($table->publish_down) == 0)
		{
			$table->publish_down = $db->getNullDate();
		}
		// Reorder the articles within the category so the new article is first
		if (empty($table->id))
		{
			$table->reorder('catid = ' . (int) $table->catid . ' AND state >= 0');
		}
	}

	/**
     * Method to get a single record.
     *
     * @param   integer  $pk  The id of the primary key.
     *
     * @return  mixed  Object on success, false on failure.
     */
	public function getItem($pk = null)
	{
		if ($item = parent::getItem($pk))
		{
			// Convert the metadata field to an array.
			$registry = new Registry;($item->metadata);
			$item->metadata = $registry->toArray();
			if (!empty($item->id))
			{
				$item->tags = new \JHelperTags;
				$item->tags->getTagIds($item->id, FM_GALLERY_COMPONENT.'.'.$this->getName());
			}
		}
		return $item;
	}
	/**
     * Method to get the record form.
     *
     * @param   array    $data      Data for the form.
     * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
     *
     * @return  mixed  A JForm object on success, false on failure
     *
     * @since   1.6
     */
	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm(FM_GALLERY_COMPONENT.'.'.$this->getName(), $this->getName(), array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form))
		{
			return false;
		}

		// Determine correct permissions to check.
		if ($this->getState($this->getName().'.id'))
		{
			// Existing record. Can only edit in selected categories.
			$form->setFieldAttribute('catid', 'action', 'core.edit');
			// Existing record. Can only edit own articles in selected categories.
			$form->setFieldAttribute('catid', 'action', 'core.edit.own');
		}
		else
		{
			// New record. Can only create in selected categories.
			$form->setFieldAttribute('catid', 'action', 'core.create');
		}

        if(!JDEBUG)
            $form->setFieldAttribute('ordering', 'disabled', 'true');

		return $form;
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
		$app = \JFactory::getApplication();
		$data = $app->getUserState(FM_GALLERY_COMPONENT.'.edit.'.$this->getName().'.data', array());
		if (empty($data))
		{
			$data = $this->getItem();
			// Pre-select some filters (Status, Category, Language, Access) in edit form if those have been selected in Article Manager: Articles
			if ($this->getState($this->getName().'.id') == 0)
			{
				$filters = (array) $app->getUserState(FM_GALLERY_COMPONENT.'.'.\FootManager\Utilities\StringHelper::pluralize($this->getName()).'.filter');
				$data->set(
					'state',
					$app->input->getInt(
						'state',
						((isset($filters['published']) && $filters['published'] !== '') ? $filters['published'] : null)
					)
				);
				$data->set('catid', $app->input->getInt('catid', (!empty($filters['category_id']) ? $filters['category_id'] : null)));
				$data->set('access', $app->input->getInt('access', (!empty($filters['access']) ? $filters['access'] : \JFactory::getConfig()->get('access'))));
			}
		}
		// If there are params fieldsets in the form it will fail with a registry object
		if (isset($data->params) && $data->params instanceof Registry)
		{
			$data->params = $data->params->toArray();
		}
		$this->preprocessData(FM_GALLERY_COMPONENT.'.photo', $data);
		return $data;
	}

	/**
     * Method to save the form data.
     *
     * @param   array  $data  The form data.
     *
     * @return  boolean  True on success.
     *
     * @since   1.6
     */
	public function save($data)
	{
		$filter  = \JFilterInput::getInstance();
		if (isset($data['metadata']) && isset($data['metadata']['author']))
		{
			$data['metadata']['author'] = $filter->clean($data['metadata']['author'], 'TRIM');
		}
		// Automatic handling of alias for empty fields
		if (!isset($data['id']) || (int) $data['id'] == 0)
		{
			if ($data['alias'] == null)
			{
				if (\JFactory::getConfig()->get('unicodeslugs') == 1)
				{
					$data['alias'] = \JFilterOutput::stringURLUnicodeSlug($data['title']);
				}
				else
				{
					$data['alias'] = \JFilterOutput::stringURLSafe($data['title']);
				}

				$data['alias'] = $this->generateNewTitle($data['catid'], $data['alias'], $data['title'])[1];
				if (isset($msg))
				{
					\JFactory::getApplication()->enqueueMessage($msg, 'warning');
				}
			}
		}
		if (parent::save($data))
		{
			return true;
		}
		return false;
	}
	/**
     * A protected method to get a set of ordering conditions.
     *
     * @param   object  $table  A record object.
     *
     * @return  array  An array of conditions to add to add to ordering queries.
     *
     * @since   1.6
     */
	protected function getReorderConditions($table)
	{
		$condition = array();
		$condition[] = 'catid = ' . (int) $table->catid;
		return $condition;
	}

    /**
     * Method to delete one or more records.
     *
     * @param   array  &$pks  An array of record primary keys.
     *
     * @return  boolean  True if successful, false if an error occurs.
     *
     * @since   12.2
     */
	public function delete(&$pks)
	{
		$dispatcher = \JEventDispatcher::getInstance();
		$pks = (array) $pks;
		$table = $this->getTable();

		// Include the plugins for the delete events.
		\JPluginHelper::importPlugin($this->events_map['delete']);

		// Iterate the items to delete each one.
		foreach ($pks as $i => $pk)
		{
			if ($table->load($pk))
			{
				if ($this->canDelete($table))
				{
					$context = $this->option . '.' . $this->name;

					// Trigger the before delete event.
					$result = $dispatcher->trigger($this->event_before_delete, array($context, $table));

					if (in_array(false, $result, true))
					{
						$this->setError($table->getError());

						return false;
					}

                    $filesToDelete = array();
                    if($table->state == -2) {
                        $filesToDelete[] = $table->file;
                        $filesToDelete[] = $table->thumb_small;
                        $filesToDelete[] = $table->thumb_medium;
                        $filesToDelete[] = $table->thumb_large;
                    }

					if (!$table->delete($pk))
					{
						$this->setError($table->getError());

						return false;
					}

                    // Delete Files
                    foreach ($filesToDelete as $file)
                    {
                    	\JFile::delete(JPATH_ROOT.DS.$file);
                    }

					// Trigger the after event.
					$dispatcher->trigger($this->event_after_delete, array($context, $table));
				}
				else
				{
					// Prune items that you can't change.
					unset($pks[$i]);
					$error = $this->getError();

					if ($error)
					{
						\JLog::add($error, \JLog::WARNING, 'jerror');

						return false;
					}
					else
					{
						\JLog::add(\JText::_('JLIB_APPLICATION_ERROR_DELETE_NOT_PERMITTED'), \JLog::WARNING, 'jerror');

						return false;
					}
				}
			}
			else
			{
				$this->setError($table->getError());

				return false;
			}
		}

		// Clear the component's cache
		$this->cleanCache();

		return true;
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
		parent::cleanCache(FM_GALLERY_COMPONENT);
	}

    /**
     * Method to change the published state of one or more records.
     *
     * @param   array    &$pks   A list of the primary keys to change.
     * @param   integer  $value  The value of the published state.
     *
     * @return  boolean  True on success.
     *
     * @since   12.2
     */
	public function recreateThumbnails(&$pks)
	{
		$table = $this->getTable();
		$pks = (array) $pks;
        $imageField = $this->image;

        if($imageField) {

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
                        \JLog::add(\JText::_('JLIB_APPLICATION_ERROR_EDITSTATE_NOT_PERMITTED'), \JLog::WARNING, 'jerror');

                        return false;
                    }
                }

                \FMGallery\Utilities\FileHelper::createThumbnails(JPATH_ROOT.DS.$table->$imageField);
            }
        }

		// Clear the component's cache
		$this->cleanCache();

		return true;
	}

    /**
     * Batch move items to a new category
     *
     * @param   integer  $value     The new category ID.
     * @param   array    $pks       An array of row IDs.
     * @param   array    $contexts  An array of item contexts.
     *
     * @return  boolean  True if successful, false otherwise and internal error is set.
     *
     * @since	12.2
     */
	protected function batchMove($value, $pks, $contexts)
	{
        $imageField = $this->image;
        $category = \FMGallery\Database\Models\Category::find($value);
        if(parent::batchMove($value, $pks, $contexts)) {

            if($imageField) {
                foreach ($pks as $pk)
                {

                    $this->table->reset();

                    // Check that the row actually exists
                    if ($this->table->load($pk))
                    {
                        $file = JPATH_ROOT.DS.$this->table->$imageField;
                        $thumb_small = JPATH_ROOT.DS.$this->table->thumb_small;
                        $thumb_medium = JPATH_ROOT.DS.$this->table->thumb_medium;
                        $thumb_large = JPATH_ROOT.DS.$this->table->thumb_large;

                        $newFile = \FMGallery\Utilities\FileHelper::moveInCategoryFolder($file, $category);
                        $thumbs = \FMGallery\Utilities\FileHelper::createThumbnails($newFile);

                        \JFile::delete($file);
                        \JFile::delete($thumb_small);
                        \JFile::delete($thumb_medium);
                        \JFile::delete($thumb_large);

                        $this->table->$imageField = str_replace(JPATH_ROOT.DS, "", $newFile);
                        $this->table->thumb_small = str_replace(JPATH_ROOT.DS, "", $thumbs[\FMGallery\Constants::SMALL]);
                        $this->table->thumb_medium = str_replace(JPATH_ROOT.DS, "", $thumbs[\FMGallery\Constants::MEDIUM]);
                        $this->table->thumb_large = str_replace(JPATH_ROOT.DS, "", $thumbs[\FMGallery\Constants::LARGE]);

                        // Check the row.
                        if (!$this->table->check())
                        {
                            $this->setError($this->table->getError());

                            return false;
                        }

                        // Store the row.
                        if (!$this->table->store())
                        {
                            $this->setError($this->table->getError());

                            return false;
                        }
                    }

                }
            }

            return true;

        }

        return false;

    }

}