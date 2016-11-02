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
class Events extends \FootManager\Controller\Admin {

    /**
     * Constructor.
     *
     * @param   array  $config  An optional associative array of configuration settings.
     *
     * @see     JController
     * @since   1.6
     */
	public function __construct($config = array())
	{
		parent::__construct($config);

		$this->registerTask('inactive', 'changeState');
        $this->registerTask('active', 'changeState');
        $this->registerTask('report', 'changeState');
        $this->registerTask('cancelEvent', 'changeState');
	}

    /**
     * Method to toggle the featured setting of a list of articles.
     *
     * @return  void
     *
     * @since   1.6
     */
	public function changeState()
	{

		// Check for request forgeries
		\JSession::checkToken() or jexit(\JText::_('JINVALID_TOKEN'));

		$message = "";
		$ids    = $this->input->get('cid', array(), 'array');
		$values = array('inactive' => FM_NOT_PLAYED, 'active' => FM_PLAYED, 'report' => FM_REPORTED, 'cancelEvent' => FM_CANCELLED, 'stop' => FM_STOPPED);
		$task   = $this->getTask();
		$value  = \JArrayHelper::getValue($values, $task, 0, 'int');

		if (empty($ids))
		{
			\JError::raiseWarning(500, \JText::_('JERROR_NO_ITEMS_SELECTED'));
		}
		else
		{
			// Get the model.
			$model = $this->getModel();

			// Publish the items.
			if (!$model->$task($ids, $value))
			{
				\JError::raiseWarning(500, $model->getError());
			}

            $message = \JText::plural('COM_FMMANAGER_MESSAGE_N_ITEMS_UPDATED', count($ids));
		}

        $this->setRedirectUrl(array(), $message);
	}
}