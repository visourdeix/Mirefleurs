<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

$stats = JArrayHelper::getValue($displayData, "statistics", array());
$class = JArrayHelper::getValue($displayData, "class", "");
$params = JArrayHelper::getValue($displayData, "params", array());
$ajax = JArrayHelper::getValue($params, "ajax_loading", false);

?>

<?php if(count($stats)) :
          $stats = $stats->filter(function($obj) { return $obj->statistic->is_event; });
          $stats = $stats->groupBy("statistic_id");
?>

<div class="fm-match-info-statistics <?php echo $class ?>">
    <?php foreach ($stats as $stats_list) :
              $statistic = $stats_list->first()->statistic;
              $items = array();
              foreach ($stats_list as $stat)
              {
                  $items[] = ($stat->minute) ? $stat->minute."' : ".$stat->person->name : $stat->person->name;
              }

              $title = implode("<br />", $items);;
    ?>
    <span class="hasTooltip" title="<?php echo $title ?>">
        <span style="color:<?php echo $statistic->color ?>">
            <?php echo count($stats_list) ?>
        </span>
        <span>
            <?php echo FMManager\Html\Statistic::image($statistic, array(), !$ajax) ?>
        </span>
    </span>
    <?php endforeach; ?>
</div>

<?php endif; ?>