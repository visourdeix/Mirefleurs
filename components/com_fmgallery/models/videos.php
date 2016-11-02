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
class FmgalleryModelVideos extends FMGallery\Model\Frontend\Medias
{
    protected function loadItem($pk) {
        $item = parent::loadItem($pk);

        $user = JFactory::getUser();
        $groups = $user->
getAuthorisedViewLevels();
        $item->videos = FMGallery\Database\Models\Video::where("catid", "=", $item->category->id)
                                                        ->whereIn("access", $groups)
                                                        ->where("state", "=", 1)
                                                        ->get()
                                                        ->map(function($obj) { return $obj->toThumbnail("medium"); });

        return $item;
    }

    protected function loadCategories($id, $parent_id) {
        return parent::loadCategories($id, $parent_id)->filter(function ($obj) { return $obj->countAllVideos > 0; });
    }

    protected function loadSubCategories($id) {
        return parent::loadSubCategories($id)->filter(function ($obj) { return $obj->countAllVideos > 0; });
    }
}