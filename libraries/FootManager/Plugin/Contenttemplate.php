<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Editors-xtd.pagebreak
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace FootManager\Plugin;

defined('_JEXEC') or die;

use Joomla\Registry\Registry;

/**
 * Editor Pagebreak buton
 *
 * @since  1.5
 */
abstract class Contenttemplate extends \JPlugin
{

    public abstract function onGetButton();

    protected abstract function getText($key, $field, $params, $data_params);

    protected function getFields() {

        $this->loadLanguage();

        $input = \JFactory::getApplication()->input;
        $data_params = $input->get('params', '', 'ARRAY');

        $plg_params = new \Joomla\Registry\Registry($this->params);
        $fields =  $plg_params->toObject()->data;
        $return = new \stdClass();

        foreach ($fields as $key => $value)
        {
            if(is_string($value)) {
                if($value !== "" && $value !== "-3")
                    $return->$key = $this->getNewText($key, $value, $data_params);
            } else {
                if(!empty($value))
                    $return->$key = $value;
            }

        }

        return $return;
    }

    private function getNewText($key, $text, $data_params) {
        $new_text = $text;

        $results = array();
        $regex = "/\[\[(\w+)(\{[^\[\[]+\})?\]\]/";
        preg_match_all($regex, $text, $results, PREG_SET_ORDER);

        foreach ($results as $result) {
            $field = $result[1];
            $params = array();

            if (isset($result[2])) {
                $param_results = array();
                preg_match_all('/(\w+)=([\w|\-|:|\s]+)/', $result[2], $param_results, PREG_SET_ORDER);
                foreach ($param_results as $param_result) {
                    $params[$param_result[1]] = $param_result[2];
                }
            }
            $replaced_text = $this->getText($key, $field, $params ,$data_params);

            $new_text = preg_replace($regex, $replaced_text, $new_text, 1);
        }
        return $new_text;
    }

}