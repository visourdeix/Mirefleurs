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
$id = uniqid();
?>

<?php

if(count($thumbnails)) { ?>

<div id="<?php echo $id ?>">
    <?php echo FootManager\Helpers\Layout::render("medias.gallery", array("thumbnails" => $thumbnails, "class" => "photoswipe ".$class, "params" => $params)); ?>
</div>

<?php
    echo FootManager\Helpers\Layout::render("medias.photoswipe.template");
    \FootManager\UI\ui::photoswipe(".photoswipe");

}
?>