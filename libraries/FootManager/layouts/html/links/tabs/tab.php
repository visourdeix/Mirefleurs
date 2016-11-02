<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$link = isset($displayData["link"]) ? $displayData["link"] : "#";
$id = isset($displayData["id"]) ? $displayData["id"] : "";
$icon = isset($displayData["icon"]) ? $displayData["icon"] : "";
$label = isset($displayData["label"]) ? $displayData["label"] : "";
$class = isset($displayData["class"]) ? $displayData["class"] : "";
$tooltip = isset($displayData["tooltip"]) ? $displayData["tooltip"] : true;

?>

<li <?php echo ($id) ? 'id="'.$id.'"' : '' ?> class="<?php echo ($tooltip) ? "hasTooltip" : "" ?> <?php echo $class ?>" title="<?php echo ($tooltip) ? $label : "" ?>">
    <a href="<?php echo $link ?>">
        <?php if($icon) : ?>
        <span class="fm-icon">
            <i class="<?php echo $icon ?>"></i>
        </span>
        <?php endif; ?>
        <?php if($label) : ?>
        <span class="fm-label">
            <?php echo $label ?>
        </span>
        <?php endif; ?>
    </a>
</li>