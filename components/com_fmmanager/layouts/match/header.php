<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$match = JArrayHelper::getValue($displayData, "match");
$params = JArrayHelper::getValue($displayData, "params", array());
$class = JArrayHelper::getValue($displayData, "class", "");
$show_name = JArrayHelper::getValue($params, "show_name", "small_name");
$show_date = JArrayHelper::getValue($params, "show_date", true);
$show_tournament = JArrayHelper::getValue($params, "show_tournament", true);
$show_stadium = JArrayHelper::getValue($params, "show_stadium", true);
$show_logo = JArrayHelper::getValue($params, "show_logo", true);
$show_link = JArrayHelper::getValue($params, "show_link", false);
$show_referee = JArrayHelper::getValue($params, "show_referee", true);
$show_stats = JArrayHelper::getValue($params, "show_stats", true);
$show_category = JArrayHelper::getValue($params, "show_category", true);
$score_size = JArrayHelper::getValue($params, "score_size", "large");
$show_countdown = JArrayHelper::getValue($params, "show_countdown", true);
$ajax = JArrayHelper::getValue($params, "ajax_loading", false);

$backgroundImage = ($match->stadium) ? $match->stadium->ground->image : "";

?>

<?php if(isset($match)) : ?>

<!-- Header -->
<div class="fm-event-header fm-match-header <?php echo $class ?>" style="background-image:url(<?php echo FMManager\Helper::getGroundImage($backgroundImage) ?>)">

    <!-- State -->
    <?php echo FootManager\Helpers\Layout::render("event.watermark", array("state" => $match->state)); ?>

    <div class="fm-content">
        <div class="fm-info" <?php echo ($show_date) ? 'style="padding-top:15px;"' : ''?>>

            <!-- Date -->
            <?php if($show_date) : ?>
            <div class="fm-date">
                <span class="fm-badge fm-badge-metal-black fm-badge-number">
                    <?php echo $match->datetime->format("l d F Y - G:i"); ?>
                </span>
            </div>
            <?php endif; ?>

            <!-- Tournament -->
            <?php if($show_tournament) : ?>
            <div class="fm-tournament">
                <?php echo FMManager\Html\Competition::image($match->matchday->competition, array("class" => "fm-logo"), !$ajax) ?>
                <?php echo $match->matchday->competition->tournament->name ?> - <?php echo $match->matchday->name ?>
            </div>
            <?php endif; ?>

            <!-- Category -->
            <?php if($show_category) : ?>
            <div class="fm-category" style="background-color:<?php echo $match->category->color ?>">
                <?php echo $match->category->label ?>
            </div>
            <?php endif; ?>
        </div>
        <div class="fm-teams-and-score">

            <!-- Team 1 -->
            <div class="fm-team-and-logo">

                <?php if($match->isWithdraw($match->team1)) : ?>
                <div class="fm-watermark fm-cancelled">
                    <?php echo JText::_("FM_WITHDRAW") ?>
                </div>
                <?php endif; ?>

                <div class="fm-team">
                    <?php echo $match->team1->$show_name ?>
                </div>

                <?php if($show_logo) : ?>
                <div class="fm-logo">
                    <?php echo FMManager\Html\Team::image($match->team1, array(), !$ajax); ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Score Info -->
            <div class="fm-score-info">

                <!-- Referee -->
                <?php if($match->referee && $match->played && $show_referee) : ?>
                <div class="fm-referee">
                    <?php echo JText::_("FM_REFEREE").' : '.$match->referee ?>
                </div>
                <?php endif; ?>

                <!-- Score -->
                <div class="fm-score fm-badge fm-badge-metal fm-badge-<?php echo $score_size ?> fm-badge-number">
                    <?php if($match->played) : ?>
                    <?php echo $match->score1.'<span>-</span>'.$match->score2 ?>
                    <?php else : ?>
                    <?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";?>
                    <?php endif; ?>
                </div>

                <!-- Extra Time -->
                <?php if($match->penalties != '' && $match->played) : ?>
                <div class="fm-extra-time">
                    <?php echo JText::_("FM_PENALTIES") ?>
                </div>
                <?php elseif($match->extra_time && $match->played) : ?>
                <div class="fm-extra-time">
                    <?php echo JText::_("FM_AFTER_EXTRA_TIME") ?>
                </div>
                <?php endif; ?>

                <!-- Penalties -->
                <?php if($match->penalties !== '' && $match->played) : ?>
                <div class="fm-penalties fm-badge fm-badge-metal fm-badge-small fm-badge-number">
                    <?php echo $match->penalties1.'<span>-</span>'.$match->penalties2 ?>
                </div>
                <?php endif; ?>

                <!-- Countdown -->
                <?php if($show_countdown && !$match->played && \FootManager\Utilities\DateHelper::isAfterToday($match->datetime)) : ?>
                <?php $countdown_id = uniqid(); ?>
                <span id="countdown_<?php echo $countdown_id ?>" class="fm-countdown fm-margin-top-10"></span>
                <?php
                          \FootManager\UI\Loader::countdown();
                          $script = "
                                jQuery('#countdown_".$countdown_id."').countdown('". $match->datetime->format("Y/m/d G:i:s"). "', function(event) {
                                  var res = jQuery(this).html(event.strftime(
                                    '<div><div class=\"fm-badge fm-badge-metal fm-badge-small fm-badge-number\">%D</div><div class=\"fm-label\">".JText::_("FMLIB_DAYS_SMALL")."</div></div>'
                                    + '<div><div class=\"fm-badge fm-badge-metal fm-badge-small fm-badge-number\">%H</div><div class=\"fm-label\">".JText::_("FMLIB_HOURS_SMALL")."</div></div>'
                                    + '<div><div class=\"fm-badge fm-badge-metal fm-badge-small fm-badge-number\">%M</div><div class=\"fm-label\">".JText::_("FMLIB_MINUTES_SMALL")."</div></div>'
                                    + '<div><div class=\"fm-badge fm-badge-metal fm-badge-small fm-badge-number\">%S</div><div class=\"fm-label\">".JText::_("FMLIB_SECONDS_SMALL")."</div></div>'));
                                });
                            ";
                          \FootManager\UI\Loader::jQuery($script); ?>
                <?php endif; ?>

                <!-- Links -->
                <?php if($show_link) : ?>
                <a class="fm-button" href="<?php echo FmmanagerHelperRoute::match($match) ?>">
                    <?php echo JText::_("FM_MATCH_RESUME") ?>
                </a>
                <?php endif; ?>
            </div>

            <!-- Team 2 -->
            <div class="fm-team-and-logo">

                <?php if($match->isWithdraw($match->team2)) : ?>
                <div class="fm-watermark fm-cancelled">
                    <?php echo JText::_("FM_WITHDRAW") ?>
                </div>
                <?php endif; ?>

                <div class="fm-team">
                    <?php echo $match->team2->$show_name ?>
                </div>

                <?php if($show_logo) : ?>
                <div class="fm-logo">
                    <?php echo FMManager\Html\Team::image($match->team2, array(), !$ajax); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Stats -->
        <?php if($show_stats) : ?>

        <?php if(isset($match->playersStatistics) && count($match->playersStatistics)) : ?>

        <div class="fm-row fm-match-header-stats">

            <!-- Stats 1 -->
            <div>
                <?php echo FootManager\Helpers\Layout::render('match.info.statistics', array("statistics" => $match->playersStatistics1, "class" => "text-right", "params" => $params), '', array("component" => FM_MANAGER_COMPONENT)); ?>
            </div>

            <div></div>

            <!-- Stats 2 -->
            <div>
                <?php echo FootManager\Helpers\Layout::render('match.info.statistics', array("statistics" => $match->playersStatistics2, "class" => "text-left", "params" => $params), '', array("component" => FM_MANAGER_COMPONENT)); ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Goals -->
        <?php if(isset($match->goals) && count($match->goals)) : ?>

        <div class="fm-row fm-match-header-stats">

            <!-- Goals 1 -->
            <div>
                <?php echo FootManager\Helpers\Layout::render('match.info.strikers', array("goals" => $match->goals1, "class" => "text-right", "params" => $params), '', array("component" => FM_MANAGER_COMPONENT)); ?>
            </div>

            <div></div>

            <!-- Goals 2 -->
            <div>
                <?php echo FootManager\Helpers\Layout::render('match.info.strikers', array("goals" => $match->goals2, "inverse" => true, "params" => $params), '', array("component" => FM_MANAGER_COMPONENT)); ?>
            </div>
        </div>
        <?php endif; ?>

        <?php endif; ?>

        <!-- Stadium -->
        <?php if($show_stadium && $match->stadium) : ?>
        <div class="fm-stadium">
            <span>
                <a href="<?php echo $match->stadium->google_map ?>" target="_blank" class="hasTooltip" title="<?php echo JText::_("COM_FMMANAGER_GOOGLE_MAP") ?>">
                    <i class="fa fa-map-marker"></i>
                    <?php echo $match->stadium->name_and_city ?>
                </a>
            </span>
        </div>
        <?php endif; ?>

        <div class="clearfix"></div>
    </div>
</div>

<?php endif; ?>