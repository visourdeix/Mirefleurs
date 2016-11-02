<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Content.Contact
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
jimport("FMGallery.library");

use Joomla\Registry\Registry;

/**
 * Contact Plugin
 *
 * @since  3.2
 */
class PlgFmmanagerMedias extends \FMGallery\Plugin\Medias
{
    protected function getCategory($context, &$item, &$params) {

        jimport("FMManager.library");
        $id = 0;

        switch ($context)
        {
            case FM_MANAGER_COMPONENT.".match":
                $id = $item->id;
                break;

            case FM_MANAGER_COMPONENT.".matchday":
                $id = $item->matchday->id;
                break;

        }

        if($id) {
            return FMGallery\Database\Models\Category::where("note", "=", $context.".".$id)->first();
        }

        return null;
    }

    protected function canAddMedias($item, $view) {
        if($view == "match" || $view == "matchday") {
            $by_match = $item->competition->tournament->type->by_match;
            $actions = \FootManager\Helpers\Access::getActions(FM_GALLERY_COMPONENT);
            return  $actions->get( "core.manage") && $actions->get( "core.create") && $actions->get( "core.edit") && \FootManager\Utilities\DateHelper::isBeforeToday($item->date.' '.$item->time) && (($by_match && $view == "match") || (!$by_match && $view == "matchday"));
        }
        return false;
    }

    protected function getCategories() {
        jimport("FMManager.library");

        $input  = \JFactory::getApplication()->input;
        $view = $input->get('view', '', 'string');
        $id = $input->get('id', 0, 'int');

        $categories = array();
        if($view == "match" || $view == "matchday") {
            $class = "\FMManager\Database\Models\\".ucfirst($view);
            $item = $class::find($id);

            $path = $this->params->get("path", "");
            $path = (array)json_decode($path, true);

            foreach ($path as $value)
            {
                switch ($value)
                {
                    case "matchday":
                        $categories[] = ["title" => $item->matchday, "date" => $item->datetime->format("Y-m-d H:i:s")];
                        break;

                    case "competition":
                        $categories[] = ["title" => $item->competition->tournament->name];
                        break;

                    case "season":
                        $categories[] = ["title" => $item->competition->season->label];
                        break;

                    case "category":
                        $categories[] = ["title" => $item->competition->tournament->category->label];
                        break;
                }

            }

            switch ($view)
            {
                case "match":
                    $categories[] = ["title" => $item->team1->small_name.JText::_("FM_VERSUS").$item->team2->small_name, "date" => $item->datetime->format("Y-m-d H:i:s"), "data" => array("note" => FM_MANAGER_COMPONENT.".".$view.".".$item->id)];

                case "matchday":
                    $categories[] = ["title" => $item->name, "date" => $item->datetime->format("Y-m-d H:i:s"), "data" => array("note" => FM_MANAGER_COMPONENT.".".$view.".".$item->id)];
            }
        }

        return $categories;
    }
}