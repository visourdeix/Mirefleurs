<?php
/**
 * @package      Fmmanager
 * @subpackage   com_fmmanager
 *
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 */

defined('_JEXEC') or die();

/**
 * List controller class.
 *
 */
class FmmanagerControllerPersons extends FootManager\Controller\Admin {
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

		$this->registerTask('inactive', 'active');
	}

    /**
     * Method to toggle the featured setting of a list of articles.
     *
     * @return  void
     *
     * @since   1.6
     */
	public function active()
	{

		// Check for request forgeries
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		$user   = JFactory::getUser();
		$ids    = $this->input->get('cid', array(), 'array');
		$values = array('active' => 1, 'inactive' => 0);
		$task   = $this->getTask();
		$value  = JArrayHelper::getValue($values, $task, 0, 'int');
        $message = "";

		if (empty($ids))
		{
			JError::raiseWarning(500, JText::_('JERROR_NO_ITEMS_SELECTED'));
		}
		else
		{
			// Get the model.
			$model = $this->getModel();

			// Publish the items.
			if (!$model->active($ids, $value))
			{
				JError::raiseWarning(500, $model->getError());
			}

			if ($value == 1)
			{
				$message = JText::plural('COM_FMMANAGER_MESSAGE_N_ITEMS_ACTIVED', count($ids));
			}
			else
			{
				$message = JText::plural('COM_FMMANAGER_MESSAGE_N_ITEMS_INACTIVED', count($ids));
			}
		}

        $this->setRedirectUrl(array(), $message);
	}
}