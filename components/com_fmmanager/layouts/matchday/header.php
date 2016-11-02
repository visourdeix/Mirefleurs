<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$matchday = JArrayHelper::getValue($displayData, "matchday");
$params = JArrayHelper::getValue($displayData, "params", array());
$class = JArrayHelper::getValue($displayData, "class", "");
$show_date = JArrayHelper::getValue($params, "show_date", true);
$show_tournament = JArrayHelper::getValue($params, "show_tournament", true);
$show_stadium = JArrayHelper::getValue($params, "show_stadium", true);
$show_link = JArrayHelper::getValue($params, "show_link", false);
$ajax = JArrayHelper::getValue($params, "ajax_loading", false);

$backgroundImage = ($matchday->stadium) ? $matchday->stadium->ground->image : "";

?>

<?php if(isset($matchday)) : ?>

<!-- Header -->
<div class="fm-event-header fm-match-header fm-matchday-header <?php echo $class ?>" style="background-image:url(<?php echo FMManager\Helper::getGroundImage($backgroundImage) ?>)">

    <!-- State -->
    <?php echo FootManager\Helpers\Layout::render("event.watermark", array("state" => $matchday->state)); ?>

    <div class="fm-content">
        <div class="fm-info" <?php echo ($show_date) ? 'style="padding-top:15px;"' : ''?>>

            <!-- Date -->
            <?php if($show_date) : ?>
            <div class="fm-date">
                <span class="fm-badge fm-badge-metal-black fm-badge-number">
                    <?php echo $matchday->datetime->format("l d F Y - G:i"); ?>
                </span>
            </div>
            <?php endif; ?>

            <!-- Tournament -->
            <?php if($show_tournament) : ?>
            <div class="fm-tournament">
                <?php echo FMManager\Html\Competition::image($matchday->competition, array("class" => "fm-logo"), !$ajax) ?>
                <?php echo $matchday->competition->tournament->name ?> - <?php echo $matchday->name ?>
            </div>
            <?php endif; ?>
        </div>

        <div>
            <?php if(count($matchday->matches)) : ?>
            <div class="fm-matchday-header-matches">
                <?php
                      foreach ($matchday->matches as $match)
                          echo $this->subLayout("match", array("match" => $match, "params" =>$params));

                ?>
            </div>
            <?php else : ?>
            <div class="fm-no-matches">
                <?php echo JText::_("FM_NO_MATCHES") ?>
            </div>
            <?php endif; ?>
        </div>

        <?php if($show_link) : ?>
        <div class="text-center">
            <a class="fm-button" href="<?php echo FmmanagerHelperRoute::matchday($matchday) ?>">
                <?php echo JText::_("FM_MATCHDAY_RESUME") ?>
            </a>
        </div>
        <?php endif; ?>

        <!-- Stadium -->
        <?php if($show_stadium && $matchday->stadium) : ?>
        <div class="fm-stadium">
            <span>
                <a href="<?php echo $matchday->stadium->google_map ?>" target="_blank" class="hasTooltip" title="<?php echo JText::_("COM_FMMANAGER_GOOGLE_MAP") ?>">
                    <i class="fa fa-map-marker"></i>
                    <?php echo $matchday->stadium->name_and_city ?>
                </a>
            </span>
        </div>
        <?php endif; ?>

        <div class="clearfix"></div>
    </div>
</div>

<?php endif; ?>