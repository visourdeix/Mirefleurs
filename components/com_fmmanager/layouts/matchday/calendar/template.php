<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$matchday = JArrayHelper::getValue($displayData, "event");

?>

<?php if($matchday) : ?>
<div class="fm-matchday-calendar">

    <!-- State -->
    <?php echo FootManager\Helpers\Layout::render("event.watermark", array("state" => $matchday->state), '', array("component" => FM_MANAGER_COMPONENT)); ?>

    <div class="fm-content text-center">
        <!-- Tournament -->
        <div class="fm-tournament">
            <?php echo FMManager\Html\Competition::image($matchday->competition, array("class" => "fm-logo", "style" => "width:auto"), false); ?>
            <?php echo $matchday->competition->tournament->name ?>
        </div>
        <!-- Matchday -->
        <div class="fm-matchday">
            <?php echo $matchday->name ?>
        </div>

        <!-- Stadium -->
        <?php if($matchday->stadium) : ?>
        <div class="fm-stadium">
            <a href="<?php echo $matchday->stadium->googleMap ?>" target="_blank">
                <i class="fa fa-map-marker"></i>
                <?php echo $matchday->stadium->name_and_city ?>
            </a>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>