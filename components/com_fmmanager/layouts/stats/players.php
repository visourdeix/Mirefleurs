<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

$statistics = JArrayHelper::getValue($displayData, "statistics");
$podium_goals = JArrayHelper::getValue($displayData, "podium_goals", array());
$podium_assists = JArrayHelper::getValue($displayData, "podium_assists", array());
$allowed_statistics = JArrayHelper::getValue($displayData, "allowed_statistics", array());
$params = JArrayHelper::getValue($displayData, "params", array());
$show_played = JArrayHelper::getValue($params, "show_played", true);
$show_position = JArrayHelper::getValue($params, "show_position", true);
$ajax = JArrayHelper::getValue($params, "ajax_loading", false);
$id = uniqid();

?>

<div class="fm-stats-players">

    <?php if(count($statistics)) : ?>

    <!-- Podiums -->
    <div class="fm-podiums">

        <!-- Goals Podium -->
        <?php if(count($podium_goals)) : ?>
        <div>
            <!-- Title -->
            <div class="fm-title-2">
                <span>
                    <span class="fa fa-futbol-o"></span>
                    <?php echo JText::_("FM_GOALS") ?>
                </span>
            </div>
            <?php echo FootManager\Helpers\Layout::render("stats.podium", array("statistics" =>  $podium_goals, "value" =>  "goals", "params" => $params)); ?>
        </div>
        <?php endif; ?>

        <!-- Assists Podium -->
        <?php if(count($podium_assists)) : ?>
        <div>
            <!-- Title -->
            <div class="fm-title-2">
                <span>
                    <span class="fa fa-star"></span>
                    <?php echo JText::_("FM_ASSISTS") ?>
                </span>
            </div>
            <?php echo FootManager\Helpers\Layout::render("stats.podium", array("statistics" =>  $podium_assists, "value" =>  "assists", "params" => $params)); ?>
        </div>
        <?php endif; ?>
    </div>

    <?php if(count($podium_goals) || count($podium_assists)) : ?>
    <!-- Title -->
    <div class="fm-title-2">
        <span>
            <?php echo JText::_("FM_DETAILLED_STATS") ?>
        </span>
    </div>
    <?php endif; ?>

    <!-- Table -->
    <table id="<?php echo $id ?>" data-classes="fm-table">
        <thead>
            <tr>
                <th data-field="link" class="hidden"></th>
                <?php if($show_position) : ?>
                <th data-field="position" class="hidden"></th>
                <?php endif; ?>
                <th class="hidden-phone" data-field="photo"></th>
                <th data-halign="left" data-field="name" data-sortable="true" data-formatter="linkFormatter">
                    <span class="hasTooltip" title="<?php echo JText::_("COM_FMMANAGER_FIELD_NAME") ?>">
                        <?php echo JText::_("COM_FMMANAGER_FIELD_NAME") ?>
                    </span>
                </th>
                <?php if($show_position) : ?>
                <th data-field="position_ordering" data-sortable="true" class="fm-col-separator hidden-phone" data-formatter="positionFormatter">
                    <span class="hasTooltip" title="<?php echo JText::_("COM_FMMANAGER_FIELD_POSITION") ?>">
                        <?php echo JText::_("COM_FMMANAGER_FIELD_POSITION_ICON") ?>
                    </span>
                </th>
                <?php endif; ?>
                <?php if($show_played) : ?>
                <th width="7%" data-field="played" data-sortable="true">
                    <span class="hasTooltip" title="<?php echo JText::_("FM_IN_MATCH") ?>">
                        <?php echo JText::_("FM_IN_MATCH_ICON") ?>
                    </span>
                </th>
                <th width="7%" data-field="in_first_team" data-sortable="true">
                    <span class="hasTooltip fm-text-color-green" title="<?php echo JText::_("FM_FIRST_TEAM_PLAYER") ?>">
                        <?php echo JText::_("FM_FIRST_TEAM_PLAYER_ICON") ?>
                    </span>
                </th>
                <th width="7%" data-field="substitutes" data-sortable="true" class="fm-col-separator">
                    <span class="hasTooltip fm-text-color-orange" title="<?php echo JText::_("FM_SUBSTITUTE") ?>">
                        <?php echo JText::_("FM_SUBSTITUTE_ICON") ?>
                    </span>
                </th>
                <?php endif; ?>
                <th width="7%" data-field="goals" data-sortable="true">
                    <span class="hasTooltip" title="<?php echo JText::_("FM_GOALS") ?>">
                        <?php echo JText::_("FM_GOALS_ICON") ?>
                    </span>
                </th>
                <th width="7%" data-field="assists" data-sortable="true" class="fm-col-separator">
                    <span class="hasTooltip" title="<?php echo JText::_("FM_ASSISTS") ?>">
                        <?php echo JText::_("FM_ASSISTS_ICON") ?>
                    </span>
                </th>
                <?php foreach($allowed_statistics as $stat) : ?>
                <th width="7%" data-field="stat-<?php echo $stat->id ?>" data-sortable="true">
                    <span class="hasTooltip" title="<?php echo $stat->label ?>">
                        <?php echo \FMManager\Html\Statistic::image($stat,array(), false); ?>
                    </span>
                </th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($statistics as $id => $row) : ?>
            <tr>
                <td data-field="link" class="hidden">
                    <?php echo FmmanagerHelperRoute::person($row->person) ?>
                </td>

                <?php if($show_position) : ?>
                <td data-field="position" class="hidden">
                    <?php if(isset($row->person->position)) : ?>
                    <span class="hasTooltip" title="<?php echo $row->person->position->label ?>">
                        <?php echo "(".substr($row->person->position->label, 0, 1).")" ?>
                    </span>
                    <?php endif; ?>
                </td>
                <?php endif; ?>
                <td data-field="photo" class="fm-col-img hidden-phone">
                    <?php echo FMManager\Html\Person::image($row->person, array(), false) ?>
                </td>
                <td data-field="name" class="fm-col-name">
                    <?php echo $row->person->last_name ?>
                    <br />
                    <span class="fm-first-name">
                        <?php echo $row->person->first_name ?>
                    </span>
                </td>
                <?php if($show_position) : ?>
                <td data-field="position_ordering" class="fm-col-position fm-col-separator text-center hidden-phone">
                    <?php echo (isset($row->person->position)) ? $row->person->position->ordering : 0; ?>
                </td>
                <?php endif; ?>
                <?php if($show_played) : ?>
                <td data-field="played" class="fm-col-number">
                    <?php echo isset($row->played) ? $row->played : "0" ?>
                </td>
                <td data-field="in_first_team" class="fm-col-number">
                    <?php echo isset($row->in_first_team) ? $row->in_first_team : "0" ?>
                </td>
                <td data-field="substitute" class="fm-col-number fm-col-separator">
                    <?php echo isset($row->substitutes) ? $row->substitutes : "0" ?>
                </td>
                <?php endif; ?>
                <td data-field="goals" class="fm-col-number">
                    <?php echo isset($row->goals) ? $row->goals : "0" ?>
                </td>
                <td data-field="assists" class="fm-col-number fm-col-separator">
                    <?php echo isset($row->assists) ? $row->assists : "0" ?>
                </td>
                <?php foreach($allowed_statistics as $allowed_statistic) :
                          $stat = $row->stats->first(function($key, $obj) use($allowed_statistic) { return $obj->statistic->id == $allowed_statistic->id;});
                ?>

                <td data-field="stat-<?php $allowed_statistic->id ?>" class="fm-col-number">
                    <?php echo (isset($stat)) ? $stat->value : "-"; ?>
                </td>
                <?php endforeach; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php \FootManager\UI\ui::table("#".$id); ?>

    <?php else : ?>
    <?php echo FootManager\Helpers\Layout::render('messages.nodata') ?>
    <?php endif; ?>
</div>