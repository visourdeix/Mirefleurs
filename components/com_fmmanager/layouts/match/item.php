<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$match = JArrayHelper::getValue($displayData, "item");
$params = JArrayHelper::getValue($displayData, "params", array());
$class = JArrayHelper::getValue($displayData, "class", "");
$show_name = JArrayHelper::getValue($params, "show_name", "small_name");
$show_date = JArrayHelper::getValue($params, "show_date", true);
$format_date = JArrayHelper::getValue($params, "format_date", "d/m");
$show_tournament = JArrayHelper::getValue($params, "show_tournament", false);
$ajax = JArrayHelper::getValue($params, "ajax_loading", false);

?>

<?php if($match) : ?>
<a class="fm-match-item fm-hover-panel fm-hover-panel-vertical <?php echo $class ?>" href="<?php echo FmmanagerHelperRoute::match($match) ?>">

    <!-- State -->
    <?php echo FootManager\Helpers\Layout::render("event.watermark", array("state" => $match->state)); ?>

    <div class="fm-content">

        <?php if($show_date) : ?>
        <!-- Date -->
        <div class="fm-date">
            <?php echo $match->datetime->format($format_date); ?>
        </div>
        <?php endif; ?>

        <div class="fm-column">

            <!-- Tournament -->
            <?php if($show_tournament) : ?>
            <div class="fm-tournament">
                <?php echo FMManager\Html\Competition::image($match->matchday->competition, array("class" => "fm-logo"), !$ajax); ?>
                <?php echo $match->matchday->competition->tournament->name ?>
                <?php echo  ' - '; ?>
                <span class="fm-matchday">
                    <?php echo $match->matchday->name ?>
                </span>
            </div>
            <?php endif; ?>

            <div class="fm-content">

                <!-- Logo 1 -->
                <div class="fm-logo">
                    <?php echo FMManager\Html\Team::image($match->team1, array("class" => "fm-logo"), !$ajax); ?>
                </div>

                <!-- Team 1 -->
                <div class="fm-team text-right <?php echo ($match->isWinner($match->team1_id)) ? "fm-winner" : (($match->isLooser($match->team1_id)) ? "fm-looser" : "") ?>">
                    <span class="fm-team-normal <?php echo (FMManager\Helper::isMyClub($match->team1->club_id)) ? "fm-my-team" : ""?>">
                        <?php echo $match->team1->$show_name ?>
                    </span>
                    <span class="fm-team-mobile <?php echo (FMManager\Helper::isMyClub($match->team1->club_id)) ? "fm-my-team" : ""?>">
                        <?php echo $match->team1->abbreviation ?>
                    </span>
                </div>

                <?php if(!$match->played) : ?>
                <!-- Time -->
                <div class="fm-time">
                    <?php echo ($show_date) ? $match->datetime->format("G:i") : ""; ?>
                </div>
                <?php else : ?>

                <!-- Score -->
                <div class="fm-score">
                    <div>
                        <?php echo $match->score ?>
                    </div>
                    <?php if($match->penalties != "") : ?>
                    <div class="fm-penalties">
                        <?php echo "(".$match->penalties.")" ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <!-- Team 2 -->
                <div class="fm-team <?php echo ($match->isWinner($match->team2_id)) ? "fm-winner" : (($match->isLooser($match->team2_id)) ? "fm-looser" : "") ?>">
                    <span class="fm-team-normal <?php echo (FMManager\Helper::isMyClub($match->team2->club_id)) ? "fm-my-team" : ""?>">
                        <?php echo $match->team2->$show_name ?>
                    </span>
                    <span class="fm-team-mobile <?php echo (FMManager\Helper::isMyClub($match->team2->club_id)) ? "fm-my-team" : ""?>">
                        <?php echo $match->team2->abbreviation ?>
                    </span>
                </div>

                <!-- Logo 2 -->
                <div class="fm-logo">
                    <?php echo FMManager\Html\Team::image($match->team2, array("class" => "fm-logo"), !$ajax); ?>
                </div>
            </div>
        </div>
    </div>
</a>
<?php endif; ?>