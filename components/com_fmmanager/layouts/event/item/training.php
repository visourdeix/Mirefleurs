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
$show_stadium = JArrayHelper::getValue($params, "show_stadium", true);
$ajax = JArrayHelper::getValue($params, "ajax_loading", false);

?>

<?php if($event) :?>
<div class="fm-event-training">

    <div class="fm-content">
        <div>
            <!-- Stadium -->
            <?php if($show_stadium) : ?>
            <div class="fm-stadium">
                <?php echo $event->stadium->name_and_city ?>
            </div>
            <?php endif; ?>

            <!-- Time -->
            <?php if($show_time) : ?>
            <div class="fm-duration">
                <?php echo $event->time->format("G:i").' - '. $event->end_time->format("G:i"); ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php endif; ?>