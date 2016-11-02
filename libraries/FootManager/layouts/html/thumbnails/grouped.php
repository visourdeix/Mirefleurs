<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$groupedItems = JArrayHelper::getValue($displayData, "items", array());
$layout = JArrayHelper::getValue($displayData, "layout", "");
$params = JArrayHelper::getValue($displayData, "params", array());
$component = JArrayHelper::getValue($displayData, "component", "");
$class = JArrayHelper::getValue($displayData, "class", "");

?>

<div>
    <?php if(count($groupedItems)) : ?>
    <?php foreach ($groupedItems as $group => $items) : ?>
    <div class="fm-title-2">
        <span>
            <?php echo $group ?>
        </span>
    </div>
    <?php echo FootManager\Helpers\Layout::render("html.thumbnails", array("items" => $items, "layout" => $layout, "params" => $params, "component" => $component, "class" => $class)) ?>
    <?php endforeach; ?>
    <?php else : ?>
    <?php echo FootManager\Helpers\Layout::render('messages.nodata') ?>
    <?php endif; ?>
</div>