<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\Registry\Registry;

/**
 * Content Component Article Model
 *
 * @since  1.5
 */
class FmgalleryModelVideo extends FootManager\Model\Item
{
    protected function loadItem($pk) {

        $user = JFactory::getUser();
        $groups = $user->getAuthorisedViewLevels();

        $params = $this->getState("params", array());
        $size = $params->get("thumb_size", "medium");

        $item = new stdClass();
        $item->video = FMGallery\Database\Models\Video::find($pk);
        $item->videos = FMGallery\Database\Models\Video::whereIn("access", $groups)
                                                        ->where("state", "=", 1)
                                                        ->where("catid", "=", $item->video->catid)
                                                        ->where("id", "<>", $item->video->id)
                                                        ->get()
                                                        ->map(function($obj) use($size) { return $obj->toThumbnail($size); });

        $item->categories = \FMGallery\Database\Models\Category::whereIn("access", $groups)
                                                                        ->whereIn("access", $groups)
                                                                        ->where("published", "=", 1)
                                                                        ->where("extension", "=", FM_GALLERY_COMPONENT)
                                                                        ->where("parent_id", "=", $item->video->category->parent_id)
                                                                        ->where("id", "<>", $item->video->catid)
                                                                        ->has("videos")
                                                                        ->get()
                                                                        ->sortMulti(["date", "lft"], [-1, 1])
                                        ->map(function($obj) use($size) { return $obj->toThumbnail($size, "videos"); });

        return $item;
    }
}