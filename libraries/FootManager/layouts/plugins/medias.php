<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Content.pagenavigation
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;
$photos = JArrayHelper::getValue($displayData, "photos", array());
$videos = JArrayHelper::getValue($displayData, "videos", array());
$files = JArrayHelper::getValue($displayData, "files", array());
$params = JArrayHelper::getValue($displayData, "params", array());

?>

<div class="fm-plugin-medias">

    <?php if(count($photos)) : ?>
    <div class="fm-plugin-medias-photos fm-small">
        <?php
              echo \FootManager\Helpers\Layout::render("html.title", array("title" => "COM_FMGALLERY_PHOTOS"));
              echo FootManager\Helpers\Layout::render("medias.slider", array("medias" => $photos, "params" => $params), "");
        ?>
    </div>
    <?php endif; ?>

    <?php if(count($videos)) : ?>
    <div class="fm-plugin-medias-videos">
        <?php
              echo \FootManager\Helpers\Layout::render("html.title", array("title" => "COM_FMGALLERY_VIDEOS"));
              echo FootManager\Helpers\Layout::render("medias.gallery", array("thumbnails" => $videos, "params" => $params), "");
        ?>
    </div>
    <?php endif; ?>

    <?php if(count($files)) : ?>
    <div class="fm-plugin-medias-files">
        <?php
              echo \FootManager\Helpers\Layout::render("html.title", array("title" => "COM_FMGALLERY_FILES"));
              echo FootManager\Helpers\Layout::render("medias.gallery", array("thumbnails" => $files, "params" => $params), "");
        ?>
    </div>
    <?php endif; ?>
</div>