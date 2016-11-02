<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Content.Contact
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace FMGallery\Plugin;

defined('_JEXEC') or die;

use Joomla\Registry\Registry;

/**
 * Contact Plugin
 *
 * @since  3.2
 */
class TaggedMedias extends \JPlugin
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
        jimport('FootManager.framework');
        if(!\FootManager\Helpers\Application::enabled("com_tags") || !\FootManager\Helpers\Application::enabled("com_fmgallery")) return false;

        jimport('FMGallery.framework');
        $this->loadLanguage();

        $tagFilters = $this->getTagFilters($context, $item, $params);

        $html = "";
        if($tagFilters) {
            \JTable::addIncludePath(JPATH_ROOT . '/administrator/components/com_tags/tables');
            $table      = \JTable::getInstance("Tag", "TagsTable");
            $table->load($tagFilters);

            if(!$table->id) return "";

            // Get tags
            $db         = \JFactory::getDbo();
            $query= \FootManager\Helpers\Tags::getTagItemsQuery($table->id);
            $query->where("m.type_alias IN ('com_fmgallery.category', 'com_fmgallery.photo', 'com_fmgallery.video', 'com_fmgallery.file')");
            $db->setQuery($query);
            $tags = $db->loadObjectList();

            $user = \JFactory::getUser();
            $groups = $user->getAuthorisedViewLevels();

            if($this->params->get("show_photos", 1)) {
                $size = $this->params->get("photo_thumb_size", "small");
                $photos = \FMGallery\Database\Models\Photo::whereIn("id", \FootManager\Utilities\ArrayHelper::getColumn($tags, "content_item_id"))
                                                            ->whereIn("access", $groups)
                                                            ->where("state", "=", 1)
                                                            ->get()
                                                            ->map(function($obj) {
                                                            $return = new \stdClass();
                                                            $return->thumb = \FootManager\Utilities\ImageHelper::getRemoteName(\FMGallery\Helper::getImage($obj, "small"));
                                                            $return->image = \FootManager\Utilities\ImageHelper::getRemoteName(\FMGallery\Helper::getFullPath($obj->file));
                                                            return $return;
                                                        });

            } else {
                $photos = array();
            }

            if($this->params->get("show_videos", 1)) {
                $size = $this->params->get("video_thumb_size", "medium");
                $videos = \FMGallery\Database\Models\Video::whereIn("id", \FootManager\Utilities\ArrayHelper::getColumn($tags, "content_item_id"))
                                                            ->whereIn("access", $groups)
                                                            ->where("state", "=", 1)
                                                            ->get()
                                                            ->map(function($obj) use($size) { return $obj->toThumbnail($size); });
            } else {
                $videos = array();
            }

            if($this->params->get("show_files", 1)) {
                $size = $this->params->get("file_thumb_size", "small");
                $files = \FMGallery\Database\Models\File::whereIn("id", \FootManager\Utilities\ArrayHelper::getColumn($tags, "content_item_id"))
                                                            ->whereIn("access", $groups)
                                                            ->where("state", "=", 1)
                                                            ->get()
                                                            ->map(function($obj) use($size) { return $obj->toThumbnail($size); });
            } else {
                $files = array();
            }

            if(count($photos) || count($videos) || count($files))
                $html = \FootManager\Helpers\Layout::render("plugins.medias", array("photos" => $photos, "videos" => $videos, "files" => $files, "params" => $this->params->toArray()));
        }

        return $html;
	}

}