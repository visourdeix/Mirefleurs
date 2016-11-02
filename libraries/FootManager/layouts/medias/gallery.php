<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;
$thumbnails = JArrayHelper::getValue($displayData, "thumbnails", array());
$class = JArrayHelper::getValue($displayData, "class", "");
$params = JArrayHelper::getValue($displayData, "params", array());

?>

<?php

if(count($thumbnails)) { ?>

<div itemscope itemtype="http://schema.org/ImageGallery">
    <?php echo FootManager\Helpers\Layout::render("html.thumbnails", array("items" => $thumbnails, "layout" => "medias.thumbnail", "class" => "fm-gallery ".$class, "params" => $params)); ?>
</div>

<?php
}
?>