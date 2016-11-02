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
$serie = JArrayHelper::getValue($displayData, "serie", array());
$team = JArrayHelper::getValue($displayData, "team");
$params = JArrayHelper::getValue($displayData, "params", array());
$ajax = JArrayHelper::getValue($params, "ajax_loading", false);

$difference = $statistics->scored - $statistics->conceded;
$difference = ($difference > 0) ? "+".$difference : $difference;
$countPlayed = count($statistics->played) ? count($statistics->played) : 1;
?>

<div class="fm-stats-team">

    <!-- Header -->
    <div class="fm-row fm-row-border">

        <!-- Scored -->
        <div>
            <div class="fm-text-170 fm-text-color-green">
                <i class="fa fa-soccer-ball-o"></i>
            </div>
            <div id="fm-scored" class="fm-text-600 fm-line-height-80 fm-text-color-green">
                <?php echo $statistics->scored ?>
            </div>
            <div class="fm-text-110">
                <?php echo JText::_("FM_GOALS_SCORED") ?>
            </div>
        </div>

        <!-- Conceded -->
        <div>
            <div class="fm-text-170">
                <i class="fm-icon-tshirt"></i>
            </div>
            <div id="fm-played" class="fm-text-600 fm-line-height-80">
                <?php echo count($statistics->played) ?>
            </div>
            <div class="fm-text-110">
                <?php echo JText::_("FM_MATCHES_PLAYED") ?>
            </div>
        </div>

        <!-- Played -->
        <div>
            <div class="fm-text-170 fm-text-color-red">
                <i class="fa fa-soccer-ball-o"></i>
            </div>
            <div id="fm-conceded" class="fm-text-600 fm-line-height-80 fm-text-color-red">
                <?php echo $statistics->conceded ?>
            </div>
            <div class="fm-text-110">
                <?php echo JText::_("FM_GOALS_CONCEDED") ?>
            </div>
        </div>
    </div>

    <!-- Results -->
    <div class="fm-teamstats-results">
        <!-- Title -->
        <div class="fm-title-2">
            <span>
                <?php echo JText::_("COM_FMMANAGER_RESULTS") ?>
            </span>
        </div>

        <!-- Body -->
        <div class="fm-column fm-column-border">

            <!-- Series -->
            <div>
                <?php echo FootManager\Helpers\Layout::render('stats.serie', array("matches" => $serie, "team" => $team, "class" => "fm-bulls-large" )); ?>
                <div class="fm-text-130 fm-margin-bottom-15 fm-margin-top-10">
                    <?php echo JText::_("FM_LAST_MATCHES") ?>
                </div>
            </div>

            <!-- Count V/N/D -->
            <div class="fm-row fm-row-border fm-row-responsive">

                <!-- Victories -->
                <?php echo FootManager\Helpers\Layout::render('charts.doughnut.single', array("value" => count($statistics->victories), "max" =>$countPlayed, "color" => "#145e1f", "label" => JText::_("FM_RESULTS_1"), "id" => "fm-victories")); ?>

                <!-- Draws -->
                <?php echo FootManager\Helpers\Layout::render('charts.doughnut.single', array("value" => count($statistics->draws), "max" =>$countPlayed, "color" => "#f49318", "label" => JText::_("FM_RESULTS_3"), "id" => "fm-draws")); ?>

                <!-- Defeats -->
                <?php echo FootManager\Helpers\Layout::render('charts.doughnut.single', array("value" => count($statistics->defeats), "max" =>$countPlayed, "color" => "#d3261d", "label" => JText::_("FM_RESULTS_4"), "id" => "fm-defeats")); ?>
            </div>

            <div class="fm-row fm-row-border fm-row-responsive-tablet">

                <!-- Percentage V/N/D -->
                <?php

                $data = array();
                $data[] = array("value" => number_format((count($statistics->victories) / $countPlayed) * 100, 2), "color" => "#145e1f", "label" => JText::_("FM_RESULTS_1"));
                $data[] = array("value" => number_format((count($statistics->draws) / $countPlayed) * 100, 2), "color" => "#f49318", "label" => JText::_("FM_RESULTS_3"));
                $data[] = array("value" => number_format((count($statistics->defeats) / $countPlayed) * 100, 2), "color" => "#d3261d", "label" => JText::_("FM_RESULTS_4"));
                echo FootManager\Helpers\Layout::render('charts.doughnut.multiple', array("data" => $data, "suffix" => " %", "id" => "fm-results"));

                ?>

                <!-- Series -->
                <div class="fm-column fm-column-border">

                    <!-- Victories series -->
                    <div class="fm-row fm-row-border">
                        <div>
                            <div class="fm-text-400 fm-line-height-60 fm-text-color-green">
                                <?php if(isset($statistics->biggerVictory)) echo $statistics->biggerVictory->score;
                                      else echo JText::_("COM_FMMANAGER_SCORE_SEPARATOR"); ?>
                            </div>
                            <div class="fm-text-110">
                                <?php echo JText::_("FM_BIGGER_VICTORY") ?>
                            </div>
                        </div>
                        <div>
                            <div class="fm-text-400 fm-line-height-60 fm-text-color-green">
                                <?php echo $statistics->matchesWithoutDefeats ?>
                            </div>
                            <div class="fm-text-110">
                                <?php echo JText::_("FM_MATCHES_WITHOUT_DEFEATS") ?>
                            </div>
                        </div>
                        <div>
                            <div class="fm-text-400 fm-line-height-60 fm-text-color-green">
                                <?php echo $statistics->consecutivesVictories ?>
                            </div>
                            <div class="fm-text-110">
                                <?php echo JText::_("FM_SUCCESSIVES_VICTORIES") ?>
                            </div>
                        </div>
                    </div>

                    <!-- Defeats series -->
                    <div class="fm-row fm-row-border">
                        <div>
                            <div class="fm-text-400 fm-line-height-60 fm-text-color-red">
                                <?php if(isset($statistics->biggerDefeat)) echo $statistics->biggerDefeat->score;
                                      else echo JText::_("COM_FMMANAGER_SCORE_SEPARATOR"); ?>
                            </div>
                            <div class="fm-text-110">
                                <?php echo JText::_("FM_BIGGER_DEFEAT") ?>
                            </div>
                        </div>
                        <div>
                            <div class="fm-text-400 fm-line-height-60 fm-text-color-red">
                                <?php echo $statistics->matchesWithoutVictories ?>
                            </div>
                            <div class="fm-text-110">
                                <?php echo JText::_("FM_MATCHES_WITHOUT_VICTORIES") ?>
                            </div>
                        </div>
                        <div>
                            <div class="fm-text-400 fm-line-height-60 fm-text-color-red">
                                <?php echo $statistics->consecutivesDefeats ?>
                            </div>
                            <div class="fm-text-110">
                                <?php echo JText::_("FM_SUCCESSIVES_DEFEATS") ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Goals Series -->
            <div class="fm-row fm-row-border fm-row-responsive">
                <div>
                    <div class="fm-text-250 fm-line-height-35 fm-text-color-green">
                        <?php echo $statistics->consecutivesScored ?>
                    </div>
                    <div class="fm-text-110">
                        <?php echo JText::_("FM_MATCHES_WITH_SCORED") ?>
                    </div>
                </div>
                <div>
                    <div class="fm-text-250 fm-line-height-35 fm-text-color-green">
                        <?php echo $statistics->consecutivesNoConceded ?>
                    </div>
                    <div class="fm-text-110">
                        <?php echo JText::_("FM_MATCHES_WITHOUT_CONCEDED") ?>
                    </div>
                </div>
                <div>
                    <div class="fm-text-250 fm-line-height-35 fm-text-color-red">
                        <?php echo $statistics->consecutivesNoScored ?>
                    </div>
                    <div class="fm-text-110">
                        <?php echo JText::_("FM_MATCHES_WITHOUT_SCORED") ?>
                    </div>
                </div>
                <div>
                    <div class="fm-text-250 fm-line-height-35 fm-text-color-red">
                        <?php echo $statistics->consecutivesConceded ?>
                    </div>
                    <div class="fm-text-110">
                        <?php echo JText::_("FM_MATCHES_WITH_CONCEDED") ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Goals -->
    <div class="fm-teamstats-goals">

        <!-- Title -->
        <div class="fm-title-2">
            <span>
                <?php echo JText::_("COM_FMMANAGER_GOALS") ?>
            </span>
        </div>

        <!-- Body -->
        <div class="fm-column fm-column-border">

            <div class="fm-row fm-row-responsive">

                <!-- Scored -->
                <div>
                    <div class="fm-text-400 fm-line-height-60 fm-text-color-green">
                        <?php echo $statistics->scored ?>
                    </div>
                    <div class="fm-text-110">
                        <?php echo JText::_("FM_GOALS_SCORED") ?>
                    </div>
                </div>

                <!-- Chart -->
                <div>
                    <?php
                    $data = array();
                    $data[] = array("value" => $statistics->conceded, "color" => "#d3261d");
                    $data[] = array("value" => $statistics->scored, "color" => "#145e1f");
                    echo FootManager\UI\Html\Chart::doughnut($data, "fm-goals-chart", '200', '200');
                    echo FootManager\UI\Html\Form::hidden(array("id" => "fm-goals" ,"name" => "charts[fm-goals]" , "value" => $data));
                    ?>
                </div>

                <!-- Conceded -->
                <div>
                    <div class="fm-text-400 fm-line-height-60 fm-text-color-red">
                        <?php echo $statistics->conceded ?>
                    </div>
                    <div class="fm-text-110">
                        <?php echo JText::_("FM_GOALS_CONCEDED") ?>
                    </div>
                </div>
            </div>

            <!-- Legend -->
            <div class="fm-row fm-row-border">
                <div>
                    <div class="fm-text-200 fm-line-height-35 fm-text-color-green">
                        <?php echo number_format($statistics->scored / $countPlayed, 2) ?>
                    </div>
                    <div class="fm-text-110">
                        <?php echo JText::_("FM_SCORED_BY_MATCHES") ?>
                    </div>
                </div>
                <div>
                    <div class="fm-text-250 fm-line-height-35 <?php echo ($difference > 0) ? "fm-text-color-green" : (($difference < 0) ? "fm-text-color-red" : "") ?>">
                        <?php echo $difference ?>
                    </div>
                    <div class="fm-text-110">
                        <?php echo JText::_("FM_DIFFERENCE") ?>
                    </div>
                </div>
                <div>
                    <div class="fm-text-200 fm-line-height-35 fm-text-color-red">
                        <?php echo number_format($statistics->conceded / $countPlayed, 2) ?>
                    </div>
                    <div class="fm-text-110">
                        <?php echo JText::_("FM_CONCEDED_BY_MATCHES") ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Players Stats -->
    <?php if(count($statistics->players_stats)) :  ?>
    <div class="fm-teamstats-stats">

        <!-- Title -->
        <div class="fm-title-2">
            <span>
                <?php echo JText::_("COM_FMMANAGER_PLAYERS_STATS") ?>
            </span>
        </div>

        <!-- Body -->
        <div class="fm-flex fm-flex-border fm-flex-responsive">

            <?php foreach ($statistics->players_stats as $stat) : ?>

            <div>
                <?php if($stat->statistic->unit == 1) : ?>
                <?php echo FootManager\Helpers\Layout::render('charts.doughnut.single', array("value" => number_format($stat->value, 2), "max" =>100, "color" => $stat->statistic->color, "label" => $stat->statistic->label, "id" => "fm-stat-".$stat->statistic->id, "suffix" => " %")); ?>
                <?php else : ?>
                <div>
                    <?php echo FMManager\Html\Statistic::image($stat->statistic, array(), !$ajax) ?>
                </div>
                <div class="fm-text-500 fm-line-height-70" style="color:<?php echo $stat->statistic->color ?>">
                    <?php echo ($stat->statistic->calculation == FMManager\Constants::AVG) ? number_format($stat->value, 2) : $stat->value  ?>
                </div>
                <div class="fm-text-110">
                    <?php echo $stat->statistic->label ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>

    <!-- Team Stats -->
    <?php if(count($statistics->team_stats)) : ?>
    <div class="fm-teamstats-stats">

        <!-- Title -->
        <div class="fm-title-2">
            <span>
                <?php echo JText::_("COM_FMMANAGER_TEAM_STATS") ?>
            </span>
        </div>

        <!-- Body -->
        <div class="fm-flex fm-flex-border fm-flex-responsive">

            <?php foreach ($statistics->team_stats as $stat) : ?>

            <div>
                <?php if($stat->statistic->unit == 1) : ?>
                <?php echo FootManager\Helpers\Layout::render('charts.doughnut.single', array("value" => number_format($stat->value, 2), "max" =>100, "color" => $stat->statistic->color, "label" => $stat->statistic->label, "id" => "fm-stat-".$stat->statistic->id, "suffix" => " %")); ?>
                <?php else : ?>
                <div>
                    <?php echo FMManager\Html\Statistic::image($stat->statistic, array(), !$ajax) ?>
                </div>
                <div class="fm-text-500 fm-line-height-70" style="color:<?php echo $stat->statistic->color ?>">
                    <?php echo ($stat->statistic->calculation == FMManager\Constants::AVG) ? number_format($stat->value, 2) : $stat->value  ?>
                </div>
                <div class="fm-text-110">
                    <?php echo $stat->statistic->label ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</div>