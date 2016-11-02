<?php
/**
 * @package      Fmmanager
 * @subpackage   Positions
 *
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 */

defined('_JEXEC') or die();

/**
 * Positions list controller class.
 *
 */
class FmmanagerControllerMatch extends FMManager\Controller\Backend\Event
{

    /**
     * Constructor.
     *
     * @param   array  $config  An optional associative array of configuration settings.
     *
     * @see     JControllerLegacy
     * @since   12.2
     * @throws  Exception
     */
	public function __construct($config = array())
	{
        parent::__construct($config);
        $this->view_list = "dashboard";
    }

    /**
     * Method to add a new menu item.
     *
     * @return  mixed  True if the record can be added, a JError object if not.
     *
     * @since   1.6
     */
	public function add()
	{
		return false;
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
	public function saveOnAjax()
	{
        $input = JFactory::getApplication()->input;
		$data = $input->get('matches', array(), 'post');
        
        $unsaved = $this->getModel()->saveMatches($data);
        $message = array();

		if(count($unsaved) == 0) {
            $message["class"] = "success";
            $message["message"] = JText::sprintf("COM_FMMANAGER_MESSAGE_N_MATCHES_SAVED", count($data));
        } else {
            $message["class"] = "error";
            if(JDEBUG) {
                $message["message"] = JText::sprintf("COM_FMMANAGER_MESSAGE_MATCHES_NOT_SAVED", implode(" - ", (array)$unsaved));
            } else
                $message["message"] = JText::sprintf("COM_FMMANAGER_MESSAGE_N_MATCHES_NOT_SAVED", count($unsaved));

            foreach ($unsaved as $key => $mes)
            	$message["message"] .= "<br />".$key." : ".$mes;

        }

        //echo the data
		echo json_encode((array)$message);
		exit;
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
	protected function _invertTeams()
	{
        $model = $this->getModel();
        $table = $model->getTable();

        $recordId = $this->input->getInt($table->getKeyName());

        // Attempt to save the data.
        if(!$model->invertTeams($recordId)) {
            $this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_SAVE_FAILED', $model->getError()));
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
	public function invertTeams()
	{

        $return = $this->getReturnPage();

        if(!empty($return))
            $this->setRedirect($return);

        if(!$this->_invertTeams()) {
            $this->setMessage($this->getError(), 'error');
            return false;
        }
        
        $this->setMessage(JText::_('JLIB_APPLICATION_SAVE_SUCCESS'));
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
	public function applyAndInvertTeams($key = null, $urlVar = null)
	{
        $this->task = 'apply';
        if(!parent::save($key, $urlVar) || !$this->_invertTeams()) {
            $this->setMessage($this->getError(), 'error');
            return false;
        }

        return true;

    }

}