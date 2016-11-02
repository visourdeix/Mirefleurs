<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Search.contacts
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

class plgSystemFmopengraph extends JPlugin
{

    public function onBeforeRender()
    {
        if (JFactory::getApplication()->isAdmin()) {
            return;
        }

        jimport("FootManager.library");

        $document = JFactory::getDocument();
        $config = FootManager\Helpers\Application::getConfiguration("com_fmsocial");
        $type = $config->get("type");
        $image = $config->get("image");
        $app_id = (JDEBUG) ? $config->get("app_id_test") : $config->get("app_id");

        FootManager\Social\OpenGraph::addFbTag("app_id", $app_id);
        FootManager\Social\OpenGraph::addTwitterTag("card", "summary");
        FootManager\Social\OpenGraph::addOgTag("site_name", JFactory::getApplication()->getCfg("sitename"));
        FootManager\Social\OpenGraph::addOgTag("description", $document->getDescription());
        FootManager\Social\OpenGraph::addOgTag("locale", $document->getLanguage());
        FootManager\Social\OpenGraph::addOgTag("type", $type);
        FootManager\Social\OpenGraph::addUrlTag(JUri::getInstance());
        FootManager\Social\OpenGraph::addTitleTag($document->getTitle());
        FootManager\Social\OpenGraph::addImageTag(FootManager\Utilities\FileHelper::getFullPath($image));

        FootManager\UI\Loader::javacript(
            "window.fbAsyncInit = function() {
    FB.init({
      appId      : '".$app_id."',
      xfbml      : true,
      version    : 'v2.3'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = '//connect.facebook.net/en_US/sdk.js';
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));"
            );
    }
}