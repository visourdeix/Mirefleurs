<?php
/**
 * @package     Fmmanager
 * @subpackage  Position
 *
 * @copyright   Copyright (C) 2015 STéphane ANDRE. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace FMManager\Model\Backend;

defined('_JEXEC') or die;

/**
 * Methods supporting a list of positions records.
 *
 */
abstract class Event extends \FootManager\Model\Admin
{

    /**
     * Method to invertTeam in the form data.
     *
     * @param   array  $data  The form data.
     *
     * @return  boolean  True on success, False on error.
     *
     * @since   12.2
     */
	public function deleteCallUp($event_id)
	{
        return $this->action($event_id, 'deleteCallUp');
    }

    /**
     * Method to invertTeam in the form data.
     *
     * @param   array  $data  The form data.
     *
     * @return  boolean  True on success, False on error.
     *
     * @since   12.2
     */
	public function report($event_id)
	{
        return $this->action($event_id, 'report');
    }

    /**
     * Method to invertTeam in the form data.
     *
     * @param   array  $data  The form data.
     *
     * @return  boolean  True on success, False on error.
     *
     * @since   12.2
     */
	public function cancelEvent($event_id)
	{
        return $this->action($event_id, 'cancel');
    }

    /**
     * Method to invertTeam in the form data.
     *
     * @param   array  $data  The form data.
     *
     * @return  boolean  True on success, False on error.
     *
     * @since   12.2
     */
	public function active($event_id)
	{
        return $this->action($event_id, 'active');
    }

    /**
     * Method to invertTeam in the form data.
     *
     * @param   array  $data  The form data.
     *
     * @return  boolean  True on success, False on error.
     *
     * @since   12.2
     */
	public function inactive($event_id)
	{
        return $this->action($event_id, 'inactive');
    }

}