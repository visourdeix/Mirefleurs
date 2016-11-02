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
$show_time = JArrayHelper::getValue($params, "show_time", true);
$show_tournament = JArrayHelper::getValue($params, "show_tournament", true);
$ajax = JArrayHelper::getValue($params, "ajax_loading", false);

?>

<?php if($event) :?>
<div class="fm-event-matchday">

    <!-- Tournament -->
    <?php if($show_tournament) : ?>
    <div class="fm-tournament">
        <?php echo FMManager\Html\Competition::image($event->competition, array("class" => "fm-logo"), !$ajax); ?>
        <?php echo $event->competition->tournament->name ?>
    </div>
    <?php endif; ?>

    <div class="fm-content">
        <div class="fm-matchday">
            <?php echo $event->name ?>
        </div>

        <?php
          if($show_time && $event->state == FMManager\Constants::PLAYED && FootManager\Utilities\DateHelper::isValid($event->time)) : ?>

        <!-- Time -->
        <div class="fm-time">
            <?php echo $event->datetime->format('H:i') ?>
        </div>

        <?php endif; ?>
    </div>
</div>
<?php endif; ?>