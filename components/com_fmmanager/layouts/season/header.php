<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$season = JArrayHelper::getValue($displayData, "season");
$seasons = JArrayHelper::getValue($displayData, "seasons");
$view = JArrayHelper::getValue($displayData, "view", "", "STRING");

foreach ($seasons as $item) {
    \FootManager\UI\Html\Dropdown::addLink(FmmanagerHelperRoute::season($item, $view), $item->label);
}

?>

<?php if(isset($season)) : ?>

<div class="fm-dropdown-title">
    <?php echo \FootManager\UI\Html\Dropdown::render('<span class="fm-margin-right-10">'.$season->label.'</span>', "season_label"); ?>
</div>

<?php endif; ?>