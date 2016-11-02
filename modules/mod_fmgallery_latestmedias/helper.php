<?php
/**
 * @package     mod_fmgallery_latestmedias
 * @subpackage  helper.php
 *
 * @copyright   Copyright (C) 2016 Stéphane ANDRE. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Helper for mod_fmgallery_latestmedias.
 *
 */
abstract class ModFmgalleryLatestmediasHelper
{
    /**
     * Get the data to load.
     *
     * @param   array  $params  The module parameters.
     *
     * @return  mixed  data to load.
     */
	public static function getData($params)
	{

        $return = new stdClass();
        $rootCategory = JArrayHelper::getValue($params, "category", 108);
        $searchInSubCategories = JArrayHelper::getValue($params, "search_in_sub_categories", true);
        $typeSearched = JArrayHelper::getValue($params, "type_searched", "photos");
        $toDisplay = JArrayHelper::getValue($params, "to_display", "items");
        $nbItemsToDisplay =  JArrayHelper::getValue($params, "nb_items_to_display", 10);
        $nbSubItemsToDisplay = JArrayHelper::getValue($params, "nb_sub_items_to_display", 10);
        $size = JArrayHelper::getValue($params, "thumb_size", "medium");
        $show_category = JArrayHelper::getValue($params, "show_category", true);
        $show_title = JArrayHelper::getValue($params, "show_title", true);
        $show_subtitle = JArrayHelper::getValue($params, "show_subtitle", true);

        $category = FMGallery\Database\Models\Category::find($rootCategory);
        $medias = array();
        $user = JFactory::getUser();
        $groups = $user->getAuthorisedViewLevels();

        switch ($toDisplay)
        {
            // category with subitems
        	case "categories_with_sub_items":
                if($searchInSubCategories) {
                    $categories = FMGallery\Database\Models\Category::where('lft', ">=", (int)$category->lft)->where('rgt', "<=", (int)$category->rgt);
                } else {
                    $categories = FMGallery\Database\Models\Category::where("parent_id", "=", $rootCategory);
                }
                    
                $categories = $categories->whereIn("access", $groups)
                                 ->where("published", "=", 1)
                                 ->has($typeSearched)
                                 ->orderBy("created_time", "desc")
                                 ->with([ $typeSearched => function ($query) use($groups, $nbSubItemsToDisplay) {
                                            $query->whereIn("access", $groups)
                                            ->where("state", "=", 1)
                                            ->orderBy("created", "desc");
                                            }, "parent_category"])
                                 ->take($nbItemsToDisplay)
                                 ->get();

                foreach ($categories as $cat)
                {
                    $result = new stdClass();
                    $result->category = $cat;
                    $result->thumbnails = $cat->$typeSearched->slice(0, $nbSubItemsToDisplay)->map(function($obj) use($size, $typeSearched, $show_category, $show_subtitle, $show_title) {
                                                                    $thumbnail = $obj->toThumbnail($size, $typeSearched);
                                                                    if(!$show_category) $thumbnail->category = "";
                                                                     if(!$show_subtitle) $thumbnail->subtitle = "";
                                                                      if(!$show_title) $thumbnail->title = "";
                                                                      if($typeSearched == "photos") $thumbnail->url = $thumbnail->category_url;
                                                                    return $thumbnail;
                                                                });

                    $medias[] = $result;
                }

                break;

            // items
            case "items":
                $type = "FMGallery\Database\Models\\".ucfirst(FootManager\Utilities\StringHelper::singularize($typeSearched));
                if($searchInSubCategories) {
                    $medias = $type::whereHas("category", function ($query) use($category) {
                                          $query->where('lft', ">=", (int)$category->lft)->where('rgt', "<=", (int)$category->rgt);
                                     });
                } else {
                    $medias = $type::where("catid", "=", $rootCategory);
                }

                $medias = $medias->whereIn("access", $groups)
                                 ->where("state", "=", 1)
                                 ->orderBy("created", "desc")
                                 ->take($nbItemsToDisplay)
                                 ->get()
                                 ->map(function($obj) use($size, $typeSearched, $show_category, $show_subtitle, $show_title) {
                                        $thumbnail = $obj->toThumbnail($size, $typeSearched);
                                        if(!$show_category) $thumbnail->category = "";
                                         if(!$show_subtitle) $thumbnail->subtitle = "";
                                          if(!$show_title) $thumbnail->title = "";
                                          if($typeSearched == "photos") $thumbnail->url = $thumbnail->category_url;
                                        return $thumbnail;
                                    });
                break;

            // category
            default:
                if($searchInSubCategories) {
                    $category = FMGallery\Database\Models\Category::find($rootCategory);
                    $medias = FMGallery\Database\Models\Category::where('lft', ">=", (int)$category->lft)->where('rgt', "<=", (int)$category->rgt);
                } else {
                    $medias = FMGallery\Database\Models\Category::where("parent_id", "=", $rootCategory);
                }

                $medias = $medias->whereIn("access", $groups)
                                 ->where("published", "=", 1)
                                 ->with("parent_category")
                                 ->has($typeSearched)
                                 ->orderBy("created_time", "desc")
                                 ->take($nbItemsToDisplay)
                                 ->get()
                                 ->map(function($obj) use($size, $typeSearched, $show_category, $show_subtitle, $show_title) {
                                        $thumbnail = $obj->toThumbnail($size, $typeSearched);
                                        if(!$show_category) $thumbnail->category = "";
                                         if(!$show_subtitle) $thumbnail->subtitle = "";
                                          if(!$show_title) $thumbnail->title = "";
                                          $thumbnail->visibleMask = "";
                                        return $thumbnail;
                                    });

        }

        $return->category = $category;
        $return->medias = $medias;
		return $return;
	}

}