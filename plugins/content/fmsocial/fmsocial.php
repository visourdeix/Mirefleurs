<?php

/**
 * @package     Joomla.Plugin
 * @subpackage  Content.vote
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

use Doctrine\Common\Cache\PhpFileCache;
use SocialShare\SocialShare;
use SocialShare\Provider\Facebook;
use SocialShare\Provider\Twitter;
use SocialShare\Provider\Google;

/**
 * Vote plugin.
 *
 * @since  1.5
 */
class PlgContentFmsocial extends JPlugin {

    public function onContentPrepare($context, &$row, &$params, $page = 0) {

        if (in_array($context, array('com_content.article', 'com_content.category', 'com_content.featured')))
        {

            jimport("FootManager.library");

            $image = "";
            $images = json_decode($row->images);
            if (isset($images->image_intro) and ! empty($images->image_intro)) {
                $image = $images->image_intro;
            } elseif (isset($images->image_fulltext) and ! empty($images->image_fulltext)) {
                $image = $images->image_fulltext;
            }

            FootManager\Social\OpenGraph::addOgTag("description", strip_tags($row->introtext));
            FootManager\Social\OpenGraph::addTitleTag(htmlentities($row->title, ENT_QUOTES, 'UTF-8'));
            FootManager\Social\OpenGraph::addImageTag(FootManager\Utilities\FileHelper::getFullPath($image));
            FootManager\Social\OpenGraph::addMetaTag("published_time", $row->publish_up, "article");
            FootManager\Social\OpenGraph::addMetaTag("modified_time", $row->modified, "article");

        }
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
    public function onContentAfterTitle($context, &$row, &$params, $page = 0) {

        $parts = explode(".", $context);
        $doc = JFactory::getDocument();

        if ($context != 'com_content.article') {
            return false;
        }

        jimport("FootManager.framework");

        $cache = new PhpFileCache(JFactory::getApplication()->getCfg('tmp_path')); // Use sys_get_temp_dir() to get the system temporary directory, but be aware of the security risk if your website is hosted on a shared server
        $socialShare = new SocialShare($cache);

        $socialShare->registerProvider(new Facebook());
        $socialShare->registerProvider(new Twitter());
        $socialShare->registerProvider(new Google());

        // Get the path for the layout file
        $path = JPluginHelper::getLayoutPath('content', 'fmsocial');

        ob_start();
        include $path;

        return ob_get_clean();

        return $html;
    }
}