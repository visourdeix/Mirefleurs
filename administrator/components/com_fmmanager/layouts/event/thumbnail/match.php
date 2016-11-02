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
$show_name = JArrayHelper::getValue($params, "show_name", "small_name");
$show_score = JArrayHelper::getValue($params, "show_score", true);
$isEditable = JArrayHelper::getValue($params, "isEditable", false);
$ajax = JArrayHelper::getValue($params, "ajax_loading", true);

$user = \JFactory::getUser();
$canEdit = $user->authorise( "results.edit", FM_MANAGER_COMPONENT.".category." . $match->category->id);

?>
<?php if($match) : ?>
<div>

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
            <?php if(!$isEditable || !$canEdit) : ?>
            <?php
                      if($match->played) {
                          echo $match->score1;

                          if($match->matchday->competition->tournament->penalties && $match->score1 == $match->score2)
                              echo "<span class='fm-penalties'> (".$match->penalties1.")</span>";
                      } else {
                          echo "-" ;
                      }

            ?>
            <?php else : ?>
            <?php echo FootManager\UI\Html\Form::textbox(array("id" => $match->id."_score1", "name" => "matches[score1]", "class" => "fm-results-score fm-input-xxmini", "value" => $match->score1)); ?>
            <?php FootManager\UI\ui::touchspin("#".$match->id."_score1", array("verticalbuttons" => true)); ?>
            <?php endif; ?>
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

        <?php if(!$isEditable || !$canEdit) : ?>
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

        <?php else : ?>
        <?php echo FootManager\UI\Html\Form::textbox(array("id" => $match->id."_score2", "name" => "matches[score2]", "class" => "fm-results-score fm-input-xxmini", "value" => $match->score2)); ?>
        <?php FootManager\UI\ui::touchspin("#".$match->id."_score2", array("verticalbuttons" => true)); ?>
        <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>