<?php
/**
 * @package      com_fmevents.administrator
 * @subpackage   Controllers
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

defined('JPATH_PLATFORM') or die;

/**
 * This class contains common methods and properties
 * used in work with forms on the back-end.
 *
 * @package      com_fmevents.administrator
 * @subpackage   Controllers
 */
class FmactivityControllerActivities extends FootManager\Controller\Admin
{

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

		$this->registerTask('unfeatured', 'featured');
	}

    /**
     * Method to toggle the featured setting of a list of articles.
     *
     * @return  void
     *
     * @since   1.6
     */
	public function featured()
	{
		// Check for request forgeries
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		$user   = JFactory::getUser();
		$ids    = $this->input->get('cid', array(), 'array');
		$values = array('featured' => 1, 'unfeatured' => 0);
		$task   = $this->getTask();
		$value  = JArrayHelper::getValue($values, $task, 0, 'int');

		// Access checks.
		foreach ($ids as $i => $id)
		{
			if (!$user->authorise('core.edit.state'))
			{
				// Prune items that you can't change.
				unset($ids[$i]);
				JError::raiseNotice(403, JText::_('JLIB_APPLICATION_ERROR_EDITSTATE_NOT_PERMITTED'));
			}
		}

		if (empty($ids))
		{
			JError::raiseWarning(500, JText::_('JERROR_NO_ITEMS_SELECTED'));
		}
		else
		{
			// Get the model.
			$model = $this->getModel();

			// Publish the items.
			if (!$model->featured($ids, $value))
			{
				JError::raiseWarning(500, $model->getError());
			}

			if ($value == 1)
			{
				$message = JText::plural('COM_FMACTIVITY_N_ITEMS_FEATURED', count($ids));
			}
			else
			{
				$message = JText::plural('COM_FMACTIVITY_N_ITEMS_UNFEATURED', count($ids));
			}
		}

        $this->setRedirect(JRoute::_('index.php?option=com_fmactivity&view=activities', false), $message);
	}

}