<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$checkboxes = JArrayHelper::getValue($displayData, "checkboxes", array());
$icon_allowed = JArrayHelper::getValue($displayData, "icon", true);
$responsive = JArrayHelper::getValue($displayData, "responsive", false);
$class = JArrayHelper::getValue($displayData, "class", "");
$type = JArrayHelper::getValue($displayData, "type", "checkbox");

?>

<ul class="fm-checkboxes <?php echo ($icon_allowed) ? "fm-checkboxes-icon" : "" ?> <?php echo ($responsive) ? "fm-checkboxes-icon-responsive" : "" ?> <?php echo $class ?>">
    <?php foreach ($checkboxes as $i => $checkbox) :
              $id = isset($checkbox["id"]) ? $checkbox["id"] : "";
              $value = isset($checkbox["value"]) ? $checkbox["value"] : "";
              $checked = isset($checkbox["checked"]) ? $checkbox["checked"] : false;
              $text = isset($checkbox["text"]) ? $checkbox["text"] : "";
              $icon = isset($checkbox["icon"]) ? $checkbox["icon"] : "";
              $image = isset($checkbox["image"]) ? $checkbox["image"] : "";
              $name = isset($checkbox["name"]) ? $checkbox["name"] : "";

    ?>
    <li>
        <input id="<?php echo $id ?>" type="<?php echo $type ?>" name="<?php echo $name ?>" value="<?php echo $value ?>" <?php echo ($checked) ? "checked" : "" ?> />
        <label for="<?php echo $id ?>">
            <?php if($icon || $image) : ?>
            <span class="hasTooltip" title="<?php echo JText::_($text) ?>">
                <?php if($image) : ?>
                <?php echo $image ?>
                <?php else : ?>
                <i class="fa fa-<?php echo $icon ?>"></i>
                <?php endif; ?>
            </span>
            <?php endif; ?>
            <span>
                <?php echo JText::_($text) ?>
            </span>
        </label>
    </li>
    <?php endforeach; ?>
</ul>