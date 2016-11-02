<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

$team1 = JArrayHelper::getValue($displayData, "team1");
$team2 = JArrayHelper::getValue($displayData, "team2");
$stats_by_stat = JArrayHelper::getValue($displayData, "stats",  array());
$params = JArrayHelper::getValue($displayData, "params",  array());
$ajax = JArrayHelper::getValue($displayData, "ajax_loading",  true);

?>

<!-- Teams statistics -->
<?php if(count($stats_by_stat)) :  ?>
<div class="fm-stats-teams">
    <div class="fm-column fm-column-border">

        <!-- Header -->
        <div class="fm-row fm-teams-statistics-header">
            <?php echo FootManager\Helpers\Layout::render('team.name', array("team" => $team1, "class" => "text-left", "params" => $params)); ?>
            <?php echo FootManager\Helpers\Layout::render('team.name', array("team" => $team2, "class" => "text-right", "inverse" => true, "params" => $params)); ?>
        </div>
        <?php foreach ($stats_by_stat as $statistic_id => $stats) :
                  $values1 = $stats->filter(function ($obj) use($team1) { return $obj->team_id == $team1->id; });
                  $values2 = $stats->filter(function ($obj) use($team2) { return $obj->team_id == $team2->id; });

                  $value1_str = JText::_("FMLIB_NO_VALUE");
                  $value2_str = JText::_("FMLIB_NO_VALUE");
                  $value1 = 0;
                  $value2 = 0;

                  if(count($values1)) {
                      $value1 = $values1->sum("value");
                      $statistic = $values1->first()->statistic;
                      $value1_str = ($statistic->unit == 1) ? $value1." %" :$value1;
                  }

                  if(count($values2)) {
                      $value2 = $values2->sum("value");
                      $statistic = $values2->first()->statistic;
                      $value2_str = ($statistic->unit == 1) ? $value2." %" :$value2;
                  }

                  $width1 = 0;
                  $width2 = 0;
                  if($value1 > 0 || $value2 > 0) {
                      $width1 = ($value1 / ($value1 + $value2)) * 100;
                      $width2 = ($value2 / ($value2 + $value2)) * 100;
                  }

        ?>

        <div class="fm-row">
            <div class="fm-value fm-text-150 fm-line-height-20">
                <?php echo $value1_str; ?>
            </div>

            <div class="fm-label fm-text-120">
                <div class="fm-bar">
                    <div class="fm-bar-value" style="width: <?php echo $width1 ?>%; background-color: <?php echo $team1->home_color ?>"></div>
                    <div class="fm-bar-value" style="width: <?php echo $width2 ?>%; background-color: <?php echo $team2->away_color ?>"></div>
                </div>
                <div>
                    <?php echo $statistic->label ?>
                </div>
            </div>

            <div class="fm-value fm-text-150 fm-line-height-20">
                <?php echo $value2_str; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php else : ?>
<?php echo FootManager\Helpers\Layout::render('messages.nodata') ?>
<?php endif; ?>