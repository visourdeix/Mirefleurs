<?php
/**
 * @package      FootManager
 * @subpackage   Controllers
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FootManager\Controller;

use Joomla\Utilities\ArrayHelper;
use FootManager\Utilities\StringHelper;

defined('JPATH_PLATFORM') or die;
/**
 * This class contains common methods and properties
 * used in work with ajax actions.
 *
 * @package      FootManager
 * @subpackage   Controllers
 */
abstract class Ajax extends \JControllerLegacy
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
        if($prefix == '')
            $prefix = ucfirst($this->getName())."Model";
        $model = parent::getModel($name, $prefix, $config);
        return $model;
    }

    /**
     * Get the content.
     */
    public function displayContent() {
        $input = \JFactory::getApplication()->input;
		$id = $input->get('id', 0, 'post');
        $params = (array)json_decode(base64_decode($input->get('params', "", 'BASE64')));

        $model_name = $input->get('model', '', 'post', true);
        $model = $this->getModel($model_name);
        if($model instanceof \FootManager\Model\Ajax) {
            $data = $model->getData($id, $params);

            $result = $this->getData($data, $params);
            echo new \JResponseJson($result, null, false, $input->get('ignoreMessages', true, 'bool'));
        } else {
            echo $this->getName();
        }

        exit;
    }

    /**
     * Get the content.
     * @param mixed $data
     * @param mixed $params
     */
    protected abstract function getData($data, $params);

}