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
class FmmanagerControllerMatchday extends FMManager\Controller\Backend\Event
{

    /**
     * Method to add a new menu item.
     *
     * @return  mixed  True if the record can be added, a JError object if not.
     *
     * @since   1.6
     */
	public function add()
	{
		$app = JFactory::getApplication();

		$result = parent::add();

		if ($result)
		{

			$competition = $app->getUserStateFromRequest($this->context . '.competition', 'competition', 0, int);

            $this->setRedirectUrl(array("competition" => $competition), $message);
			$this->setRedirect(JRoute::_('index.php?option='.FM_MANAGER_COMPONENT.'&view=matchday&competition=' . $competition . $this->getRedirectToItemAppend(), false));
		}

		return $result;
	}

	/**
     * Method to save a record.
     *
     * @param   string  $key     The name of the primary key of the URL variable.
     * @param   string  $urlVar  The name of the URL variable if different from the primary key (sometimes required to avoid router collisions).
     *
     * @return  boolean  True if successful, false otherwise.
     *
     * @since   12.2
     */
	public function save($key = null, $urlVar = null)
	{
		$app = JFactory::getApplication();
        $task = $this->getTask();

		if (!parent::save() || $task == "save2new")
		{

			$competition = $app->getUserStateFromRequest($this->context . '.competition', 'competition', 0, int);

            if($competition) $this->setRedirectUrl(array("competition" => $competition), $message);

            return false;
		}

		return true;
	}

}