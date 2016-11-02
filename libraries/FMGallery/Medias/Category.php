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

class Category extends \FootManager\Medias\Thumbnail {

    public function image($size) {

        if($this->_item->image && \JFile::exists(JPATH_ROOT.DS.$this->_item->image)) return $this->_item->image;

        $countPhotos = $this->_item->countAllPhotos;

        if($countPhotos) {
            $random = rand(0, $countPhotos - 1);
            $photo = $this->_item->allPhotosQuery()->offset($random)->first();
        } else {
            $photo = null;
        }

        return \FMGallery\Helper::getImage($photo, $size);

    }

    protected function category() {
        if($this->_item->parent_id > 1)
            return $this->_item->parent_category->title;

        return "";
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

    protected function visibleMask() {

        $type = ucfirst($this->_category_type);

        $counts = [];

        if($type == "category") {
            if( $this->_item->countAllPhotos) $counts[] = \JText::sprintf("COM_FMGALLERY_N_PHOTOS", $this->_item->countAllPhotos);
            if($this->_item->countAllVideos) $counts[] = \JText::sprintf("COM_FMGALLERY_N_VIDEOS", $this->_item->countAllVideos);
            if($this->_item->countAllFiles) $counts[] = \JText::sprintf("COM_FMGALLERY_N_FILES", $this->_item->countAllFiles);
        } else {
            $countField = "countAll".$type;
            $counts[] = \JText::sprintf("COM_FMGALLERY_N_".strtoupper($type), $this->_item->$countField);
        }
        return "<h2>".implode(" - ", $counts)."</h2>";
    }

    protected function url() {
        $route = $this->_category_type;
        return \FmgalleryHelperRoute::$route($this->_item->id);
    }

    protected function category_url() {
        $route = $this->_category_type;
        return \FmgalleryHelperRoute::$route($this->_item->parent_id);
    }

}