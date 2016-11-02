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
class FmactivityModelItem extends FootManager\Model\Admin
{
    /**
     * Abstract method for getting the form from the model.
     *
     * @param     array      $data        Data for the form.
     * @param     boolean    $loadData    True if the form is to load its own data (default case), false if not.
     *
     * @return    mixed                   A JForm object on success, false on failure
     */
    public function getForm($data = array(), $loadData = true)
    {
        // There is no form.
        return false;
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

        // Check if we have an asset id
        if (!isset($data['type_id']) || empty($data['type_id'])) {
            // We need at least an extension name, item name and id to find or create the asset.
            if (!isset($data['extension']) || !isset($data['name']) || !isset($data['item_id'])) {
                return false;
            }

            // Load Type
            $data['type_id'] = $this->getType($data['extension'], $data['name'], $data['plugin']);

            // Check if we have an asset id now
            if (!$data['type_id']) return false;
        }

        if(!empty($data["metadata"]))
            $data["metadata"] = $data["metadata"]->toString();

		$table      = $this->getTable();

		$key = $table->getKeyName();

		// Allow an exception to be thrown.
		try
		{

            $table->load(["type_id" => $data["type_id"], "item_id" => $data["item_id"]]);

			// Bind the data.
			if (!$table->bind($data))
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

		}
		catch (Exception $e)
		{
			$this->setError($e->getMessage());

			return false;
		}

		if (isset($table->$key))
		{
			$this->setState($this->getName() . '.id', $table->$key);
		}

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
    public function getType($extension, $name, $plugin = null)
    {
        static $cache = array();

        // Check the cache
        $key = $extension . '.' . $name;
        if (isset($cache[$key])) return $cache[$key];

        $type = FMActivity\Database\Models\Type::where("extension", "=", $extension)->where("name", "=", $name)->first();
        $cache[$key] = !empty($type) ? $type->id : 0;

        if (!$cache[$key] && $plugin) {
            $obj = new stdClass();

            $obj->id        = null;
            $obj->plugin    = $plugin;
            $obj->extension = $extension;
            $obj->name      = $name;

            if (!$this->_db->insertObject('#__fmactivity_item_types', $obj, 'id')) {
                $cache[$key] = 0;
                return $cache[$key];
            }

            $cache[$key] = $obj->id;
        }

        return $cache[$key];
    }

    /**
     * Method to auto-populate the model state.
     *
     * @return    void
     */
    protected function populateState()
    {
        // Do nothing
    }
}