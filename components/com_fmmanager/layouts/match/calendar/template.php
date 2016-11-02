<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$match = JArrayHelper::getValue($displayData, "event");

?>

<?php if($match) : ?>
<div class="fm-match-calendar">

    <!-- State -->
    <?php echo  FootManager\Helpers\Layout::render("event.watermark", array("state" => $match->state), '', array("component" => FM_MANAGER_COMPONENT)); ?>

    <div class="fm-content text-center">
        <!-- Tournament -->
        <div class="fm-tournament">
            <?php echo FMManager\Html\Competition::image($match->matchday->competition, array("class" => "fm-logo", "style" => "width:auto"), false); ?>
            <?php echo $match->matchday->competition->tournament->name ?>
        </div>
        <!-- Matchday -->
        <div class="fm-matchday">
            <?php echo $match->matchday->name ?>
        </div>

        <div class="fm-row">

            <div>
                <div class="fm-column fm-team">
                    <div class="fm-logo">
                        <?php echo FMManager\Html\Team::image($match->team1, array(), false); ?>
                    </div>
                    <div>
                        <?php echo $match->team1->small_name ?>
                    </div>
                </div>
            </div>

            <div>
                <div>
                    <span class="fm-score">
                        <?php
          if($match->played)
              echo $match->score;
          else
              echo JText::_("FM_VERSUS")
                        ?>
                    </span>
                </div>
            </div>

            <div>
                <div class="fm-column fm-team">
                    <div class="fm-logo">
                        <?php echo FMManager\Html\Team::image($match->team2, array(), false); ?>
                    </div>
                    <div>
                        <?php echo $match->team2->small_name ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stadium -->
        <?php if($match->stadium) : ?>
        <div class="fm-stadium">
            <a href="<?php echo $match->stadium->googleMap ?>" target="_blank">
                <i class="fa fa-map-marker"></i>
                <?php echo $match->stadium->name_and_city ?>
            </a>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>