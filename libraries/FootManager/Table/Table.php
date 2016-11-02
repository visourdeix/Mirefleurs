<?php
/**
 * @package     FootManager
 * @subpackage  Table
 *
 * @copyright   Copyright (C) 2015 STéphane ANDRE. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace FootManager\Table;

defined('_JEXEC') or die;

use Joomla\Registry\Registry;

jimport('joomla.database.table');

/**
 * Positions Table.
 *
 */
abstract class Table extends \JTable
{

    /**
     * Relationships.
     * @var mixed
     */
    protected $_references = array();

    /**
     * Relationships.
     * @var mixed
     */
    protected $_references_in = array();

    /**
     * Model.
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $_defaultModel;

    /**
     * Model.
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $_model;

    /**
     * Fields to check.
     * @var mixed
     */
    protected $_not_empty_fields = array();

    /**
     * Fields to check.
     * @var mixed
     */
    protected $_unique_fields = array();

    /**
     * Construct an instance.
     * @param string $model
     * @param \JDatabaseDriver $db
     */
    function __construct($model, &$db)
    {
        $this->_defaultModel = new $model();
        parent::__construct('#__'.$this->_defaultModel->getTable(), $this->_defaultModel->getKeyName(), $db);
    }

    /**
     * Method to load a row from the database by primary key and bind the fields
     * to the JTable instance properties.
     *
     * @param   mixed    $keys   An optional primary key value to load the row by, or an array of fields to match.  If not
     *                           set the instance property value is used.
     * @param   boolean  $reset  True to reset the default values before loading the new row.
     *
     * @return  boolean  True if successful. False if row not found.
     *
     * @link    https://docs.joomla.org/JTable/load
     * @since   11.1
     * @throws  \InvalidArgumentException
     * @throws  \RuntimeException
     * @throws  \UnexpectedValueException
     */
    public function load($id = null, $reset = true) {
        if($id) {
            $this->setModel($id);
        } else {
            $this->_model = null;
        }

        if(parent::load($id, $reset)) {
            return $this->loadReferences($id);
        }

        return false;
    }

    /**
     * Method to bind an associative array or object to the JTable instance.This
     * method only binds properties that are publicly accessible and optionally
     * takes an array of properties to ignore when binding.
     *
     * @param   mixed  $src     An associative array or object to bind to the JTable instance.
     * @param   mixed  $ignore  An optional array or space separated list of properties to ignore while binding.
     *
     * @return  boolean  True on success.
     *
     * @since   11.1
     * @throws  \InvalidArgumentException
     */
    public function bind($array, $ignore = '') {

        // If the source value is not an array or object return false.
		if (!is_object($array) && !is_array($array))
		{
			throw new \InvalidArgumentException(sprintf('%s::bind(*%s*)', get_class($this), gettype($array)));
		}

        // If the source value is an object, get its accessible properties.
		if (is_object($array))
		{
			$src = get_object_vars($array);
		} else {
            $src = $array;
        }

        if (isset($src['attribs']) && is_array($src['attribs']))
		{
			$registry = new Registry;
			$registry->loadArray($src['attribs']);
			$src['attribs'] = (string) $registry;
		}

        if (isset($src['params']) && is_array($src['params']))
		{
			$registry = new Registry;
			$registry->loadArray($src['params']);
			$src['params'] = (string) $registry;
		}

        if(parent::bind($src, $ignore))  return $this->bindReferences($src);
        return false;
    }

    /**
     * Overloaded check function
     *
     * @return  boolean  True on success, false on failure
     *
     * @see JTable::check
     * @since 1.5
     */
	public function check()
	{
        $option = \FootManager\Helpers\Application::getActiveComponent();

        foreach ($this->_not_empty_fields as $field)
        {
            if (isset($this->$field) && trim($this->$field) == '')
            {
                $this->setError(\JText::sprintf("FMLIB_ERROR_FIELD_IS_EMPTY", \JText::_(strtoupper($option."_FIELD_".$field))));
                return false;
            }
        }

		if(!$this->isUnique($this->_unique_fields)) {
            $this->setError(\JText::_('FMLIB_ERROR_ITEM_ALREADY_EXISTS'));
			return false;
        }

        return true;
	}

    /**
     * Method to store a row in the database from the JTable instance properties.
     * If a primary key value is set the row with that primary key value will be
     * updated with the instance property values.  If no primary key value is set
     * a new row will be inserted into the database with the properties from the
     * JTable instance.
     *
     * @param   boolean  $updateNulls  True to update fields even if they are null.
     *
     * @return  boolean  True on success.
     *
     * @link    https://docs.joomla.org/JTable/store
     * @since   11.1
     */
	public function store($updateNulls = false)
	{
        $primaryKey = $this->_tbl_keys[0];
        $date	= \JFactory::getDate("now", \JFactory::getApplication()->getCfg("offset"));
		$user	= \JFactory::getUser();

        // Update item
		if ($this->$primaryKey)
		{
            if(property_exists($this, "modified"))
			    $this->modified		= $date->toSql(true);
            if(property_exists($this, "modified_by"))
			    $this->modified_by	= $user->get('id');
		}
		else
		{
            // Create item
			if (property_exists($this, "created") && !(int) $this->created)
			{
				$this->created = $date->toSql(true);
			}
			if (property_exists($this, "created_by") && empty($this->created_by))
			{
				$this->created_by = $user->get('id');
			}
		}

        if(parent::store($updateNulls))
            return $this->storeReferences();

        return false;
	}

    /**
     * Method to reset class properties to the defaults set in the class
     * definition. It will ignore the primary key as well as any private class
     * properties (except $_errors).
     *
     * @return  void
     *
     * @link    https://docs.joomla.org/JTable/reset
     * @since   11.1
     */
	public function reset()
	{
        $this->_model = null;
		parent::reset();
        $this->resetReferences();
	}

    /**
     * Method to delete a data from the database.
     *
     * @param   integer  $Id  An optional id.
     *
     * @return  boolean  True on success, false on failure.
     *
     * @since   11.1
     */
	public function delete($id = null)
	{
        if($this->checkBeforeDelete($id)) {
            if($this->deleteReferences($id))
                return parent::delete($id);
        }

        return false;

    }

    /**
     * Method to load referenced data.
     * @return bool
     */
    public function loadReferences($id = null) {
        $model = $this->getModel($id);
        foreach ($this->_references as $property => $reference)
        {
            if(!$reference["onlyDelete"]) {
                if($model)
                    $this->$property = $this->loadReference($property, $reference["model"], $reference["foreignKey"], $reference["column"], $id);
                else
                    $this->$property = array();
            }
        }
        return true;
    }

    /**
     * Method to load referenced data.
     * @return array
     */
    public function loadReference($property, $modelName, $sforeignKey, $column = false, $id = null) {
        $model = $this->getModel($id);

        if($model) {
            $result = $model->$property()->withoutGlobalScopes()->get();

            if(!$column)
                return $result->toArray();
            else {
                return $result->map(function($obj) { return $obj->id; })->toArray();
            }
        } else
            return [];
    }

    /**
     * Method to bind referenced data.
     * @return bool
     */
    public function bindReferences($array = array()) {

        foreach ($this->_references as $property => $reference)
            if(!$reference["onlyDelete"])
                $this->setPropertyFromArray($array, $property, $reference["allowAddItem"]);

        return true;
    }

    /**
     * Method to store referenced data.
     * @return bool
     */
    public function storeReferences() {
        foreach ($this->_references as $property => $reference)
            if(!$reference["onlyDelete"])
                $this->storeReference($property, $reference["model"], $reference["foreignKey"], $reference["column"]);

        return true;
    }

    /**
     * Stores items related to this.
     * @param string $property
     * @param string $referenceModel
     */
    protected function storeReference($property, $modelName, $foreignKey, $column = false) {
        $model = $this->getModel();

        if($model && isset($this->$property)) {
            if(!$column) {

                // Delete all related items.
                $this->deleteReference($property, $modelName, $foreignKey);

                // Add new related items.
                $array_models = [];
                foreach ($this->$property as $item)
                {
                    $new_model = new $modelName((array)$item);
                    $array_models[] = $new_model;
                }
                if($array_models) $model->$property()->saveMany($array_models);

            } else {
                // Sync related items.
                $model->$property()->sync($this->$property);
            }
        }

        return true;
    }

    /**
     * Method to store a reference table with a JTable Instance.
     * @return bool
     */
    protected function storeComplexReferences($new_items, $tableInstanceName, $foreignKey, $tablePrefix) {

        $referencedTable = \JTable::getInstance($tableInstanceName, $tablePrefix);
        $primaryKey = $this->_tbl_keys[0];

        $query = $this->_db->getQuery(true)
                      ->select($referencedTable->getKeyName())
                      ->from($referencedTable->getTableName())
                      ->where($foreignKey . ' = ' . (int) $this->$primaryKey);

        $this->_db->setQuery($query);
		$old_ids = $this->_db->loadColumn();
        $new_ids = \FootManager\Utilities\ArrayHelper::getColumn($new_items, $referencedTable->getKeyName());

        foreach ($old_ids as $old_id)
        {
            if(!in_array($old_id, $new_ids)) {
                $referencedTable->reset();
                if(!$referencedTable->delete($old_id)) {
                    $this->setError($referencedTable->getError());
                    return false;
                }
            }

        }

        foreach ($new_items as $new_item)
        {
            $referencedTable = \JTable::getInstance($tableInstanceName, $tablePrefix);
            $key = $referencedTable->getKeyName();
            $referencedTable->load($new_item[$key]);

            $item = array_merge($referencedTable->getProperties(true), $new_item);
            $item[$foreignKey] = (int) $this->$primaryKey;
            $referencedTable->bind($item);

            $referencedTable->store();
        }

        return true;
    }

    /**
     * Method to check if it's possible to delete a data.
     * @return bool
     */
    public function checkBeforeDelete($id = null) {

        $tablesIsUsed = array();
        foreach ($this->_references_in as $reference)
        {
            $count = $this->getReferenceCount($reference["model"], $reference["foreignKey"], $id);

            if($count > 0) $tablesIsUsed[] = array("table" => $reference["model"], "count" => $count);
        }

        if(count($tablesIsUsed) > 0) {
            $this->setError(\JText::_('FMLIB_ERROR_ITEM_USED_IN_TABLE'));

            if(\FootManager\Helpers\Access::isAdmin()) {
                $str = array();
                foreach($tablesIsUsed as $table) {
                    $str[] = $table["table"].' : '.$table["count"];
                }
                $this->setError(\JText::sprintf('FMLIB_ERROR_ITEM_USED_IN_TABLE_DETAIL', implode("<br />", $str)));

            }

            return false;
        }

        return true;

    }

    /**
     * Method to delete referenced data of an item.
     *
     * @param     mixed      $pk    An primary key value to delete.
     *
     * @return    boolean
     */
    public function deleteReferences($id = null)
    {
        foreach ($this->_references as $property => $reference) {
            if(!$this->deleteReference($property, $reference["model"], $reference["foreignKey"],$id)) return false;
        }

        return true;
    }

    /**
     * Method to load referenced data.
     * @return boolean
     */
    protected function deleteReference($property, $modelName, $foreignKey, $id = null) {
        $model = new $modelName();
        $model->withoutGlobalScopes()->where($this->getForeignKey($foreignKey), "=", $this->getId($id))->delete();
        return true;
    }

    /**
     * Method to delete a reference table with a JTable Instance.
     * @return bool
     */
    protected function deleteComplexReferences($tableInstanceName, $foreignKey, $tablePrefix, $id = null) {

        $referencedTable = \JTable::getInstance($tableInstanceName, $tablePrefix);
        $primaryKey = $this->_tbl_keys[0];
        $id = ($id) ? $id : $this->$primaryKey;

        $query = $this->_db->getQuery(true)
                      ->select($referencedTable->getKeyName())
                      ->from($referencedTable->getTableName())
                      ->where($foreignKey . ' = ' . (int) $id);

        $this->_db->setQuery($query);
		$ids = $this->_db->loadColumn();

        foreach ($ids as $id)
        {
            $referencedTable->reset;
            if(!$referencedTable->delete($id)) {
                $this->setError($referencedTable->getError());
                return false;
            }
        }

        return true;
    }

    /**
     * Method to load referenced data.
     */
    public function resetReferences($id = null) {
        foreach ($this->_references as $property => $reference)
        {
            $this->$property = array();
        }
    }

    /**
     * Store property from array.
     * @param array $data
     * @param string $property
     * @param callable $funcAllowAddItem
     * @return void
     */
    protected function setPropertyFromArray(&$data, $property, callable $funcAllowAddItem = null)
    {
        $array = (array)$data;
        if(isset($array[$property])) {

            if(is_array($array[$property])) {
                $result = ($array[$property]);
            } else {
                $result = json_decode($array[$property], true);
            }
            if(!\FootManager\Utilities\ArrayHelper::is_multi($result)) {
                $this->$property = $result;
                return;
            }

            $this->$property = array();

            foreach($result as $item) {

                $convertItem = (array)$item;

                if(!is_callable($funcAllowAddItem) || (is_callable($funcAllowAddItem) && call_user_func($funcAllowAddItem, $convertItem))) {
                    array_push($this->$property, $convertItem);
                }
            }

        } else {
            $this->$property = array();
        }
    }

    /**
     * Get model if existing.
     * @param mixed $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function getModel($id = null) {
        $id = $this->getId($id);
        if(!isset($this->_model) && $id) {
            $this->setModel($id);
        }

        return $this->_model;
    }

    /**
     * Get model if existing.
     * @param mixed $id
     */
    protected function setModel($id) {
        $defaultModel = clone($this->_defaultModel);
        $this->_model = $defaultModel->withoutGlobalScopes()->find($id);
    }

    /**
     * Get Id.
     * @param mixed $id
     * @return mixed
     */
    protected function getId($id = null) {
        $KeyName = $this->_defaultModel->getKeyName();
        return ($id) ? $id : $this->$KeyName;
    }

    /**
     * Get Id.
     * @param mixed $id
     * @return mixed
     */
    protected function getForeignKey($foreignKey = null) {
        return ($foreignKey) ? $foreignKey : $this->_defaultModel->getForeignKey();
    }

    /**
     * Add a reference.
     * @param string $property
     * @param string $modelName
     * @param callable $funcAllAddItem
     * @param string $foreignKey
     * @param boolean $column
     */
    protected function addReference($property, $modelName, callable $funcAllAddItem = null, $foreignKey = "", $column = false, $onlyDelete = false) {
        $this->_references[$property] = ["model" => $modelName, "foreignKey" => $this->getForeignKey($foreignKey), "column" => $column,  "allowAddItem" => $funcAllAddItem,  "onlyDelete" => $onlyDelete];
    }

    /**
     * Add a column reference.
     * @param string $property
     * @param string $modelName
     */
    protected function addColumnReference($property, $modelName, $foreignKey = "") {
        $this->addReference($property, $modelName, null, $foreignKey, true, false);
    }

    /**
     * Add a column reference.
     * @param string $property
     * @param string $modelName
     */
    protected function addOnlyDeleteReference($property, $modelName, $foreignKey = "") {
        $this->addReference($property, $modelName, null, $foreignKey, true, true);
    }

    /**
     * Method to add a table in array of referenced table to check before delete data.
     */
    public function addReferenceIn($modelName, $foreignKey = "") {
        array_push($this->_references_in, array("model" => $modelName, "foreignKey" => $this->getForeignKey($foreignKey)));
    }

    /**
     * Method to add a unique fields.
     */
    public function addUniqueFields($field) {
        $args = (is_array($field)) ? $field : func_get_args();
        $this->_unique_fields = array_merge($this->_unique_fields, $args);
    }

    /**
     * Method to add a not empty fields
     */
    public function addNotEmptyFields($field) {
        $args = (is_array($field)) ? $field : func_get_args();
        $this->_not_empty_fields = array_merge($this->_not_empty_fields, $args);
    }

    /**
     * CHeck if the item is unique in table.
     * @param mixed $uniqueFields
     * @return bool
     */
    protected function isUnique($uniqueFields) {

        if($uniqueFields) {
            $id = $this->getId();
            $primaryKey = $this->_tbl_key;
            $model = $this->_defaultModel->where($primaryKey, "<>", $id);
            foreach ($uniqueFields as $field)
                $model = $model->where($field, "=", $this->$field);

            return $model->count() == 0;

        }

        return true;

    }

    /**
     * Method to check referenced data of an item.
     *
     * @param     mixed      $pk    An primary key value to delete.
     *
     * @return    boolean
     */
    public function getReferenceCount($referenceModel, $foreignKey = "", $id = null)
    {
        $model = new $referenceModel();
        $id = $this->getId($id);
        return $model->withoutGlobalScopes()->where($this->getForeignKey($foreignKey), "=", (int)$id)->count();

    }
}
?>