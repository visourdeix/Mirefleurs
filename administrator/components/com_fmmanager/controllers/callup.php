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
class FmmanagerControllerCallup extends FootManager\Controller\Form\Backend
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
     * Gets the URL arguments to append to an item redirect.
     *
     * @param   integer  $recordId  The primary key id for the item.
     * @param   string   $urlVar    The name of the URL variable for the id.
     *
     * @return  string  The arguments to append to the redirect URL.
     *
     * @since   12.2
     */
    protected function getRedirectToItemAppend($recordId = null, $urlVar = 'id') {
        $append = parent::getRedirectToItemAppend($recordId, $urlVar);

        $return = $this->input->get("type", null, 'base64');

        if(!empty($return)) {
            $append .= "&type=".$return;
        }

        $return = $this->input->get("event_id", 0, 'int');

        if(!empty($return)) {
            $append .= "&event_id=".$return;
        }

		return $append;
    }

}