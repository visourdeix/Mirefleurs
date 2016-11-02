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
class FmmanagerControllerMatchdays extends FMManager\Controller\Backend\Events
{

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

        $addmultiple    = $this->input->get('addmultiple', array(), 'array');
        $competition    = $this->input->get('competition', 0, 'int');
        $data = json_decode($addmultiple['matchdays'], true);
        $invert_teams = $addmultiple['invert_teams'];
        $message  ="";

        if($competition) {

            // Get the model.
            $model = $this->getModel();
            $errors = $model->addmultiple($data, $competition, $invert_teams);
            $inserted = count($data) - count($errors);

            if($inserted > 0)
                $message = JText::plural('COM_FMMANAGER_MESSAGE_N_MATCHDAYS_ADDED', $inserted);

            if(count($errors) > 0) {
                foreach ($errors as $row => $error)
                {
                    JFactory::getApplication()->enqueueMessage(JText::sprintf("COM_FMMANAGER_ERROR_ON_ROW", $row).' : '.$error, 'error');
                }

            }

        } else {
            JError::raiseWarning(500, JText::_('COM_FMMANAGER_ERROR_NO_COMPETITION_SELECTED'));
        }

        $this->setRedirectUrl(array(), $message);

    }

}