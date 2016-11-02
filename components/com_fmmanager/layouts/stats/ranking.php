<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$ranking = JArrayHelper::getValue($displayData, "ranking");
$class = JArrayHelper::getValue($displayData, "class", "");
$sortable = JArrayHelper::getValue($displayData, "sortable", true);
$legends = JArrayHelper::getValue($displayData, "legends", array());
$columns = JArrayHelper::getValue($displayData, "columns", array());
$params = JArrayHelper::getValue($displayData, "params", array());
$show_name = JArrayHelper::getValue($params, "show_name", "small_name");
$show_legend = JArrayHelper::getValue($params, "show_legend", true);
$show_logo = JArrayHelper::getValue($params, "show_logo", true);
$count_in_series = JArrayHelper::getValue($params, "count_in_series", 3);

$id = uniqid();
$sortable_field = ($sortable) ? 'data-sortable="true"' : "";

?>

<div class="fm-stats-ranking <?php echo $class ?>">

    <table id="<?php echo $id ?>" data-classes="fm-table" data-row-style="backgroundRowStyle">
        <thead>
            <tr>
                <th data-field="background" class="hidden"></th>
                <th data-field="rank" <?php echo $sortable_field ?>>
                    <span class="hasTooltip" title="<?php echo JText::_("FM_RANK") ?>">
                        <?php echo ($sortable) ? JText::_("FM_RANK_SMALL") : ""; ?>
                    </span>
                </th>
                <?php if($show_logo) : ?>
                <th data-field="logo"></th>
                <?php endif; ?>
                <th data-field="team" <?php echo $sortable_field ?> data-halign="left">
                    <span class="hasTooltip" title="<?php echo JText::_("FM_TEAMS") ?>">
                        <?php echo ($sortable) ? JText::_("FM_TEAMS_SMALL") : "" ?>
                    </span>
                </th>
                <?php foreach ($columns as $column):  ?>
                <th data-field="<?php echo $column ?>" <?php echo $sortable_field ?>>
                    <span class="hasTooltip" title="<?php echo JText::_("FM_".strtoupper($column)) ?>">
                        <?php echo JText::_("FM_".strtoupper($column).'_SMALL') ?>
                    </span>
                </th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            //$rank = 1;
            foreach ($ranking as $row) :
                $row_class = "";
                $color = "";
                if(\FMManager\Helper::isMyClub($row->team->club_id))
                    $row_class = "fm-my-row";
                else {
                    $legend = array_filter($legends, function($obj) use($row) { return in_array($row->rank, $obj->range); });
                    $legend = reset($legend);
                    if($legend) $color = $legend->color;
                }
            ?>
            <tr class="<?php echo $row_class ?>">

                <!-- Color -->
                <td data-field="background" class="hidden">
                    <?php echo $color ?>
                </td>

                <!-- Rank -->
                <td data-field="rank" class="fm-col-number fm-col-rank">
                    <?php echo $row->rank ?>
                </td>

                <!-- Logo -->
                <?php if($show_logo) : ?>
                <td data-field="logo" class="fm-col-img fm-col-logo">
                    <?php echo FMManager\Html\Team::image($row->team, array(), false) ?>
                </td>
                <?php endif; ?>

                <!-- Team -->
                <td data-field="team" class="fm-col-team">
                    <?php echo $row->team->$show_name ?>
                </td>

                <!-- Columns -->
                <?php foreach ($columns as $column):  ?>
                <td data-field="<?php echo $column ?>" class="fm-col-number fm-col-<?php echo $column ?>">
                    <?php
                          switch ($column)
                          {
                              case "serie" :
                                  $matches = $row->matches->slice(count($row->matches) - $count_in_series, $count_in_series);
                                  if(count($matches)> 0)
                                      echo FootManager\Helpers\Layout::render('stats.serie', array("matches" => $matches, "team" => $row->team->id, "class" => "fm-bulls-mini" ));
                                  break;

                              default:
                                  echo $row->$column;
                          }
                    ?>
                </td>
                <?php endforeach; ?>
            </tr>
            <?php
                      //$rank+=1;
            endforeach; ?>
        </tbody>
    </table>

    <!-- Legend -->
    <?php if($show_legend && $legends) : ?>
    <ul class="fm-legend">
        <?php foreach ($legends as $legend) : ?>
        <li>
            <span class="fm-thumbnail-color">
                <span style="background-color: <?php echo $this->escape($legend->color); ?>;"></span>
            </span>
            <span>
                <?php echo $legend->label ?>
            </span>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php  endif; ?>
</div>

<?php FootManager\UI\ui::table("#".$id); ?>