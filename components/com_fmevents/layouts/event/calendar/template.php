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

?>

<?php if($event) : ?>
<div class="fm-event-calendar">

    <?php if($event->state_2 == FootManager\Constants::REPORTED) : ?>
    <?php echo FootManager\Helpers\Layout::render("html.watermark", array("class" => "fm-reported", "text" => JText::_("FMLIB_REPORTED"))) ?>
    <?php endif; ?>

    <?php if($event->state_2 == FootManager\Constants::CANCELLED) : ?>
    <?php echo FootManager\Helpers\Layout::render("html.watermark", array("class" => "fm-cancelled", "text" => JText::_("FMLIB_CANCELLED"))) ?>
    <?php endif; ?>

    <?php if($event->state_2 == FootManager\Constants::STOPPED) : ?>
    <?php echo FootManager\Helpers\Layout::render("html.watermark", array("class" => "fm-stopped", "text" => JText::_("FMLIB_STOPPED"))) ?>
    <?php endif; ?>

    <div class="fm-content text-center">
        <!-- Title -->
        <div class="fm-event-title">
            <?php echo $event->title ?>
        </div>

        <!-- Location -->
        <?php if($event->location) : ?>
        <div class="fm-location">
            <a href="<?php echo $event->location->googleMap ?>" target="_blank">
                <i class="fa fa-map-marker"></i>
                <?php echo $event->location->name_and_city ?>
            </a>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>