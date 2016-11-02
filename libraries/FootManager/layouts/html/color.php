<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

$color = isset($displayData["color"]) ? $displayData["color"] : "";
$params = isset($displayData["params"]) ? $displayData["params"] : array();
$show_tooltip = isset($params["show_tooltip"]) ? $params["show_tooltip"] : false;

?>

<?php if($color) : ?>
<span class="fm-thumbnail-color hasTooltip" <?php echo $show_tooltip ? 'title="'.$color.'"' : ""; ?>">
    <span style="background-color: <?php echo $color; ?>;"></span>
</span>
<?php endif;?>