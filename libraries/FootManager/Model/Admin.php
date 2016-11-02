<?php
/**
 * @package      FootManager
 * @subpackage   Models
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FootManager\Model;

defined('JPATH_PLATFORM') or die;
/**
 * This class contains common methods and properties
 * used in work with ajax actions.
 *
 * @package      FootManager
 * @subpackage   Models
 */
abstract class Admin extends \JModelAdmin
{

    protected $_item;

    /**
     * Stock method to auto-populate the model state.
     *
     * @return  void
     *
     * @since   12.2
     */
    protected function populateState() {
        parent::populateState();

        $app = \JFactory::getApplication('administrator');
        $return = $app->input->get("return_page", null, 'base64');
        $this->setState("return_page", base64_decode($return));
    }

	/**
     * Constructor.
     *
     * @param   array  $config  An optional associative array of configuration settings.
     *
     * @since   3.2
     */
	public function __construct($config = array())
	{

        // Guess the option from the class name (Option)Model(View).
		if (empty($this->option))
		{
			$r = null;

			if (!preg_match('/(.*)Model/i', get_class($this), $r))
			{
				throw new \Exception(\JText::_('JLIB_APPLICATION_ERROR_MODEL_GET_NAME'), 500);
			}

			$this->option = 'com_' . strtolower($r[1]);
		}

		$config = array_merge(
			array(
                'events_map'  => array('save' => strtolower(str_replace('com_', '', $this->option)), 'delete' => strtolower(str_replace('com_', '', $this->option)), 'change_state' => strtolower(str_replace('com_', '', $this->option)))
			), $config
		);

        // Include the plugins for the save events.
		\JPluginHelper::importPlugin("content");

		parent::__construct($config);
	}

    /**
     * Method to get a table object, load it if necessary.
     *
     * @param   string  $name     The table name. Optional.
     * @param   string  $prefix   The class prefix. Optional.
     * @param   array   $options  Configuration array for model. Optional.
     *
     * @return  \JTable  A JTable object
     *
     * @since   12.2
     * @throws  \Exception
     */
    public function getTable($name = '', $prefix = '', $options = array()) {
        if($name =='')
            $name = ucfirst($this->getName());
        if($prefix == '')
            $prefix = ucfirst(strtolower(str_replace('com_', '', $this->option)))."Table";
        return parent::getTable($name, $prefix, $options);
    }

    /**
     * Abstract method for getting the form from the model.
     *
     * @param   array    $data      Data for the form.
     * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
     *
     * @return  mixed  A JForm object on success, false on failure
     *
     * @since   12.2
     */
    public function getForm($data = array(), $loadData = true)
    {
        // Get the form.
        $form = $this->loadForm($this->option.'.'.$this->getName(), $this->getName(), array('control' => 'jform', 'load_data' => $loadData));

        return $form;
    }

    /**
     * Method to get the data that should be injected in the form.
     *
     * @return  object    The default data is an empty array.
     *
     * @since   12.2
     */
    protected function loadFormData()
    {
        // Check the session for previously entered form data.
        $data = \JFactory::getApplication()->getUserState($this->option.'.edit.'.$this->getName().'.data', array());
        if(empty($data))
            return $this->getItem();
        else
            $data = array_merge(\JArrayHelper::fromObject($this->getItem(), false), $data);
        return \JArrayHelper::toObject($data, 'stdClass', false);

    }

    /**
     * Method to get a single record.
     *
     * @param   integer  $pk  The id of the primary key.
     *
     * @return  mixed    Object on success, false on failure.
     *
     * @since   12.2
     */
	public function getItem($pk = null)
	{
        if(!empty($this->_item)) return $this->_item;

		$pk = (!empty($pk)) ? $pk : (int) $this->getState($this->getName() . '.id');
		$table = $this->getTable();

		if ($pk > 0)
		{
			// Attempt to load the row.
			$return = $table->load($pk);

			// Check for a table object error.
			if ($return === false && $table->getError())
			{
				$this->setError($table->getError());

				return false;
			}
		}

		// Convert to the JObject before adding other data.
		$properties = $table->getProperties(true);
		$item = \JArrayHelper::toObject($properties, 'JObject', false);

		if (property_exists($item, 'params'))
		{
			$registry = new \Joomla\Registry\Registry($item->params);
			$item->params = $registry->toArray();
		}

        if (property_exists($item, 'attribs'))
		{
			$registry = new \Joomla\Registry\Registry($item->attribs);
			$item->attribs = $registry->toArray();
		}

		$this->_item = $item;

        return $this->_item;
	}

    /**
     * Auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @return  void
     * @since    3.0
     */
    protected function preprocessForm(\JForm $form, $data, $group = null) {

        $elements[] = new \SimpleXMLElement('<field name="created"
														type="fmdatetimepicker"
														label="JGLOBAL_FIELD_CREATED_LABEL"
                                                        readonly="true"
                                                 />');
        $elements[] = new \SimpleXMLElement('<field name="created_by"
														type="user"
														label="JGLOBAL_FIELD_CREATED_BY_LABEL"
                                                        readonly="true"
                                                 />');
        $elements[] = new \SimpleXMLElement('<field name="modified"
														type="fmdatetimepicker"
														label="JGLOBAL_FIELD_MODIFIED_LABEL"
                                                        readonly="true"
                                                 />');
        $elements[] = new \SimpleXMLElement('<field name="modified_by"
														type="user"
														label="JGLOBAL_FIELD_MODIFIED_BY_LABEL"
                                                        readonly="true"
                                                 />');

        if(!\JDEBUG)
            $elements[] = new \SimpleXMLElement('<field name="id" type="hidden" />');
        else
            $elements[] = new \SimpleXMLElement('<field name="id" type="text" label="FMLIB_FIELD_ID" readonly="true" />');

        $form->setFields($elements, null, false);

        parent::preprocessForm($form, $data, $group);
    }

    /**
     * Method to invertTeam in the form data.
     *
     * @param   array  $data  The form data.
     *
     * @return  boolean  True on success, False on error.
     *
     * @since   12.2
     */
	protected function action($pks, $action, $parameters = array())
	{
		$table      = $this->getTable();

        foreach ((array)$pks as $pk)
        {
            $table->reset();
            $table->load($pk);

            // Bind the data.
            if (!call_user_func(array($table, $action), $parameters))
            {
                $this->setError($table->getError());
                return false;
            }

            // Check the data.
            if (!$table->check())
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
        }

        // Clean the cache.
        $this->cleanCache();

		return true;
	}

}