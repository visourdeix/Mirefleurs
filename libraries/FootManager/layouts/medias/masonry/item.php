<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;
$thumbnail = JArrayHelper::getValue($displayData, "item");
$class = JArrayHelper::getValue($displayData, "class", "");
$params = JArrayHelper::getValue($displayData, "params", array());
$ajax = JArrayHelper::getValue($params, "ajax_loading", false);

?>

<?php if($thumbnail) : ?>

<figure class="fm-medias-thumbnail <?php echo $class ?>" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">

    <!-- Link -->
    <a href="<?php echo $thumbnail->url ?>" itemprop="contentUrl">

        <div class="fm-image">

            <!-- Mask -->
            <?php if($thumbnail->mask) : ?>
            <div class="fm-mask">
                <?php echo $thumbnail->mask ?>
            </div>
            <?php endif; ?>

            <!-- Visible Mask -->
            <?php if($thumbnail->visibleMask) : ?>
            <div class="fm-mask-visible">
                <?php echo $thumbnail->visibleMask ?>
            </div>
            <?php endif; ?>

            <!-- Image -->
            <?php echo FootManager\Utilities\ImageHelper::render($thumbnail->image, array("itemprop" => "thumbnail", "alt" => $thumbnail->title), false) ?>
        </div>

        <!-- Caption -->
        <?php if($thumbnail->caption) : ?>
        <figcaption itemprop="<?php echo $thumbnail->title ?>">
            <?php echo $thumbnail->caption ?>
        </figcaption>
        <?php elseif($thumbnail->category || $thumbnail->title || $thumbnail->subtitle || $thumbnail->desc) : ?>
        <figcaption itemprop="<?php echo $thumbnail->title ?>">
            <?php if($thumbnail->category) : ?>
            <h5 class="fm-category">
                <?php echo $thumbnail->category ?>
            </h5>
            <div class="fm-separator"></div>
            <?php endif; ?>
            <h4 class="fm-title">
                <?php echo $thumbnail->title ?>
            </h4>
            <?php if($thumbnail->subtitle) : ?>
            <h6 class="fm-subtitle">
                <?php echo $thumbnail->subtitle ?>
            </h6>
            <?php endif; ?>
            <?php if($thumbnail->desc) : ?>
            <div class="fm-desc">
                <?php echo $thumbnail->desc ?>
            </div>
            <?php endif; ?>
        </figcaption>
        <?php endif; ?>
    </a>
</figure>

<?php endif; ?>