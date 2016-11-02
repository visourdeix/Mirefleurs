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
abstract class Item extends \JModelItem
{

	/**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @since   1.6
     *
     * @return void
     */
	protected function populateState()
	{
		$app = \JFactory::getApplication('site');

        // Load state from the request.
		$pk = $app->input->getInt('id', 0);
		$this->setState($this->getName().'.id', $pk);

		// Load the parameters.
		$params = $app->getParams();
		$this->setState('params', $params);
	}

	/**
     * Method to get article data.
     *
     * @param   integer  $pk  The id of the article.
     *
     * @return  mixed  Menu item data object on success, false on failure.
     */
	public function getItem($pk = null)
	{
		$pk = (!empty($pk)) ? $pk : (int) $this->getState($this->getName().'.id', 0);

		if ($this->_item === null)
		{
			$this->_item = array();
		}

		if (!isset($this->_item[$pk]))
		{
			try
			{
                $data = $this->loadItem($pk);
                $data->params = clone $this->getState('params');

                if(isset($data->attribs)) {

                    // Convert parameter fields to objects.
                    $registry = new \Joomla\Registry\Registry($data->attribs);
                    $data->params->merge($registry);

                }

				if (empty($data))
				{
					return \JError::raiseError(404, \JText::_('FMLIB_ERROR_ITEM_NOT_FOUND'));
				}

				$this->_item[$pk] = $data;
			}
			catch (Exception $e)
			{
				if ($e->getCode() == 404)
				{
					// Need to go thru the error handler to allow Redirect to work.
					\JError::raiseError(404, $e->getMessage());
				}
				else
				{
					$this->setError($e->message);
					$this->_item[$pk] = false;
				}
			}
		}

		return $this->_item[$pk];
	}

    /**
     * Load the item.
     * @param mixed $pk
     */
    protected abstract function  loadItem($pk);

}