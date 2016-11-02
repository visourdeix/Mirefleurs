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

?>

<div class="fm-stats-career fm-column">
    <?php
    $i = 1;
    foreach($stats as $season => $competitions) :
        $played = $competitions->sum(function($obj) { return count($obj->played);});
        $victories = $competitions->sum(function($obj) { return count($obj->victories);});
        $draws = $competitions->sum(function($obj) { return count($obj->draws);});
        $defeats = $competitions->sum(function($obj) { return count($obj->defeats);});
        $scored = $competitions->sum("scored");
        $conceded = $competitions->sum("conceded");
    ?>

    <!-- Season -->
    <div class="fm-season collapsed clearfix" data-toggle="collapse" data-target="#fm-staff-season-<?php echo $i ?>">
        <div class="pull-left fm-label">
            <?php echo $season ?>
        </div>
        <div class="pull-left">
            <div class="pull-left fm-value hasTooltip" title="<?php echo JText::_("FM_IN_MATCH") ?>">
                <?php echo $played ?>
                <?php echo JText::_("FM_IN_MATCH_ICON") ?>
            </div>
            <div class="pull-left fm-value hasTooltip fm-text-color-green" title="<?php echo JText::_("FM_VICTORIES") ?>">
                <?php echo $victories ?>
                <?php echo JText::_("FM_VICTORIES_SMALL") ?>
            </div>
            <div class="pull-left fm-value hasTooltip" title="<?php echo JText::_("FM_DRAWS") ?>">
                <?php echo $draws ?>
                <?php echo JText::_("FM_DRAWS_SMALL") ?>
            </div>
            <div class="pull-left fm-value hasTooltip fm-text-color-red" title="<?php echo JText::_("FM_DEFEATS") ?>">
                <?php echo $defeats ?>
                <?php echo JText::_("FM_DEFEATS_SMALL") ?>
            </div>
            <div class="pull-left fm-value hasTooltip fm-text-color-green" title="<?php echo JText::_("FM_SCORED") ?>">
                <?php echo $scored ?>
                <span class="fa fa-futbol-o"></span>
            </div>
            <div class="pull-left fm-value hasTooltip fm-text-color-red" title="<?php echo JText::_("FM_CONCEDED") ?>">
                <?php echo $conceded ?>
                <span class="fa fa-futbol-o"></span>
            </div>
        </div>
        <div class="pull-right">
            <i class="fa fa-chevron-down"></i>
        </div>
    </div>

    <!-- Competitions -->
    <div id="fm-staff-season-<?php echo $i ?>" class="collapse fm-competitions">

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
                    <?php echo $stat->team->small_name; ?>
                </div>
                <div>
                    <div class="pull-left fm-value fm-played hasTooltip" title="<?php echo JText::_("FM_IN_MATCH") ?>">
                        <?php echo count($stat->played) ?>
                        <?php echo JText::_("FM_IN_MATCH_ICON") ?>
                    </div>

                    <div class="pull-left fm-value hasTooltip fm-victories fm-text-color-green" title="<?php echo JText::_("FM_VICTORIES") ?>">
                        <?php echo count($stat->victories) ?>
                        <?php echo JText::_("FM_VICTORIES_SMALL") ?>
                    </div>
                    <div class="pull-left fm-value hasTooltip fm-draws" title="<?php echo JText::_("FM_DRAWS") ?>">
                        <?php echo count($stat->draws) ?>
                        <?php echo JText::_("FM_DRAWS_SMALL") ?>
                    </div>
                    <div class="pull-left fm-value hasTooltip fm-defeats fm-text-color-red" title="<?php echo JText::_("FM_DEFEATS") ?>">
                        <?php echo count($stat->defeats) ?>
                        <?php echo JText::_("FM_DEFEATS_SMALL") ?>
                    </div>
                    <div class="pull-left fm-value hasTooltip fm-scored fm-text-color-green" title="<?php echo JText::_("FM_SCORED") ?>">
                        <?php echo $stat->scored ?>
                        <span class="fa fa-futbol-o"></span>
                    </div>
                    <div class="pull-left fm-value hasTooltip fm-conceded fm-text-color-red" title="<?php echo JText::_("FM_CONCEDED") ?>">
                        <?php echo $stat->conceded ?>
                        <span class="fa fa-futbol-o"></span>
                    </div>
                </div>
            </div>
        </div>

        <?php endforeach; ?>
    </div>

    <?php
        $i += 1;
    endforeach; ?>
</div>