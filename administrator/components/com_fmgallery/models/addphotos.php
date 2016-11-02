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
class FmgalleryModelAddphotos extends JModelAdmin
{
	/**
     * The prefix to use with controller messages.
     *
     * @var    string
     * @since  12.2
     */
	protected $text_prefix = null;

	/**
     * Constructor.
     *
     * @param   array  $config  An optional associative array of configuration settings.
     *
     * @see     JModelLegacy
     * @since   12.2
     */
	public function __construct($config = array())
	{
		parent::__construct($config);

		// Guess the JText message prefix. Defaults to the option.
		if (isset($config['text_prefix']))
		{
			$this->text_prefix = strtoupper($config['text_prefix']);
		}
		elseif (empty($this->text_prefix))
		{
			$this->text_prefix = strtoupper($this->option);
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
        // Load the parameters.
        $app = JFactory::getApplication('administrator');

		$value = JComponentHelper::getParams($this->option);
		$this->setState('params', $value);

		$catid = $app->input->getInt('catid', 0);
		$this->setState('addphotos.catid', $catid);
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
		$form = $this->loadForm(FM_GALLERY_COMPONENT.'.addphotos', 'addphotos', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form))
		{
			return false;
		}

        // New record. Can only create in selected categories.
        $form->setFieldAttribute('catid', 'action', 'core.create');

		return $form;
	}

    protected function loadFormData()
    {
        // Check the session for previously entered form data.
        $data = JFactory::getApplication()->getUserState(FM_GALLERY_COMPONENT.'.edit.addphotos.data', array());

        if($this->getState('addphotos.catid', 0) > 0) {
            $data["catid"] = $this->getState('addphotos.catid', 0);
        }

        return JArrayHelper::toObject($data, 'stdClass', false);
    }

    public function getCategory($id) {
        return \FMGallery\Database\Models\Category::find($id);
    }

    /**
     * Method to save the form data.
     *
     * @param   array  $data  The form data.
     *
     * @return  boolean  True on success, False on error.
     *
     * @since   12.2
     */
	public function save($data)
	{

		$dispatcher = JEventDispatcher::getInstance();
		$table      = JTable::getInstance("Category");
		$context    = $this->option . '.' . $this->name;

		$pk = $data["catid"];
		$isNew = true;

		// Include the plugins for the save events.
		JPluginHelper::importPlugin($this->events_map['save']);

		// Allow an exception to be thrown.
		try
		{
			// Load the row if saving an existing record.
			if ($pk > 0)
			{
				$table->load($pk);
				$isNew = false;
			}

			// Trigger the before save event.
			$result = $dispatcher->trigger($this->event_before_save, array($context, $table, $isNew));

			if (in_array(false, $result, true))
			{
				$this->setError($table->getError());

				return false;
			}

			// Store the data.
			if (!$table->store())
			{
				$this->setError($table->getError());

				return false;
			}

			// Clean the cache.
			$this->cleanCache();

			// Trigger the after save event.
			$dispatcher->trigger($this->event_after_save, array($context, $table, $isNew));
		}
		catch (Exception $e)
		{
			$this->setError($e->getMessage());

			return false;
		}

		return true;
	}

}