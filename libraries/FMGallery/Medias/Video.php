<?php
/**
 * @package      FootManager
 * @subpackage   Calendar
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FMGallery\Medias;

defined('JPATH_PLATFORM') or die;

class Video extends \FootManager\Medias\Thumbnail{

    public function image($size) {
        return \FMGallery\Helper::getImage($this->_item, $size);
    }

    protected function category() {
        return $this->_item->category->title;
    }

    protected function title() {
        return $this->_item->title;
    }

    protected function subtitle() {
        if(\FootManager\Utilities\DateHelper::isValid($this->_item->date))
        {
            $date = $this->_item->date->format("d M. Y");
            return $date;
        }

        return "";
    }

    protected function url() {
        return \FmgalleryHelperRoute::video($this->_item->id);
    }

    protected function icon() {
        return "play";
    }

    protected function visibleIcon() {
        return "play";
    }

    protected function category_url() {
        $route = $this->_category_type;
        return \FmgalleryHelperRoute::$route($this->_item->catid);
    }
}