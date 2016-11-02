<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$responsive = isset($displayData["responsive"]) ? $displayData["responsive"] : false;
$id = isset($displayData["id"]) ? $displayData["id"] : "";
$value = isset($displayData["value"]) ? $displayData["value"] : "";
$checked = isset($displayData["checked"]) ? $displayData["checked"] : false;
$text = isset($displayData["text"]) ? $displayData["text"] : "";
$icon = isset($displayData["icon"]) ? $displayData["icon"] : "";
$image = isset($displayData["image"]) ? $displayData["image"] : "";
$name = isset($displayData["name"]) ? $displayData["name"] : "";

?>

<span class="fm-checkbox <?php echo ($icon || $image) ? "fm-checkbox-icon" : "" ?> <?php echo ($responsive) ? "fm-checkbox-icon-responsive" : "" ?>">
    <input id="<?php echo $id ?>" type="checkbox" name="<?php echo $name ?>" value="<?php echo $value ?>" <?php echo ($checked) ? "checked" : "" ?> />
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
</span>