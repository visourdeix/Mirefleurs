<?php
/**
 * @package      FMEvents
 * @subpackage   Calendar
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FMGallery\Database\Models;

defined('JPATH_PLATFORM') or die;

use FootManager\Database\Eloquent\Model;

/**
 * This class contains common methods and properties for a database item
 *
 * @package      FMEvents
 * @subpackage   Calendar
 */
class Category extends \FootManager\Database\Models\Category {

    /**
     * Get the name.
     * @return string
     */
    public function getDateAttribute()
    {
        if(isset($this->params['date']) && \FootManager\Utilities\DateHelper::isValid($this->params['date'])) return new \JDate($this->params['date']);
        return null;
    }

    /**
     * Get the name.
     * @return string
     */
    public function getImageAttribute()
    {
        if(isset($this->params['image'])) return $this->params['image'];
        return "";
    }

    /**
     * Get the name.
     * @return string
     */
    public function getFolderAttribute()
    {
        if(isset($this->params['folder'])) return $this->params['folder'];
        return "";
    }

    /**
     * Get the name.
     * @return string
     */
    public function getAllPhotosAttribute()
    {
        return $this->allPhotosQuery()->get();
    }

    /**
     * Get the name.
     * @return string
     */
    public function getAllVideosAttribute()
    {
        return $this->allVideosQuery()->get();
    }

    /**
     * Get the name.
     * @return string
     */
    public function getAllFilesAttribute()
    {
        return $this->allFilesQuery()->get();
    }

    /**
     * Get the name.
     * @return string
     */
    public function getCountAllPhotosAttribute()
    {
        return $this->allPhotosQuery()->count();
    }

    /**
     * Get the name.
     * @return string
     */
    public function getCountAllVideosAttribute()
    {
        return $this->allVideosQuery()->count();
    }

    /**
     * Get the name.
     * @return string
     */
    public function getCountAllFilesAttribute()
    {
        return $this->allFilesQuery()->count();
    }

    /**
     * Get the name.
     * @return string
     */
    public function allPhotosQuery()
    {
        $user = \JFactory::getUser();
        $groups = $user->getAuthorisedViewLevels();

        $lft = $this->lft;
        $rgt = $this->rgt;
        return Photo::withoutGlobalScopes()->whereHas("category", function($query) use($lft, $rgt)  {
            $query->categories($lft, $rgt);
        })
          ->where("state", "=", 1)
          ->whereIn("access", $groups);
    }

    /**
     * Get the name.
     * @return string
     */
    public function allVideosQuery()
    {
        $user = \JFactory::getUser();
        $groups = $user->getAuthorisedViewLevels();

        $lft = $this->lft;
        $rgt = $this->rgt;
        return Video::withoutGlobalScopes()->whereHas("category", function($query) use($lft, $rgt)  {
            $query->categories($lft, $rgt);
        })
          ->where("state", "=", 1)
          ->whereIn("access", $groups);
    }

    /**
     * Get the name.
     * @return string
     */
    public function allFilesQuery()
    {
        $user = \JFactory::getUser();
        $groups = $user->getAuthorisedViewLevels();

        $lft = $this->lft;
        $rgt = $this->rgt;
        return File::withoutGlobalScopes()->whereHas("category", function($query) use($lft, $rgt)  {
            $query->categories($lft, $rgt);
        })
          ->where("state", "=", 1)
          ->whereIn("access", $groups);
    }

    /**
     * Get the events of the location.
     */
    public function subcategories()
    {
        return $this->hasMany(Category::class, "parent_id");
    }

    /**
     * Get the events of the location.
     */
    public function photos()
    {
        return $this->hasMany(Photo::class, "catid");
    }

    /**
     * Get the events of the location.
     */
    public function videos()
    {
        return $this->hasMany(Video::class, "catid");
    }

    /**
     * Get the events of the location.
     */
    public function files()
    {
        return $this->hasMany(File::class, "catid");
    }

    public function toThumbnail($size, $category_type = "category") {
        return new \FMGallery\Medias\Category($this, $size, $category_type);
    }
}

?>