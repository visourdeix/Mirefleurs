<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$contacts = JArrayHelper::getValue($displayData, "contacts", array());
$show_value = JArrayHelper::getValue($displayData, "show_value", false);
$address = JArrayHelper::getValue($displayData, "address", array());
$params = JArrayHelper::getValue($displayData, "params", array());
$class = JArrayHelper::getValue($displayData, "class", "");

?>

<?php  if($contacts) : ?>
<ul class="fm-contacts <?php  echo $class?>">

    <?php foreach ($contacts as $contact) : ?>

    <li>
        <?php echo \FootManager\Helpers\Layout::render("person.info.contact", array("contact" => $contact, "show_value" => $show_value), '', array("component" => FM_MANAGER_COMPONENT)); ?>
    </li>

    <?php endforeach; ?>

    <?php if($address) : ?>
    <li class="fm-address">
        <?php echo \FootManager\Helpers\Layout::render("person.info.address", array("address" => $address, "show_value" => $show_value), '', array("component" => FM_MANAGER_COMPONENT)); ?>
    </li>
    <?php endif; ?>
</ul>

<?php endif ?>