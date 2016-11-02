<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

$team = JArrayHelper::getValue($displayData, "team");
$inverse = JArrayHelper::getValue($displayData, "inverse", false);
$icon = JArrayHelper::getValue($displayData, "icon", true);
$class = JArrayHelper::getValue($displayData, "class", "");
$params = JArrayHelper::getValue($displayData, "params", array());
$ajax = JArrayHelper::getValue($params, "ajax_loading", false);
?>

<?php if($team) : ?>

<div class="fm-team <?php echo $class ?>">
    <?php if(!$inverse && $icon) echo FMManager\Html\Team::image($team, array("class" =>"fm-logo"), !$ajax) ?>
    <?php echo $team->small_name ?>
    <?php if($inverse && $icon) echo FMManager\Html\Team::image($team, array("class" =>"fm-logo"), !$ajax) ?>
</div>

<?php endif; ?>