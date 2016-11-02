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
class FmmanagerControllerTrainings extends FMManager\Controller\Backend\Events {

    /**
     * Ajoute plusieurs journées dans la compétition
     *
     * @param   string  $key     The name of the primary key of the URL variable.
     * @param   string  $urlVar  The name of the URL variable if different from the primary key (sometimes required to avoid router collisions).
     *
     * @return  boolean  True if successful, false otherwise.
     *
     * @since   12.2
     */
    public function addmultiple()
    {
        // Check for request forgeries
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $data    = $this->input->get('addmultiple', array(), 'array');

        // Get the model.
        $model = $this->getModel();
        $inserted = $model->addmultiple($data);

        $message = "";
        if($inserted > 0) $message = JText::plural('COM_FMMANAGER_MESSAGE_N_TRAININGS_ADDED', $inserted);

        $this->setRedirectUrl(array(), $message);

    }

}