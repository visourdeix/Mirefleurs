<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Content.Contact
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace FootManager\Plugin;

defined('_JEXEC') or die;

use Joomla\Registry\Registry;

/**
 * Contact Plugin
 *
 * @since  3.2
 */
class Taggedarticles extends \JPlugin
{

    protected function getTagFilters($context, &$item, &$params) {
        if($item->id) {
            $tag_note = $context.".".$item->id;
            return array("note" => $tag_note);
        }

        return array();
    }

    /**
     * Displays the voting area if in an article
     *
     * @param   string   $context  The context of the content being passed to the plugin
     * @param   object   &$row     The article object
     * @param   object   &$params  The article params
     * @param   integer  $page     The 'page' number
     *
     * @return  mixed  html string containing code for the votes if in com_content else boolean false
     *
     * @since   1.6
     */
	public function onContentAfterDisplay($context, &$item, &$params)
	{
        if(!\FootManager\Helpers\Application::enabled("com_tags") || !\FootManager\Helpers\Application::enabled("com_content")) return false;

        $tagFilters = $this->getTagFilters($context, $item, $params);

        if($tagFilters) {

            \JTable::addIncludePath(JPATH_ROOT . '/administrator/components/com_tags/tables');
            $table      = \JTable::getInstance("Tag", "TagsTable");
            $table->load($tagFilters);

            if(!$table->id) return "";

            // Get tags
            $db         = \JFactory::getDbo();
            $query= \FootManager\Helpers\Tags::getTagItemsQuery($table->id, 1);
            $db->setQuery($query);
            $tags = $db->loadObjectList();

            $user = \JFactory::getUser();

            // Get articles
            $items = \FootManager\Database\Models\Content::where("state", "=", 1)
                ->whereIn("access", $user->getAuthorisedViewLevels())
                ->whereIn("id", \FootManager\Utilities\ArrayHelper::getColumn($tags, "content_item_id"))
                ->orderBy("publish_up", "DESC")
                ->get();

            return \FootManager\Helpers\Layout::render("content.list", array("articles" => $items, "params" => $this->params->toArray()));
        }

        return "";
	}

}