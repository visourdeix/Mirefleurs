<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$event = JArrayHelper::getValue($displayData, "item");
$params = JArrayHelper::getValue($displayData, "params", array());
$class = JArrayHelper::getValue($displayData, "class", "");
$show_date = JArrayHelper::getValue($params, "show_date", true);
$myteam = JArrayHelper::getValue($params, "myteam", 0);

?>

<?php if($event) : ?>

<a class="fm-event-item-2 fm-hover-panel fm-hover-panel-vertical <?php echo $class ?>" href="<?php echo FmmanagerHelperRoute::route($event->type, $event->id) ?>">

    <!-- State -->
    <?php echo FootManager\Helpers\Layout::render("event.watermark", array("state" => $event->state)); ?>

    <div class="fm-content">

        <!-- Date -->
        <?php if($show_date) : ?>
        <div class="fm-date">
            <?php
                  echo FootManager\Helpers\Layout::render("html.date", array("date" => $event->date, "class" => "fm-date"));
                  echo '<span class="fm-date-style1 fm-date-mobile">'.$event->date->format("l").' '.$event->date->day.' '.$event->date->monthToString($event->date->month).'</span>';
            ?>
        </div>
        <?php endif; ?>

        <!-- Body -->
        <div class="fm-body">
            <?php echo $this->subLayout($event->type, array("event" => $event, "myteam" => $myteam, "params" => $params)); ?>
        </div>
    </div>
</a>

<?php endif; ?>