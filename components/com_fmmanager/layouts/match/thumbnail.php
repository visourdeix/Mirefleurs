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
$show_tournament = JArrayHelper::getValue($params, "show_tournament", false);
$show_score = JArrayHelper::getValue($params, "show_score", true);
$ajax = JArrayHelper::getValue($params, "ajax_loading", false);

?>

<?php if($match) : ?>
<a class="fm-match-thumbnail fm-hover-panel <?php echo $class ?>" href="<?php echo FmmanagerHelperRoute::match($match) ?>">

    <!-- State -->
    <?php echo FootManager\Helpers\Layout::render("event.watermark", array("state" => $match->state)); ?>

    <div class="fm-content">
        <!-- Tournament -->
        <?php if($show_tournament) : ?>
        <div class="fm-tournament">
            <?php echo FMManager\Html\Competition::image($match->matchday->competition, array("class" => "fm-logo"), !$ajax); ?>
            <?php echo $match->matchday->competition->tournament->name ?>
        </div>
        <?php endif; ?>

        <!-- Date -->
        <?php if($show_date) : ?>
        <div class="fm-date">
            <?php echo $match->datetime->format("l d F Y - G:i"); ?>
        </div>
        <?php endif; ?>

        <!-- Team 1 -->
        <div class="fm-team-and-score <?php echo ($show_score && $match->isWinner($match->team1_id)) ? "fm-winner" : (($show_score && $match->isLooser($match->team1_id)) ? "fm-looser" : "") ?>">
            <div class="fm-logo">
                <?php echo FMManager\Html\Team::image($match->team1, array("class" => "fm-logo"), !$ajax); ?>
            </div>
            <div class="fm-team">
                <span class="<?php echo (FMManager\Helper::isMyClub($match->team1->club_id)) ? "fm-my-team" : ""?>">
                    <?php echo $match->team1->$show_name ?>
                </span>
            </div>

            <?php if($show_score) : ?>
            <div class="fm-score">
                <?php
                      if($match->played) {
                          echo $match->score1;

                          if($match->matchday->competition->tournament->penalties && $match->score1 == $match->score2)
                              echo "<span class='fm-penalties'> (".$match->penalties1.")</span>";
                      } else {
                          echo "-" ;
                      }

                ?>
            </div>
            <?php endif; ?>
        </div>

        <!-- Team 2 -->
        <div class="fm-team-and-score <?php echo ($show_score && $match->isWinner($match->team2_id)) ? "fm-winner" : (($show_score && $match->isLooser($match->team2_id)) ? "fm-looser" : "") ?>">
            <div class="fm-logo">
                <?php echo FMManager\Html\Team::image($match->team2, array("class" => "fm-logo"), !$ajax); ?>
            </div>
            <div class="fm-team">
                <span class="<?php echo (FMManager\Helper::isMyClub($match->team2->club_id)) ? "fm-my-team" : ""?>">
                    <?php echo $match->team2->$show_name ?>
                </span>
            </div>

            <?php if($show_score) : ?>
            <div class="fm-score">
                <?php
                      if($match->played) {
                          echo $match->score2;

                          if($match->matchday->competition->tournament->penalties && $match->score1 == $match->score2)
                              echo "<span class='fm-penalties'> (".$match->penalties2.")</span>";
                      } else {
                          echo "-" ;
                      }

                ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</a>
<?php endif; ?>