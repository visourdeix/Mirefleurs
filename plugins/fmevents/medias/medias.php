<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Content.Contact
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\Registry\Registry;
jimport("FMGallery.library");

/**
 * Contact Plugin
 *
 * @since  3.2
 */
class PlgFmeventsMedias extends FMGallery\Plugin\Medias
{
    protected function getCategory($context, &$item, &$params) {

        jimport("FMEvents.library");
        $id = 0;

        switch ($context)
        {
            case FM_EVENTS_COMPONENT.".event":
                $id = $item->id;
                break;
        }

        if($id) {
            return FMGallery\Database\Models\Category::where("note", "=", $context.".".$id)->first();
        }

        return null;
    }

    protected function canAddMedias($item, $view) {
        if($view == "event") {
            $actions = \FootManager\Helpers\Access::getActions(FM_GALLERY_COMPONENT);
            return  $actions->get( "core.manage") && $actions->get( "core.create") && $actions->get( "core.edit") && \FootManager\Utilities\DateHelper::isBeforeToday($item->start_date.' '.$item->start_time);
        }
        return false;
    }

    protected function getCategories() {
        jimport("FMEvents.library");

        $input  = \JFactory::getApplication()->input;
        $view = $input->get('view', '', 'string');
        $id = $input->get('id', 0, 'int');

        $categories = array();
        if($view == "event") {
            $class = "\FMEvents\Database\Models\\".ucfirst($view);
            $item = $class::find($id);

            $category = $item->category;

            while ($category->id > 1)
            {
                $categories[] = ["title" => $category->title];

                $category = $category->parent_category;
            }

            $categories = array_reverse($categories);

            $categories[] = ["title" => $item->title, "date" => $item->start_date_time->format("Y-m-d H:i:s"), "data" => array("note" => FM_EVENTS_COMPONENT.".".$view.".".$item->id)];

        }

        return $categories;
    }
}