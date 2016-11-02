<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace FMGallery\Model\Frontend;

defined('_JEXEC') or die;

/**
 * Content Component Article Model
 *
 * @since  1.5
 */
class Medias extends \FootManager\Model\Item
{
    protected function loadItem($pk) {
        $params = $this->
getState("params", array());
        $size = $params->get("thumb_size", "small");

        $item = new \stdClass();

        $user = \JFactory::getUser();
        $groups = $user->getAuthorisedViewLevels();

        $countField = "countAll".ucfirst($this->getName());

        $category = \FMGallery\Database\Models\Category::with(["subcategories" => function($query) use($groups) {
                                                                    $query->whereIn("access", $groups)
                                                                        ->where("published", "=", 1)
                                                                        ->where("extension", "=", FM_GALLERY_COMPONENT);
                                                                }])->find($pk);

        $item->category = $category;
        $item->subcategories = $this->loadSubCategories($category->id)
                                                    ->sortMulti(["date", "lft"], [-1, 1])
                                                    ->map(function($obj) use($size) { return $obj->toThumbnail($size, $this->getName()); });
        $item->categories = $this->loadCategories($category->id, $category->parent_id)->sortMulti(["date", "lft"], [-1, 1])
                                        ->map(function($obj) use($size) { return $obj->toThumbnail($size, $this->getName()); });

        return $item;
    }

    protected function loadCategories($id, $parent_id) {

        $user = \JFactory::getUser();
        $groups = $user->getAuthorisedViewLevels();

        return \FMGallery\Database\Models\Category::whereIn("access", $groups)
                                                                        ->whereIn("access", $groups)
                                                                        ->where("published", "=", 1)
                                                                        ->where("extension", "=", FM_GALLERY_COMPONENT)
                                                                        ->where("parent_id", "=", $parent_id)
                                                                        ->where("id", "<>", $id)->get();
    }

    protected function loadSubCategories($id) {

        $user = \JFactory::getUser();
        $groups = $user->getAuthorisedViewLevels();

        return \FMGallery\Database\Models\Category::where("parent_id", "=", $id)
                                                                        ->whereIn("access", $groups)
                                                                        ->where("published", "=", 1)
                                                                        ->where("extension", "=", FM_GALLERY_COMPONENT)
                                                                        ->where("id", "<>", $id)->get();
    }
}