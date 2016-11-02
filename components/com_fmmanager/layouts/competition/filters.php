<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$competition = JArrayHelper::getValue($displayData, "competition");
$competitions = JArrayHelper::getValue($displayData, "competitions");
$view = JArrayHelper::getValue($displayData, "view", "", "STRING");

if($view == "ranking") $competitions = $competitions->filter(function($obj) { return $obj->has_ranking; });
$competitions = $competitions->groupBy("season.label");

foreach ($competitions as $season => $items) {
    \FootManager\UI\Html\Dropdown::addGroup($season);
    foreach ($items as $item) {
        \FootManager\UI\Html\Dropdown::addLink(FmmanagerHelperRoute::competition($item, $view), $item->tournament->name);
    }
}

?>

<?php if(isset($competition)) : ?>

<div class="fm-dropdown-title">
    <?php echo \FootManager\UI\Html\Dropdown::render('<span class="fm-margin-right-10">'.$competition->tournament->name.'</span>', "season_label"); ?>
</div>

<?php endif; ?>