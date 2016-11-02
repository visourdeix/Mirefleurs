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
$team1_last_matches = JArrayHelper::getValue($displayData, "team1_last_matches",  array());
$team2_last_matches = JArrayHelper::getValue($displayData, "team2_last_matches",  array());
$team1_next_events = JArrayHelper::getValue($displayData, "team1_next_events",  array());
$team2_next_events = JArrayHelper::getValue($displayData, "team2_next_events",  array());
$confrontations = JArrayHelper::getValue($displayData, "confrontations",  array());
$params = JArrayHelper::getValue($displayData, "params",  array());
$ajax = JArrayHelper::getValue($displayData, "ajax_loading",  true);

$confrontations = $confrontations->reverse();
$victories1 = count($confrontations->filter(function($obj) use($team1) { return $obj->isWinner($team1)  ;}));
$victories2 = count($confrontations->filter(function($obj) use($team2) { return $obj->isWinner($team2)  ;}));
$draws = count($confrontations->filter(function($obj) use($team1) { return $obj->getResult($team1) == FMManager\Constants::DRAW ;}));
$scored1 = $team1_last_matches->sum(function($obj) use($team1) { return $obj->getScored($team1); });
$scored2 = $team2_last_matches->sum(function($obj) use($team2) { return $obj->getScored($team2); });
$conceded1 = $team1_last_matches->sum(function($obj) use($team1) { return $obj->getConceded($team1); });
$conceded2 = $team2_last_matches->sum(function($obj) use($team2) { return $obj->getConceded($team2); });

$team1_color = ($team1->home_color !== "") ? $team1->home_color : "#333";
$team2_color = ($team2->away_color !== "") ? $team2->away_color : "#777";

?>

<div class="fm-stats-face-to-face">

    <!-- Confrontation -->
    <div class="fm-confrontations">
        <!-- Title -->
        <div class="fm-title-2">
            <span>
                <?php echo JText::_("COM_FMMANAGER_CONFRONTATIONS") ?>
            </span>
        </div>

        <!-- Body -->
        <div class="fm-column fm-column-border">

            <!-- Chart -->
            <div class="fm-row fm-row-responsive">

                <!-- Team 1 -->
                <div>
                    <div class="fm-team">
                        <?php echo $team1->small_name ?>
                    </div>
                    <div class="fm-logo">
                        <?php echo FMManager\Html\Team::image($team1, array(), !$ajax) ?>
                    </div>
                    <div class="fm-text-400 fm-line-height-60" style="color:<?php echo $team1_color ?>">
                        <?php echo $victories1 ?>
                    </div>
                </div>

                <!-- Chart -->
                <div>
                    <div>
                        <?php
                        $data = array();
                        $data[] = array("value" => $victories2, "color" => $team2_color);
                        $data[] = array("value" => $draws, "color" => "#ddd");
                        $data[] = array("value" => $victories1, "color" => $team1_color);
                        echo FootManager\UI\Html\Chart::doughnut($data, "fm-confrontations-chart", '150', '150');
                        echo FootManager\UI\Html\Form::hidden(array("id" => "fm-confrontations" ,"name" => "charts[fm-confrontations]" , "value" => $data));
                        ?>
                    </div>
                    <div class="fm-text-200 fm-line-height-60">
                        <?php echo $draws.' '.JText::_("FM_RESULTS_3") ?>
                    </div>
                </div>

                <!-- Team 2 -->
                <div>
                    <div class="fm-team">
                        <?php echo $team2->small_name ?>
                    </div>
                    <div class="fm-logo">
                        <?php echo FMManager\Html\Team::image($team2, array(), !$ajax) ?>
                    </div>
                    <div class="fm-text-400 fm-line-height-60" style="color:<?php echo $team2_color ?>">
                        <?php echo $victories2 ?>
                    </div>
                </div>
            </div>

            <!-- Matches -->
            <?php
            $maximum = 3;
            $visible_matches = array();
            $more_matches = array();

            if(count($confrontations) > $maximum) {
                $visible_matches = $confrontations->slice(0, $maximum);
                $more_matches = $confrontations->slice($maximum, count($confrontations) - $maximum);
            } else {
                $visible_matches = $confrontations;
            }

            $params["show_tournament"] = true;

            ?>

            <?php echo FootManager\Helpers\Layout::render("html.list", array("items" => $visible_matches, "layout" => "match.item", "params" => $params)) ?>
            <?php if($more_matches) : ?>
            <div id="fm-more-matches" class="collapse fm-padding-0">
                <?php echo FootManager\Helpers\Layout::render("html.list", array("items" => $more_matches, "layout" => "match.item", "params" => $params)) ?>
            </div>
            <?php echo FootManager\Helpers\Layout::render("html.collapse.more", array("target" => "fm-more-matches")); ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Last Matches -->
    <div class="fm-last-matches">
        <!-- Title -->
        <div class="fm-title-2">
            <span>
                <?php echo JText::_("FM_LAST_MATCHES") ?>
            </span>
        </div>

        <div class="fm-column fm-column-border">

            <!-- Bulls -->
            <div class="fm-row fm-row-border fm-series">
                <div>
                    <?php echo FootManager\Helpers\Layout::render('stats.serie', array("matches" => $team1_last_matches, "team" => $team1, "class" => "fm-bulls-large" )); ?>
                </div>

                <div>
                    <?php echo FootManager\Helpers\Layout::render('stats.serie', array("matches" => $team2_last_matches, "team" => $team2, "class" => "fm-bulls-large" )); ?>
                </div>
            </div>

            <!-- Scored -->
            <div class="fm-row fm-scored">
                <div class="fm-text-300 fm-line-height-30 fm-text-color-green">
                    <?php echo $scored1; ?>
                </div>

                <div class="fm-text-150">
                    <?php echo JText::_("FM_SCORED"); ?>
                </div>

                <div class="fm-text-300 fm-line-height-30 fm-text-color-green">
                    <?php echo $scored2; ?>
                </div>
            </div>

            <!-- Scored -->
            <div class="fm-row fm-conceded">
                <div class="fm-text-300 fm-line-height-30 fm-text-color-dark-red">
                    <?php echo $conceded1; ?>
                </div>

                <div class="fm-text-150">
                    <?php echo JText::_("FM_CONCEDED"); ?>
                </div>

                <div class="fm-text-300 fm-line-height-30 fm-text-color-dark-red">
                    <?php echo $conceded2; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Last Matches -->
    <div class="fm-next-events">
        <!-- Title -->
        <div class="fm-title-2">
            <span>
                <?php echo JText::_("FM_NEXT_MATCHES") ?>
            </span>
        </div>

        <div class="fm-column fm-column-border">

            <!-- Events -->
            <div class="fm-row fm-row-border fm-row-responsive-tablet">
                <div>
                    <div class="fm-margin-bottom-20 fm-margin-top-15">
                        <?php echo FootManager\Helpers\Layout::render('team.name', array("team" => $team1, "params" => $params)); ?>
                    </div>
                    <?php
                    $params["myteam"] = $team1->id;
                    $params["show_score"] = false;
                    $params["show_time"] = false;
                    $params["alt_date"] = true;
                    echo FootManager\Helpers\Layout::render('html.list', array("items" => $team1_next_events, "layout" => "event.item", "component" => FM_MANAGER_COMPONENT, "params" => $params, "class" => "fm-date-top")); ?>
                </div>

                <div>
                    <div class="fm-margin-bottom-20 fm-margin-top-15">
                        <?php echo FootManager\Helpers\Layout::render('team.name', array("team" => $team2, "params" => $params)); ?>
                    </div>
                    <?php
                    $params["myteam"] = $team2->id;
                    echo FootManager\Helpers\Layout::render('html.list', array("items" => $team2_next_events, "layout" => "event.item", "component" => FM_MANAGER_COMPONENT, "params" => $params, "class" => "fm-date-top")); ?>
                </div>
            </div>
        </div>
    </div>
</div>