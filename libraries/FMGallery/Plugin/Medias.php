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
abstract class Medias extends \JPlugin
{
    public function onAjaxMedias() {

        $input  = \JFactory::getApplication()->input;
        $addview = $input->get('addview', '', 'string');

        $id = 1;
        $categories = $this->getCategories();
        foreach ($categories as $category)
        {
            $title = \JArrayHelper::getValue($category, "title", "");
            $date = \JArrayHelper::getValue($category, "date", "");
            $parent_folder = \JArrayHelper::getValue($category, "parent_folder", "");
            $data = \JArrayHelper::getValue($category, "data", array());

            if($title) {
                $result = \FMGallery\Utilities\CategoryHelper::createCategory($title, $id, $date, $parent_folder, $data);

                if(is_string($result)) {
                    return $result;
                } else {
                    $id   = $result->id;
                }
            }
        }

        if($id > 1) {
            return "index.php?option=com_fmgallery&view=".$addview."&catid=".$id;
        } else
            return "";

    }

	/**
     * Plugin that retrieves contact information for contact
     *
     * @param   string   $context  The context of the content being passed to the plugin.
     * @param   mixed    &$row     An object with a "text" property
     * @param   mixed    $params   Additional parameters. See {@see PlgContentContent()}.
     * @param   integer  $page     Optional page number. Unused. Defaults to zero.
     *
     * @return  boolean	True on success.
     */
	public function onDisplayEditToolbar($view, $item, $actions)
	{

        jimport('FootManager.framework');
        if(!\FootManager\Helpers\Application::enabled("com_fmgallery")) return false;

        jimport('FMGallery.framework');
        $this->loadLanguage();

        if($this->canAddMedias($item, $view)) {

            \FootManager\UI\Html\Button\Group::addLink("#", "COM_FMGALLERY_ADD_NEW_PHOTOS", "fa fa-camera", array("class" => "btn-primary btn-small", "onclick" => "addPhotos('".$this->_type."', 'addphotos')"));
            \FootManager\UI\Html\Button\Group::addLink("#", "COM_FMGALLERY_ADD_NEW_VIDEO", "fa fa-video-camera", array("onclick" => "addPhotos('".$this->_type."', 'video&layout=edit')"), true);
            \FootManager\UI\Html\Button\Group::addLink("#", "COM_FMGALLERY_ADD_NEW_FILES", "fa fa-file", array("onclick" => "addPhotos('".$this->_type."', 'file&layout=edit')"), true);

            \FootManager\UI\Html\Toolbar::buttonsgroup("btn-primary btn-small");

            \FootManager\UI\Loader::javacript("
            function addPhotos(group, addview) {
                var id = jQuery('#fm-id').val();
                var view = jQuery('#fm-view').val();

                FM.loadAjaxPlugin(group, 'medias', { id: id, view: view, addview: addview }, function (result) {
                    if (result.data !== '')
                        window.open(result.data, '_blank');
                });

                return false;
            }");

            return true;
        }

        return false;
	}

    protected abstract function canAddMedias($item, $view);
    protected abstract function getCategory($context, &$item, &$params);
    protected abstract function getCategories();

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
        if(!\FootManager\Helpers\Application::enabled("com_fmgallery")) return false;

        jimport('FMGallery.framework');
        $this->loadLanguage();

        $category = $this->getCategory($context, $item, $params);

        if($category) {

            if($this->params->get("show_photos", 1)) {
                $size = $this->params->get("photo_thumb_size", "small");
                $photos = $category->photos->map(function($obj) {
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
                $videos = $category->videos->map(function($obj) use($size) { return $obj->toThumbnail($size); });
            } else {
                $videos = array();
            }

            if($this->params->get("show_files", 1)) {
                $size = $this->params->get("file_thumb_size", "small");
                $files = $category->files->map(function($obj) use($size) { return $obj->toThumbnail($size); });
            } else {
                $files = array();
            }

            if(count($photos) || count($videos) || count($files))
                return \FootManager\Helpers\Layout::render("plugins.medias", array("photos" => $photos, "videos" => $videos, "files" => $files, "params" => $this->params->toArray()));

        }
        return "";
	}

}