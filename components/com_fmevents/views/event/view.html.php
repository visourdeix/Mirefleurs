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
class FmeventsViewEvent extends FootManager\View\Item
{

    protected function getDescription() {
        return JText::sprintf('COM_FMEVENTS_DESCRIPTION_EVENT', $this->item->title);
    }

    protected function getItemTitle() {
        return $this->item->title;
    }

    protected function getPathway() {

        $category = $this->item->category;

        $path = array();

        while ($category->id > 1)
        {
            if(!isset($this->menu->query["id"]) || $category->id != $this->menu->query["id"])
                $path[] = array('title' => $category->title, 'link' => "");
            $category = $category->parent_category;
        }

        $path = array_reverse($path);

        return $path;

    }

}