<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

$stats = JArrayHelper::getValue($displayData, "stats");
$params = JArrayHelper::getValue($displayData, "params");
$ajax = JArrayHelper::getValue($params, "ajax_loading", false);
$user = JFactory::getUser();

?>

<div class="fm-stats-career fm-column">
    <?php
    $i = 1;
    foreach($stats as $season => $competitions) :
        $played = $competitions->sum("played");
        $goals = $competitions->sum("goals");
        $assists = $competitions->sum("assists");
    ?>

    <!-- Season -->
    <div class="fm-season collapsed clearfix" data-toggle="collapse" data-target="#fm-player-season-<?php echo $i ?>">
        <div class="pull-left fm-label">
            <?php echo $season ?>
        </div>
        <div class="pull-left">
            <div class="pull-left fm-value hasTooltip" title="<?php echo JText::_("FM_IN_MATCH") ?>">
                <?php echo $played ?>
                <?php echo JText::_("FM_IN_MATCH_ICON") ?>
            </div>
            <div class="pull-left fm-value hasTooltip" title="<?php echo JText::_("FM_GOALS") ?>">
                <?php echo $goals ?>
                <?php echo JText::_("FM_GOALS_ICON") ?>
            </div>
            <div class="pull-left fm-value hasTooltip" title="<?php echo JText::_("FM_ASSISTS") ?>">
                <?php echo $assists ?>
                <?php echo JText::_("FM_ASSISTS_ICON") ?>
            </div>
        </div>
        <div class="pull-right">
            <i class="fa fa-chevron-down"></i>
        </div>
    </div>

    <!-- Competitions -->
    <div id="fm-player-season-<?php echo $i ?>" class="collapse fm-competitions">

        <?php foreach($competitions as $stat) : ?>
        <div class="fm-row fm-row-responsive">
            <div class="fm-competition">
                <a href="<?php echo FmmanagerHelperRoute::competition($stat->competition, "results") ?>">
                    <div>
                        <?php echo FMManager\Html\Competition::image($stat->competition, array(), !$ajax) ?>
                    </div>
                    <div>
                        <?php echo $stat->competition->tournament->name ?>
                    </div>
                </a>
            </div>
            <div>
                <div class="fm-teams">
                    <?php echo $stat->team->small_name ?>
                </div>
                <div>
                    <div class="pull-left fm-value fm-played hasTooltip" title="<?php echo JText::_("FM_IN_MATCH") ?>">
                        <?php echo $stat->played ?>
                        <?php echo JText::_("FM_IN_MATCH_ICON") ?>
                    </div>

                    <?php if($user->authorise( "stats.view", FM_MANAGER_COMPONENT.".category." . $stat->competition->tournament->category_id )) : ?>
                    <div class="pull-left fm-value hasTooltip fm-text-color-green" title="<?php echo JText::_("FM_FIRST_TEAM_PLAYER") ?>">
                        <?php echo $stat->in_first_team ?>
                        <?php echo JText::_("FM_FIRST_TEAM_PLAYER_ICON") ?>
                    </div>
                    <div class="pull-left fm-value hasTooltip fm-text-color-orange" title="<?php echo JText::_("FM_SUBSTITUTE") ?>">
                        <?php echo $stat->substitutes ?>
                        <?php echo JText::_("FM_SUBSTITUTE_ICON") ?>
                    </div>
                    <div class="pull-left fm-value hasTooltip fm-goals" title="<?php echo JText::_("FM_GOALS") ?>">
                        <?php echo $stat->goals ?>
                        <?php echo JText::_("FM_GOALS_ICON") ?>
                    </div>
                    <div class="pull-left fm-value hasTooltip fm-assists" title="<?php echo JText::_("FM_ASSISTS") ?>">
                        <?php echo $stat->assists ?>
                        <?php echo JText::_("FM_ASSISTS_ICON") ?>
                    </div>

                    <?php foreach($stat->stats as $stat1) : ?>
                    <div class="pull-left fm-value hasTooltip" title="<?php echo $stat1->statistic->label ?>">
                        <?php echo is_int($stat1->value) ? $stat1->value : number_format($stat1->value, 2) ?>
                        <?php echo FMManager\Html\Statistic::image($stat1->statistic) ?>
                    </div>
                    <?php endforeach; ?>

                    <?php else : ?>
                    <div class="pull-left fm-text-90">
                        <?php echo FootManager\Helpers\Layout::render("system.message", array("message" => JText::_("COM_FMMANAGER_MESSAGE_NOT_ALLOWED_TO_SEE_STATS"), "color" => "error")); ?>
                    </div>
                    <?php endif ?>
                </div>
            </div>
        </div>

        <?php endforeach; ?>
    </div>

    <?php
        $i += 1;
    endforeach; ?>
</div>