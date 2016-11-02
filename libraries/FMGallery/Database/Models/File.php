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
class File extends Media {

    protected $table = "fmgallery_files";

    /**
     * Get the name.
     * @return string
     */
    public function getDateAttribute()
    {
        if(\FootManager\Utilities\DateHelper::isValid($this->attributes['created'])) return new \JDate($this->attributes['created']);
        return null;
    }

    public function toThumbnail($size, $category_type = "category") {
        return new \FMGallery\Medias\File($this, $size, $category_type);
    }
}

?>