<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Editors-xtd.pagebreak
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

jimport('FootManager.framework');

/**
 * Editor Pagebreak buton
 *
 * @since  1.5
 */
class PlgFmcontenttemplatesPlanning extends FootManager\Plugin\Contenttemplate
{

    public function onAjaxPlanning() {
        return $this->getFields();
    }

	/**
     * Display the button
     *
     * @param   string  $name  The name of the button to add
     *
     * @return JObject A two element array of (imageName, textToInsert)
     */
	public function onGetButton()
	{
        jimport('FootManager.framework');

        if(!\FootManager\Helpers\Application::enabled("com_fmevents")) return null;

        jimport("FMEvents.library");

        $button = new JObject();
        $button->set("title", "COM_FMEVENTS_PLANNING");
        $button->set("icon", "fa fa-calendar-check-o");
        $button->set("modal", true);
        $button->set("name", "planning");

        return $button;
	}

    protected function getText($key, $field, $params, $data_params) {

        jimport("FMEvents.library");
        switch ($field)
        {
        	case "start_date":
            case "end_date":

                if(isset($data_params[$field])) {
                    if(\FootManager\Utilities\DateHelper::isValid($data_params[$field])) {

                        $date = new JDate($data_params[$field]);
                        $format = JArrayHelper::getValue($params, "format", "l d F");
                        return $date->format($format);
                    }
                }

            case "planning" :
                $start = JArrayHelper::getValue($data_params, "start_date");
                $end = JArrayHelper::getValue($data_params, "end_date");
                $categories = JArrayHelper::getValue($data_params, "categories", array());
                $types = JArrayHelper::getValue($data_params, "types", array());

                $events = \FMEvents\Helper::getEvents($start, $end, $types, $categories);
                $events = $events->events->filter(function($obj) { return $obj->state != \FootManager\Constants::REPORTED && $obj->state != \FootManager\Constants::CANCELLED && $obj->state != \FootManager\Constants::STOPPED; })->groupBy(function($obj) {
                    $date = new JDate($obj->start);
                    return $date->format("l d F");
                });

                ob_start();
                include JPluginHelper::getLayoutPath("fmcontenttemplates", $this->_name, "table");
                $html = ob_get_contents();
                ob_end_clean();
                return $html;

            default:
                return $field;
        }

    }

	public function onContentPrepareForm(JForm $form, $data)
	{
        if($form->getName() == $this->_name) {

            jimport("FMEvents.framework");

            $today = date("Y-m-d");
            $form->setFieldAttribute("start_date", "default", $today);
            $form->setFieldAttribute("end_date", "default", date('Y-m-d', strtotime($today.' + 2 days')));
        }
    }

}