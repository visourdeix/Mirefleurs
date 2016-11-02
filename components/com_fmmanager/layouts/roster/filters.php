<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$roster = JArrayHelper::getValue($displayData, "roster");
$team_rosters = JArrayHelper::getValue($displayData, "team_rosters", array());
$season_rosters = JArrayHelper::getValue($displayData, "season_rosters", array());
$view = JArrayHelper::getValue($displayData, "view", "", "STRING");
$user = JFactory::getUser();

?>

<?php if(isset($roster)) : ?>

<div class="my-template-subtitle">

    <!-- Teams -->
    <?php
          echo '<span class="my-template-subtitle-title">'.$roster->small_name.'</span>';
    ?>

    <?php
          foreach ($season_rosters as $item) {
              if($view != "playersstats" || $user->authorise( "stats.view", FM_MANAGER_COMPONENT.".category." . $item->category->id ))
                  \FootManager\UI\Html\Dropdown::addLink(FmmanagerHelperRoute::roster($item, $view), $item->season->label);
          }
          echo '<span class="my-template-subtitle-label">' . JText::_("COM_FMMANAGER_SEASON") . '</span>';
          echo \FootManager\UI\Html\Dropdown::render('<span class="fm-margin-right-10">'.$roster->season->label.'</span>', "season_rosters_label");

    ?>
</div>

<?php endif; ?>