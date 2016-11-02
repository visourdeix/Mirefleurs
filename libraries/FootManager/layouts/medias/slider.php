<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;
$medias = JArrayHelper::getValue($displayData, "medias", array());
$class = JArrayHelper::getValue($displayData, "class", "");
$params = JArrayHelper::getValue($displayData, "params", array());
$id = uniqid();
?>

<?php

if(count($medias)) : ?>

<div class="fm-camera camera_wrap camera_white_skin <?php echo $class ?>" itemscope itemtype="http://schema.org/ImageGallery">
    <div id="<?php echo $id ?>">
        <?php foreach ($medias as $media) : ?>
        <div data-thumb="<?php echo $media->thumb ?>" data-src="<?php echo $media->image ?>">

            <?php if(isset($media->video) && $media->video) : ?>
            <iframe src="<?php echo $media->video ?>" width="100%" height="100%" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
            <?php endif; ?>

            <?php if(isset($media->caption) && $media->caption) : ?>
            <div class="fm-caption">
                <?php echo $media->caption ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php

    \FootManager\UI\ui::camera("#".$id);

?>
<?php endif; ?>