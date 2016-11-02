<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

$player_stats = JArrayHelper::getValue($displayData, "player_stats");
$staff_stats = JArrayHelper::getValue($displayData, "staff_stats");
$params = JArrayHelper::getValue($displayData, "params");
$ajax = JArrayHelper::getValue($params, "ajax_loading", false);

?>

<!-- Player Stats -->
<?php if(count($player_stats)) : ?>
<div class="fm-title-2">
    <span>
        <?php echo JText::_("COM_FMMANAGER_PLAYER_CAREER") ?>
    </span>
</div>
<?php echo FootManager\Helpers\Layout::render("stats.career.player", array("stats" => $player_stats, "params" => $params)) ?>
<?php endif; ?>

<!-- Staff Stats -->
<?php if(count($staff_stats)) : ?>
<div class="fm-title-2">
    <span>
        <?php echo JText::_("COM_FMMANAGER_STAFF_CAREER") ?>
    </span>
</div>
<?php echo FootManager\Helpers\Layout::render("stats.career.staff", array("stats" => $staff_stats, "params" => $params)) ?>
<?php endif; ?>