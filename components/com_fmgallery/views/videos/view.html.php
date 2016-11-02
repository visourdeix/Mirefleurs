<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * HTML Article View class for the Content component
 *
 * @since  1.5
 */
class FmgalleryViewVideos extends FootManager\View\Item
{

    protected function getDescription() {
        return JText::sprintf('COM_FMGALLERY_DESCRIPTION_VIDEOS', $this->item->category->title);
    }

    protected function getItemTitle() {
        return $this->item->category->title;
    }

    protected function getItemPageTitle() {
        return JText::_("COM_FMGALLERY_VIDEOS")." - ".parent::getItemPageTitle();
    }

    protected function getPathway() {

        $category = $this->item->category->parent_category;
        $path = array();
        $route = $this->getName();

        if($category) {
            while ($category->id > 1)
            {
                if(!isset($this->menu->query["id"]) || $category->id != $this->menu->query["id"])
                    $path[] = array('title' => $category->title, 'link' => FmgalleryHelperRoute::$route($category->id));
                $category = $category->parent_category;
            }

            $path = array_reverse($path);
        }

        return $path;

    }
}