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
$tactic1 = JArrayHelper::getValue($displayData, "tactic1");
$tactic2 = JArrayHelper::getValue($displayData, "tactic2");
$players1 = JArrayHelper::getValue($displayData, "players1", new FootManager\Database\Eloquent\Collection());
$players2 = JArrayHelper::getValue($displayData, "players2", new FootManager\Database\Eloquent\Collection());
$staff1 = JArrayHelper::getValue($displayData, "staff1", new FootManager\Database\Eloquent\Collection());
$staff2 = JArrayHelper::getValue($displayData, "staff2", new FootManager\Database\Eloquent\Collection());
$params = JArrayHelper::getValue($displayData, "params",  array());
$ajax = JArrayHelper::getValue($displayData, "ajax_loading",  true);

$first_team_players1 = $players1->filter(function($obj) { return $obj->state == FMManager\Constants::FIRST_TEAM_PLAYER; });
$first_team_players2 = $players2->filter(function($obj) { return $obj->state == FMManager\Constants::FIRST_TEAM_PLAYER; });

$in_match_players1 = $players1->filter(function($obj) { return $obj->state == FMManager\Constants::IN_MATCH; });
$in_match_players2 = $players2->filter(function($obj) { return $obj->state == FMManager\Constants::IN_MATCH; });

$substitutes1 = $players1->filter(function($obj) { return $obj->state == FMManager\Constants::SUBSTITUTE; });
$substitutes2 = $players2->filter(function($obj) { return $obj->state == FMManager\Constants::SUBSTITUTE; });

?>

<?php if(isset($team1) && isset($team2)) : ?>

<div class="fm-match-info-teams">
    <?php if(count($players1) || count($players2) || count($staff1) || count($staff2)) :  ?>
    <div class="fm-teams">

        <div class="fm-row fm-row-responsive-tablet">

            <?php if(count($substitutes1) || count($staff1) || count($in_match_players1)) : ?>

            <!-- Team 1 -->
            <div class="fm-team1">

                <!-- Title -->
                <?php echo  FootManager\Helpers\Layout::render('team.name', array("team" => $team1, "params" => $params)); ?>

                <!-- First Team Players 1 -->
                <?php if(empty($tactic1)) : ?>
                <?php echo FootManager\Helpers\Layout::render('match.info.persons', array("persons" => $in_match_players1, "params" => $params)); ?>
                <?php echo FootManager\Helpers\Layout::render('match.info.persons', array("persons" => $first_team_players1, "title" => "FM_FIRST_TEAM_PLAYERS", "params" => $params)); ?>
                <?php endif; ?>

                <!-- Substitutes 1 -->
                <?php echo FootManager\Helpers\Layout::render('match.info.persons', array("persons" => $substitutes1, "title" => "FM_SUBSTITUTES", "params" => $params)); ?>

                <!-- Staff 1 -->
                <?php echo FootManager\Helpers\Layout::render('match.info.persons', array("persons" => $staff1, "title" => "FM_STAFF", "params" => $params)); ?>
            </div>

            <?php endif; ?>

            <!-- Tactics -->
            <div class="fm-tactics <?php echo (empty($tactic1) && empty($tactic2)) ? "fm-hidden-tablet-max" : "" ?>">

                <!-- Tactic 1 -->
                <div class="fm-tactic">
                    <div class="fm-logo" style="background-image:url(<?php echo \FMManager\Helper::getClubLogo($team1->club->logo) ?>)"></div>
                    <?php echo FootManager\Helpers\Layout::render('match.info.tactic', array("color" => $team1->home_color, "tactic" => $tactic1, "players" => $first_team_players1, "params" => $params)); ?>
                </div>

                <!-- Tactic 2 -->
                <div class="fm-tactic">
                    <div class="fm-logo" style="background-image:url(<?php echo \FMManager\Helper::getClubLogo($team2->club->logo) ?>)"></div>
                    <?php echo FootManager\Helpers\Layout::render('match.info.tactic', array("color" => $team2->away_color, "tactic" => $tactic2, "players" => $first_team_players2, "inverse" => true, "params" => $params)); ?>
                </div>
            </div>

            <?php if((count($substitutes1) || count($staff1) || count($in_match_players1)) && (count($substitutes2) || count($staff2) || count($in_match_players2))) : ?>
            <div class="fm-row fm-row-border">
                <?php endif; ?>

                <?php if(count($substitutes1) || count($staff1) || count($in_match_players1)) : ?>

                <!-- Team 1 (Phone) -->
                <div class="fm-team1-phone">

                    <!-- Title -->
                    <?php echo  FootManager\Helpers\Layout::render('team.name', array("team" => $team1, "params" => $params)); ?>

                    <!-- First Team PLayers 1 -->
                    <?php if(empty($tactic1)) : ?>
                    <?php echo FootManager\Helpers\Layout::render('match.info.persons', array("persons" => $in_match_players1, "params" => $params)); ?>
                    <?php echo FootManager\Helpers\Layout::render('match.info.persons', array("persons" => $first_team_players1, "title" => "FM_FIRST_TEAM_PLAYERS", "params" => $params)); ?>
                    <?php endif; ?>

                    <!-- Substitutes 1 -->
                    <?php echo FootManager\Helpers\Layout::render('match.info.persons', array("persons" => $substitutes1, "title" => "FM_SUBSTITUTES", "params" => $params)); ?>

                    <!-- Staff 1 -->
                    <?php echo FootManager\Helpers\Layout::render('match.info.persons', array("persons" => $staff1, "title" => "FM_STAFF", "params" => $params)); ?>
                </div>

                <?php endif; ?>

                <?php if(count($substitutes2) || count($staff2) || count($in_match_players2)) : ?>

                <!-- Team 2 -->
                <div class="fm-team2">

                    <!-- Title -->
                    <?php echo  FootManager\Helpers\Layout::render('team.name', array("team" => $team2, "params" => $params)); ?>

                    <!-- First Team PLayers 2 -->
                    <?php if(empty($tactic2)) : ?>
                    <?php echo FootManager\Helpers\Layout::render('match.info.persons', array("persons" => $in_match_players2, "inverse" => true, "params" => $params)); ?>
                    <?php echo FootManager\Helpers\Layout::render('match.info.persons', array("persons" => $first_team_players2, "title" => "FM_FIRST_TEAM_PLAYERS", "inverse" => true, "params" => $params)); ?>
                    <?php endif; ?>

                    <!-- Substitutes 2 -->
                    <?php echo FootManager\Helpers\Layout::render('match.info.persons', array("persons" => $substitutes2, "title" => "FM_SUBSTITUTES", "inverse" => true, "params" => $params)); ?>

                    <!-- Staff 2 -->
                    <?php echo FootManager\Helpers\Layout::render('match.info.persons', array("persons" => $staff2, "title" => "FM_STAFF", "inverse" => true, "params" => $params)); ?>
                </div>

                <?php endif; ?>

                <?php if((count($substitutes1) || count($staff1) || count($in_match_players1)) && (count($substitutes2) || count($staff2) || count($in_match_players2))) : ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php else : ?>
    <?php echo FootManager\Helpers\Layout::render('messages.nodata') ?>
    <?php endif; ?>
</div>

<?php endif; ?>