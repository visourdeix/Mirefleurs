<?php
/**
 * @package      Fmmanager
 * @subpackage   Positions
 *
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 */

namespace FMManager\Controller\Backend;

defined('_JEXEC') or die();

/**
 * Positions list controller class.
 *
 */
abstract class Event extends \FootManager\Controller\Form
{

    /**
     * Method to delete callup.
     *
     * @param   string  $key     The name of the primary key of the URL variable.
     * @param   string  $urlVar  The name of the URL variable if different from the primary key (sometimes required to avoid router collisions).
     *
     * @return  boolean  True if successful, false otherwise.
     *
     * @since   12.2
     */
	protected function _deleteCallUp()
	{
        $model = $this->getModel();
        $table = $model->getTable();

        $recordId = $this->input->getInt($table->getKeyName(), 0);

        // Attempt to save the data.
        if(!$model->deleteCallUp($recordId)) {
            $this->setError(\JText::sprintf('JLIB_APPLICATION_ERROR_SAVE_FAILED', $model->getError()));
            return false;
        } else {
            return true;
        }
    }

    /**
     * Method to invert teams
     *
     * @param   string  $key     The name of the primary key of the URL variable.
     * @param   string  $urlVar  The name of the URL variable if different from the primary key (sometimes required to avoid router collisions).
     *
     * @return  boolean  True if successful, false otherwise.
     *
     * @since   12.2
     */
	public function deleteCallUp()
	{

        $return = $this->getReturnPage();

        if(!empty($return))
            $this->setRedirect($return);

        if(!$this->_deleteCallUp()) {
            $this->setMessage($this->getError(), 'error');
            return false;
        }

        $this->setMessage(\JText::_('JLIB_APPLICATION_SAVE_SUCCESS'));
        return true;

    }

    /**
     * Method to invert teams
     *
     * @param   string  $key     The name of the primary key of the URL variable.
     * @param   string  $urlVar  The name of the URL variable if different from the primary key (sometimes required to avoid router collisions).
     *
     * @return  boolean  True if successful, false otherwise.
     *
     * @since   12.2
     */
	public function applyAndDeleteCallUp($key = null, $urlVar = null)
	{
        $this->task = 'apply';
        if(!parent::save($key, $urlVar) || !$this->_deleteCallUp()) {
            $this->setMessage($this->getError(), 'error');
            return false;
        }

        return true;

    }

    /**
     * Method to invert teams
     *
     * @param   string  $key     The name of the primary key of the URL variable.
     * @param   string  $urlVar  The name of the URL variable if different from the primary key (sometimes required to avoid router collisions).
     *
     * @return  boolean  True if successful, false otherwise.
     *
     * @since   12.2
     */
	protected function _report()
	{
        $model = $this->getModel();
        $table = $model->getTable();

        $recordId = $this->input->getInt($table->getKeyName(), 0);

        // Attempt to save the data.
        if(!$model->report($recordId)) {
            $this->setError(\JText::sprintf('JLIB_APPLICATION_ERROR_SAVE_FAILED', $model->getError()));
            return false;
        } else {
            return true;
        }
    }

    /**
     * Method to invert teams
     *
     * @param   string  $key     The name of the primary key of the URL variable.
     * @param   string  $urlVar  The name of the URL variable if different from the primary key (sometimes required to avoid router collisions).
     *
     * @return  boolean  True if successful, false otherwise.
     *
     * @since   12.2
     */
	public function report()
	{

        $return = $this->getReturnPage();

        if(!empty($return))
            $this->setRedirect($return);

        if(!$this->_report()) {
            $this->setMessage($this->getError(), 'error');
            return false;
        }

        $this->setMessage(\JText::_('JLIB_APPLICATION_SAVE_SUCCESS'));
        return true;

    }

    /**
     * Method to invert teams
     *
     * @param   string  $key     The name of the primary key of the URL variable.
     * @param   string  $urlVar  The name of the URL variable if different from the primary key (sometimes required to avoid router collisions).
     *
     * @return  boolean  True if successful, false otherwise.
     *
     * @since   12.2
     */
	protected function _cancelEvent()
	{
        $model = $this->getModel();
        $table = $model->getTable();

        $recordId = $this->input->getInt($table->getKeyName(), 0);

        // Attempt to save the data.
        if(!$model->cancelEvent($recordId)) {
            $this->setError(\JText::sprintf('JLIB_APPLICATION_ERROR_SAVE_FAILED', $model->getError()));
            return false;
        } else {
            return true;
        }
    }

    /**
     * Method to invert teams
     *
     * @param   string  $key     The name of the primary key of the URL variable.
     * @param   string  $urlVar  The name of the URL variable if different from the primary key (sometimes required to avoid router collisions).
     *
     * @return  boolean  True if successful, false otherwise.
     *
     * @since   12.2
     */
	public function cancelEvent()
	{

        $return = $this->getReturnPage();

        if(!empty($return))
            $this->setRedirect($return);

        if(!$this->_cancelEvent()) {
            $this->setMessage($this->getError(), 'error');
            return false;
        }

        $this->setMessage(\JText::_('JLIB_APPLICATION_SAVE_SUCCESS'));
        return true;

    }

}