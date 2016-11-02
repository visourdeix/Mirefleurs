<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$icon = isset($displayData["icon"]) ? $displayData["icon"] : "";
$link = isset($displayData["link"]) ? $displayData["link"] : "";
$text = isset($displayData["text"]) ? $displayData["text"] : "";
$class = isset($displayData["class"]) ? $displayData["class"] : "";

?>

<a class="fm-btn-icon <?php echo $class ?>" href="<?php echo $link ?>">
    <?php if($icon) : ?>
    <span class="fa fa-<?php echo $icon ?>"></span>
    <?php endif; ?>

    <?php if($text) : ?>
    <span>
        <?php echo JText::_($text) ?>
    </span>
    <?php endif; ?>
</a>