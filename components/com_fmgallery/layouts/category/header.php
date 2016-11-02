<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

$route = JArrayHelper::getValue($displayData, "route", "category");
$category = JArrayHelper::getValue($displayData, "category");
$count_photos = JArrayHelper::getValue($displayData, "count_photos");
$count_videos = JArrayHelper::getValue($displayData, "count_videos");
$count_files = JArrayHelper::getValue($displayData, "count_files");

$date = $category->date;
if($date) {
    $date = new JDate($date);
    $date = $date->format("d.m.y");
}

if($route == "category") {
    if($category->countAllPhotos) $counts[] = \JText::sprintf("COM_FMGALLERY_N_PHOTOS", $category->countAllPhotos);
    if($category->countAllVideos) $counts[] = \JText::sprintf("COM_FMGALLERY_N_VIDEOS", $category->countAllVideos);
    if($category->countAllFiles) $counts[] = \JText::sprintf("COM_FMGALLERY_N_FILES", $category->countAllFiles);
} else {
    $countField = "countAll".$route;
    $counts[] = \JText::sprintf("COM_FMGALLERY_N_".strtoupper($route), $category->$countField);
}

if($category) :
?>
<div class="fm-category-header fm-margin-bottom-10">
    
    <?php if($category->parent_id > 0) : ?>
    <div class="pull-right fm-margin-bottom-10">
        <?php echo FootManager\Helpers\Layout::render("html.buttons.icon", array("link" => FmgalleryHelperRoute::$route($category->parent_id), "icon" => "hand-o-left", "text" => "COM_FMGALLERY_GO_TO_PARENT_CATEGORY")); ?>
    </div>
    <?php endif; ?>
    <?php if($category->parent_category && $category->parent_id > 1) : ?>
    <div>
        <span class="fm-badge fm-badge-green"><?php echo $category->parent_category->title;?></span>
    </div>
    <?php endif; ?>
    <div>
        <?php if($category->id > 1) : ?>
        <h2><?php echo $category->title;?></h2>
        <?php endif; ?>
    </div>
    <div class="fm-category-header-subtitle">
        <?php if($date) : ?>
        <span><?php echo $date;?></span>
        <?php endif; ?>
        <?php if($date && $counts) : ?>
        <span>|</span>
        <?php endif; ?>
        <?php if($counts) : ?>
        <span><?php echo implode(" - ", $counts) ?></span>
        <?php endif; ?>
    </div>
    <div class="clearfix"></div>
</div>

<?php endif; ?>