<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

$title = isset($displayData["title"]) ? $displayData["title"] : "";
$class = isset($displayData["class"]) ? $displayData["class"] : "fm-title-2";

?>

<div class="<?php echo $class ?>">
    <span>
        <?php echo JText::_($title) ?>
    </span>
</div>