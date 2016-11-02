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
$show_logo = JArrayHelper::getValue($params, "show_logo", true);
$ajax = JArrayHelper::getValue($params, "ajax_loading", false);

?>

<?php if($match) : ?>
<div class="fm-matchday-header-match <?php echo $class ?>">

    <!-- Logo 1 -->
    <?php if($show_logo) : ?>
    <div class="fm-logo">
        <?php echo FMManager\Html\Team::image($match->team1, array("class" => "fm-logo"), !$ajax); ?>
    </div>
    <?php endif; ?>

    <!-- Team 1 -->
    <div class="fm-team text-right <?php echo ($match->isWinner($match->team1_id)) ? "fm-winner" : (($match->isLooser($match->team1_id)) ? "fm-looser" : "") ?>">
        <?php echo $match->team1->$show_name ?>
    </div>

    <!-- Score -->
    <div>
        <div class="fm-score fm-badge fm-badge-metal fm-badge-small fm-badge-number">
            <?php if($match->played) : ?>
            <?php echo $match->score1.'<span>-</span>'.$match->score2 ?>
            <?php else : ?>
            <?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Team 2 -->
    <div class="fm-team <?php echo ($match->isWinner($match->team2_id)) ? "fm-winner" : (($match->isLooser($match->team2_id)) ? "fm-looser" : "") ?>">
        <?php echo $match->team2->$show_name ?>
    </div>

    <!-- Logo 2 -->
    <?php if($show_logo) : ?>
    <div class="fm-logo">
        <?php echo FMManager\Html\Team::image($match->team2, array("class" => "fm-logo"), !$ajax); ?>
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>