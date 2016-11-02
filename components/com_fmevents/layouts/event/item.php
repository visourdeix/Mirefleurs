<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  mod_latest
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$event = JArrayHelper::getValue($displayData, "item");
$params = JArrayHelper::getValue($displayData, "params", array());
$show_date = JArrayHelper::getValue($params, "show_date", true);
$show_category = JArrayHelper::getValue($params, "show_category", true);
$show_time = JArrayHelper::getValue($params, "show_time", true);

$date = new JDate($event->start);
$time = $date->format("G:i");
$balise = $event->url ? "a" : "div";

?>

<<?php echo $balise ?> <?php echo $event->url ? 'href="'.$event->url.'"' : "" ?> class="fm-event-item <?php echo $event->url ? "fm-hover-panel fm-hover-panel-vertical" : "" ?>">

<?php if($event->state == FootManager\Constants::REPORTED) : ?>
<?php echo FootManager\Helpers\Layout::render("html.watermark", array("class" => "fm-reported", "text" => JText::_("FMLIB_REPORTED"))) ?>
<?php endif; ?>

<?php if($event->state == FootManager\Constants::CANCELLED) : ?>
<?php echo FootManager\Helpers\Layout::render("html.watermark", array("class" => "fm-cancelled", "text" => JText::_("FMLIB_CANCELLED"))) ?>
<?php endif; ?>

<?php if($event->state == FootManager\Constants::STOPPED) : ?>
<?php echo FootManager\Helpers\Layout::render("html.watermark", array("class" => "fm-stopped", "text" => JText::_("FMLIB_STOPPED"))) ?>
<?php endif; ?>

<div class="fm-row fm-content">

    <?php if($show_date) : ?>
    <div class="fm-event-date">
        <?php echo FootManager\Helpers\Layout::render("html.date", array("date" => $event->start, "layout" => "style2", "abbreviation" => true, "class" => "fm-small", "color" => $event->color)) ?>
    </div>
    <?php endif; ?>

    <div class="fm-event-content">
        <div class="fm-category-and-time">
            <?php if($show_category && $event->category) : ?>
            <span class="fm-category" style="background-color:<?php echo $event->color ?>"><?php echo $event->category ?></span>
            <?php endif; ?>
            <?php if($show_time) : ?>
            <span class="fm-time pull-right"><?php echo $time ?></span>
            <?php endif; ?>
        </div>
        <div><?php echo $event->summary ?></div>
    </div>
</div>
</<?php echo $balise ?>>