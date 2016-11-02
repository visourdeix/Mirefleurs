<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

?>

<!-- Header Category -->
<?php echo FootManager\Helpers\Layout::render("category.header", array("category" => $this->item->video, "route" => "videos")) ?>

<!-- Video -->
<?php if(isset($this->item->video)) : ?>

<?php echo \FootManager\UI\Html\Media::video(\FMGallery\Helper::getFullPath($this->item->video->file, "")); ?>
<?php endif; ?>

<!-- Videos -->
<?php if(count($this->item->videos)) : ?>
<?php echo FootManager\Helpers\Layout::render("medias.gallery", array("thumbnails" => $this->item->video, "params" => $this->params->toArray())); ?>
<?php endif; ?>

<!-- Categories -->
<?php if(count($this->item->categories)) : ?>
<?php  echo \FootManager\Helpers\Layout::render("html.title", array("title" => "COM_FMGALLERY_OTHERS_ALBUMS")); ?>
<?php echo FootManager\Helpers\Layout::render("medias.gallery", array("thumbnails" => $this->item->categories)) ?>
<?php endif; ?>