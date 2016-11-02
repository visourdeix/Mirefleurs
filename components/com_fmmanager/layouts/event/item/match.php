<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$event = JArrayHelper::getValue($displayData, "event");
$params = JArrayHelper::getValue($displayData, "params", array());
$myteam = JArrayHelper::getValue($displayData, "myteam", 0);
$show_name = JArrayHelper::getValue($params, "show_name", "small_name");
$show_time = JArrayHelper::getValue($params, "show_time", true);
$show_tournament = JArrayHelper::getValue($params, "show_tournament", true);
$show_score = JArrayHelper::getValue($params, "show_score", true);
$ajax = JArrayHelper::getValue($params, "ajax_loading", false);

?>

<?php if($event) :
          $classScore = ($event->isWinner($myteam) ? "fm-winner" : ($event->isLooser($myteam) ? "fm-looser" : ""));
?>
<div class="fm-event-match">

    <!-- Tournament -->
    <?php if($show_tournament) : ?>
    <div class="fm-tournament">
        <?php echo FMManager\Html\Competition::image($event->matchday->competition, array("class" => "fm-logo"), !$ajax); ?>
        <?php echo $event->matchday->competition->tournament->name ?>
        <?php echo  ' - '; ?>
        <span class="fm-matchday">
            <?php echo $event->matchday->name ?>
        </span>
    </div>
    <?php endif; ?>

    <div class="fm-content">

        <div class="fm-opposition">

            <!-- Logo -->
            <div class="fm-logo">
                <?php echo FMManager\Html\Team::image((($event->team1_id == $myteam) ? $event->team2 : $event->team1), array(), !$ajax); ?>
            </div>

            <!-- Teams -->
            <div class="fm-teams">
                <span class="fm-team <?php echo ($event->team1_id == $myteam) ? "fm-my-team" : "" ?>">
                    <?php echo $event->team1->$show_name ?>
                </span>
                <span class="fm-team fm-team-mobile <?php echo ($event->team1_id == $myteam) ? "fm-my-team" : "" ?>">
                    <?php echo $event->team1->abbreviation ?>
                </span>
                <span>
                    <?php echo JText::_("FM_VERSUS") ?>
                </span>
                <span class="fm-team <?php echo ($event->team2_id == $myteam) ? "fm-my-team" : "" ?>">
                    <?php echo $event->team2->$show_name ?>
                </span>
                <span class="fm-team fm-team-mobile <?php echo ($event->team2_id == $myteam) ? "fm-my-team" : "" ?>">
                    <?php echo $event->team2->abbreviation ?>
                </span>
            </div>
        </div>

        <?php if($show_score && $event->played) : ?>

        <!-- Score -->
        <div class="fm-score <?php echo $classScore ?>">
            <?php echo $event->score; ?>

            <?php if($event->penalties) : ?>
            <div class="fm-penalties">
                <?php echo $event->penalties ?>
            </div>
            <?php endif; ?>
        </div>

        <?php elseif($show_time && FootManager\Utilities\DateHelper::isValid($event->time)) : ?>

        <!-- Time -->
        <div class="fm-time">
            <?php echo $event->datetime->format('H:i') ?>
        </div>

        <?php endif; ?>
    </div>
</div>
<?php endif; ?>