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
<?php echo FootManager\Helpers\Layout::render("category.header", array("category" => $this->item->category, "route" => "photos")) ?>

<!-- Files -->
<?php if(count($this->item->files)) : ?>
<?php echo FootManager\Helpers\Layout::render("medias.gallery", array("thumbnails" => $this->item->files)) ?>
<?php endif; ?>

<!-- Sub Categories -->
<?php if(count($this->item->subcategories)) : ?>
<?php  echo \FootManager\Helpers\Layout::render("html.title", array("title" => "COM_FMGALLERY_ALBUMS")); ?>
<?php echo FootManager\Helpers\Layout::render("medias.gallery", array("thumbnails" => $this->item->subcategories)) ?>
<?php endif; ?>

<!-- Categories -->
<?php if(count($this->item->categories)) : ?>
<?php  echo \FootManager\Helpers\Layout::render("html.title", array("title" => "COM_FMGALLERY_OTHERS_ALBUMS")); ?>
<?php echo FootManager\Helpers\Layout::render("medias.gallery", array("thumbnails" => $this->item->categories)) ?>
<?php endif; ?>