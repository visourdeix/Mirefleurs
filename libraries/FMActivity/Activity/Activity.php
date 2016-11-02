<?php
/**
 * @package      FootManager
 * @subpackage   Calendar
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FMActivity\Activity;

defined('JPATH_PLATFORM') or die;

class Activity {

    protected $_activity;
    protected $_item;
    protected $_type;
    protected $_event;
    protected $_client_id;

    /**
     * Constructor
     *
     */
    public function __construct($activity)
    {
        $this->_client_id = (\JFactory::getApplication()->isAdmin() ? 1 : 0);
        $this->_activity = $activity;
        $this->_item = $activity->item;
        $this->_type = $activity->item->type;
        $this->_event = $activity->event;

        list($group, $plg) = explode(".", $this->_type->plugin);
        \JFactory::getLanguage()->load("plg_".$group."_".$plg, JPATH_ADMINISTRATOR);
        \JFactory::getLanguage()->load($this->_type->extension);
    }

    public function extension() {
        return \JText::_(strtoupper($this->_type->extension));
    }

    public function view() {
        list($group, $plg) = explode(".", $this->_type->plugin);
        return \JText::_("PLG_".strtoupper($group)."_".strtoupper($plg)."_".strtoupper($this->_type->name));
    }

    public function date() {

        if(\FootManager\Utilities\DateHelper::isValid($this->_activity->date)) {
            $date = new \JDate(($this->_activity->date));
            return $date;
        }

        return $this->created;

    }

    public function created() {
        return new \JDate($this->_activity->created);
    }

    public function title() {
        return $this->_item->title;
    }

    public function description() {
        return $this->_item->description;
    }

    public function color() {
        if(isset($this->_item->metadata["color"])) {
            return $this->_item->metadata["color"];
        }

        return "#333";

    }

    public function category() {
        return $this->_item->category;
    }

    public function icon() {
        if(isset($this->_item->metadata["icon"])) {
            return $this->_item->metadata["icon"];
        }

        return "rss";

    }

    public function image() {
        if(isset($this->_item->metadata["image"])) {
            return $this->_item->metadata["image"];
        }

        return "";

    }

    public function header() {
        if($this->image)
            return \FootManager\Utilities\ImageHelper::render($this->image, array(), false);
        elseif($this->icon)
            return '<span class="fm-bull fm-bull-light-gray"><i class="fa fa-'.$this->icon.'"></i></span>';

        return "";

    }

    public function text() {
        if($this->_client_id == 1) {
            return $this->adminText;
        } else {
            return $this->siteText;
        }
    }

    public function adminText() {
        $userLink = $this->userLink ? '<a href="'.$this->userLink.'" target="_blank">'.$this->created_user->name.'</a>' : $this->created_user->name;
        $titleLink = $this->userLink ? '<a href="'.$this->itemLink.'" target="_blank">'.$this->title.($this->description ? ' ('.$this->description.')' : '').'</a>' : $this->title;
        return \JText::sprintf("COM_FMACTIVITY_".strtoupper($this->_event->name), $userLink, $titleLink);
    }

    public function siteText() {
        return $this->title;
    }

    public function userLink() {
        return 'index.php?option=com_users&'
                  . ($this->_client_id ? 'task=user.edit' : 'view=profile')
                  . '&id=' . (int) $this->_activity->created_by;
    }

    public function itemLink() {
        if($this->_client_id == 1) {
            return ($this->_activity->event_id != \FMActivity\Constants::DELETE) ? 'index.php?option=' . $this->_type->extension . '&task=' . $this->_type->name . '.edit&id=' . (int) $this->_item->item_id : "";
        }

        return "";
    }

    public function __get($name) {

        if(method_exists($this, $name)) {
            return $this->$name();
        }

        return $this->_activity->$name;
    }
}