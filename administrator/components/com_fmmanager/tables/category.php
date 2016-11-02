<?php
/**
 * @package     Fmmanager
 * @subpackage  Positions
 *
 * @copyright   Copyright (C) 2015 STéphane ANDRE. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Positions Table.
 *
 */
class FmmanagerTableCategory extends FMManager\Table\Data
{

    function __construct(&$db)
    {
        parent::__construct(FMManager\Database\Models\Category::class ,$db);

        $this->addReferenceIn(FMManager\Database\Models\Tournament::class);
        $this->addReferenceIn(FMManager\Database\Models\Person::class);
        $this->addReferenceIn(FMManager\Database\Models\Team::class);

        $this->addNotEmptyFields("color");

    }

    /**
     * Method to compute the default name of the asset.
     * The default name is in the form table_name.id
     * where id is the value of the primary key of the table.
     *
     * @return  string
     *
     * @since   11.1
     */
	protected function _getAssetName()
	{
		$k = $this->_tbl_key;

		return FM_MANAGER_COMPONENT . '.category.' . (int) $this->$k;
	}

	/**
     * Method to return the title to use for the asset table.
     *
     * @return  string
     *
     * @since   11.1
     */
	protected function _getAssetTitle()
	{
		return $this->label;
	}

	/**
     * We provide our global ACL as parent
     * @see JTable::_getAssetParentId()
     */
	protected function _getAssetParentId(JTable $table = NULL, $id = NULL)
	{
		$asset = JTable::getInstance('Asset');
		$asset->loadByName(FM_MANAGER_COMPONENT);
		return $asset->id;
	}
    /**
     * Overloaded bind function.
     *
     * @param   array   $array   named array
     * @param   string  $ignore  An optional array or space separated list of properties
     *                           to ignore while binding.
     *
     * @return  mixed   Null if operation was satisfactory, otherwise returns an error
     *
     * @see     JTable::bind()
     * @since   11.1
     */
	public function bind($array, $ignore = '')
	{
		// Bind the rules.
		if (isset($array['rules']) && is_array($array['rules']))
		{
			$rules = new JAccessRules($array['rules']);
			$this->setRules($rules);
		}

		return parent::bind($array, $ignore);
	}

}
?>