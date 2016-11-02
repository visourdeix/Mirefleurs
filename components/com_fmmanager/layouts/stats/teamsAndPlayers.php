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
$teams_stats = JArrayHelper::getValue($displayData, "teams_stats",  array());
$players_stats = JArrayHelper::getValue($displayData, "players_stats",  array());
$params = JArrayHelper::getValue($displayData, "params",  array());
$ajax = JArrayHelper::getValue($displayData, "ajax_loading",  true);

print_r($teams_stats);

?>

<?php if(count($teams_stats) || count($players_stats)) : ?>

<div>
    <!-- Teams statistics -->
    <?php
          if(count($teams_stats)) echo FootManager\Helpers\Layout::render('stats.teams', array("team1" => $team1,"team2" => $team2, "stats" => $teams_stats, "params" => $params));
    ?>

    <!-- Players statistics -->
    <?php if(count($players_stats)) :  ?>

    <div class="fm-margin-top-20">

        <?php foreach($players_stats as $team_id => $stats) {

                  if(count($stats)) {
                      $team = ($team1->id == $team_id) ? $team1 : $team2;

                      $allowed_statistics = [];
                      foreach ($stats as $row)
                          foreach ($row->stats as $stat)
                              $allowed_statistics[$stat->statistic->id] = $stat->statistic;

                      $params["show_position"] = false;
                      $params["show_played"] = false;
                      echo \FootManager\Helpers\Layout::render("stats.players", array("allowed_statistics" => $allowed_statistics, "statistics" => $stats, "params" => $params));
                  }
              } ?>
    </div>

    <?php endif; ?>
</div>

<?php else : ?>
<?php echo FootManager\Helpers\Layout::render('messages.nodata') ?>
<?php endif; ?>