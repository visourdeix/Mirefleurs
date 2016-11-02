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
class FmmanagerControllerData extends JControllerLegacy
{
    /**
     * Method to get a model object, loading it if required.
     *
     * @param   string  $name    The model name. Optional.
     * @param   string  $prefix  The class prefix. Optional.
     * @param   array   $config  Configuration array for model. Optional.
     *
     * @return  object  The model.
     *
     * @since   12.2
     */
    public function getModel($name = '', $prefix = '', $config = array('ignore_request' => true)) {
        return parent::getModel('Data', 'FmmanagerModel', $config);
    }

    public function getData()
	{
        $input = JFactory::getApplication()->input;
		$data = $input->get('data', '', 'post');
        $function = $input->get('func', '', 'post');

		$return_Data = call_user_func_array(array($this->getModel(), $function), $data);

        //echo the data
        echo new \JResponseJson($return_Data, null, false, $input->get('ignoreMessages', true, 'bool'));
		exit;
	}
}