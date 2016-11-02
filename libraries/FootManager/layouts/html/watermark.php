<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$class = JArrayHelper::getValue($displayData, "class", "");
$text = JArrayHelper::getValue($displayData, "text", "");

?>

<div class="fm-watermark <?php echo $class ?>">
    <?php echo $text ?>
</div>