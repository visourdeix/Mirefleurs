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
$first = JArrayHelper::getValue($displayData, "first", array());
$last = JArrayHelper::getValue($displayData, "last", array());
$class = JArrayHelper::getValue($displayData, "class", "");
$params = JArrayHelper::getValue($displayData, "params", array());
$id = uniqid();

?>

<div class="fm-masonry">
    <div id="<?php echo $id ?>" class="fm-masonry-list">

        <?php foreach ($first as $div) : ?>
        <div class="fm-masonry-item">
            <?php echo $div ?>
        </div>
        <?php endforeach; ?>

        <?php foreach ($thumbnails as $thumbnail) : ?>
        <div class="fm-masonry-item fm-masonry-item-thumbnail">
            <?php echo FootManager\Helpers\Layout::render("medias.masonry.item", array("item" => $thumbnail, "params" => $params)) ?>
        </div>
        <?php endforeach; ?>

        <?php foreach ($last as $div) : ?>
        <div class="fm-masonry-item">
            <?php echo $div ?>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
FootManager\UI\ui::isotope("#".$id);

?>