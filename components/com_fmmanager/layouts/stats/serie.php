<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$matches = JArrayHelper::getValue($displayData, "matches", array());
$team = JArrayHelper::getValue($displayData, "team", null);
$class = JArrayHelper::getValue($displayData, "class", "");

?>

<?php if(count($matches)) : ?>
<div class="fm-bulls fm-stats-serie <?php echo $class ?>">

    <?php foreach ($matches as $match) : ?>
    <?php
              $color = "";

              $description = "<div class='text-center'>";
              $description .= "<div>".$match->datetime->format("d F Y")."</div>";
              $description .= "<div>".$match->team1->small_name.JText::_("FM_VERSUS").$match->team2->small_name."</div>";
              $description .= "<div class='fm-text-bold fm-text-130'>".$match->score."</div>";
              $description .= "</div>";

              if($match->isWinner($team)) $color = "green";
              elseif($match->isLooser($team)) $color = "red";
              elseif($match->getResult($team) == FMManager\Constants::DRAW) $color = "orange";
              else continue;
    ?>
    <a class="hasTooltip fm-bull-<?php echo $color ?>" href="<?php echo FmmanagerHelperRoute::match($match); ?>" title="<?php echo $description ?>">
        <?php echo JText::_("FM_RESULT_".$match->getResult($team)."_SMALL") ?>
    </a>
    <?php endforeach; ?>
</div>
<?php else : ?>
<?php echo FootManager\Helpers\Layout::render('messages.nodata') ?>
<?php endif; ?>