<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$items = JArrayHelper::getValue($displayData, "items", array());
$layout = JArrayHelper::getValue($displayData, "layout", "");
$params = JArrayHelper::getValue($displayData, "params", array());
$component = JArrayHelper::getValue($displayData, "component", "");
$class = JArrayHelper::getValue($displayData, "class", "");

?>

<?php if(count($items)) : ?>
<ul class="fm-list <?php echo $class ?>">

    <?php foreach ($items as $item) : ?>
    <li>
        <?php echo FootManager\Helpers\Layout::render($layout, array("item" => $item, "params" => $params), "", array("component" => $component)) ?>
    </li>
    <?php endforeach; ?>
</ul>
<?php else : ?>
<?php echo FootManager\Helpers\Layout::render('messages.nodata') ?>
<?php endif; ?>