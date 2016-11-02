<?php
/**
 * @package      Fmmanager
 * @subpackage   Positions
 *
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 */

namespace FMGallery\Controller\Backend;

defined('_JEXEC') or die();

/**
 * Positions list controller class.
 *
 */
class Medias extends \FootManager\Controller\Admin
{

    /**
     * Method to publish a list of items
     *
     * @return  void
     *
     * @since   12.2
     */
	public function recreateThumbnails()
	{
		// Check for request forgeries
		\JSession::checkToken() or die(\JText::_('JINVALID_TOKEN'));

		// Get items to publish from the request.
		$cid = \JFactory::getApplication()->input->get('cid', array(), 'array');

		if (empty($cid))
		{
			\JLog::add(\JText::_('COM_FMGALLERY_NO_ITEM_SELECTED'), \JLog::WARNING, 'jerror');
		}
		else
		{
			// Get the model.
			$model = $this->getModel();

			// Make sure the item ids are integers
			\JArrayHelper::toInteger($cid);

			// Publish the items.
			try
			{
				$model->recreateThumbnails($cid);

				$this->setMessage(\JText::_('COM_FMGALLERY_THUMBNAILS_RECREATED'));
			}
			catch (Exception $e)
			{
				$this->setMessage($e->getMessage(), 'error');
			}
		}

		$this->setRedirect(\JRoute::_('index.php?option=' . $this->option . '&view=' . $this->view_list, false));
	}
}