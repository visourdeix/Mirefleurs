<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

?>

<div class="fm-event">
    <div class="fm-row fm-row-responsive">

        <div class="fm-info">
            <div class="fm-margin-bottom-5">
                <span class="fm-category" style="background-color:<?php echo $this->item->color ?>"><?php echo $this->item->category->title ?></span>
            </div>
            <div class="fm-row">
                <div>
                    <?php echo FootManager\Helpers\Layout::render("html.date", array("date" => $this->item->start_date, "layout" => "style2", "show_year" => 'right')) ?>
                </div>
                <div class="fm-time"><?php echo $this->item->start_time->format("G:i") ?></div>
            </div>

            <?php
            if(isset($this->item->end_date) && $this->item->start_date != $this->item->end_date) {
            ?>
            <div class="fm-margin-top-10">
                <?php echo JText::sprintf("COM_FMEVENTS_END_DATE", '<b>'.$this->item->end_date->format("l d F Y").'</b>', $this->item->end_time->format("G:i")); ?>
            </div>
            <?php } ?>
        </div>

        <div class="fm-photo">
            <?php echo FMEvents\Html\Event::image($this->item); ?>
        </div>
    </div>

    <!-- Description -->
    <div class="fm-title-2">
        <span>
            <?php echo JText::_("FM_DECRIPTION") ?>
        </span>
    </div>
    <?php
    if($this->item->description) :
    ?>
    ">
    <div class="fm-summary">
        <?php echo $this->item->description ?>
    </div>
    <?php else : ?>
    <?php echo FootManager\Helpers\Layout::render ('messages.nodata'); ?>
    <?php endif; ?>

    <!-- Location -->
    <div class="fm-title-2">
        <span>
            <?php echo JText::_("COM_FMEVENTS_FIELD_LOCATION") ?>
        </span>
    </div>
    <div class="fm-summary">

        <a class="fm-google-map pull-right" href="<?php echo $this->item->location->googleMap ?>" target="_blank"></a>
        <?php echo $this->item->location->address ?>
        <br />
        <?php echo $this->item->location->postal_code ?>
        <?php echo utf8_strtoupper( $this->item->location->city) ?>
    </div>

    <div id="fm-stadium-map" class="fm-map"></div>

    <?php

    $attribs["marker"]["latLng"] = "\\[".$this->item->location->latitude.",".$this->item->location->longitude."]";
    $attribs["map"]["options"]["center"] = "\\[".$this->item->location->latitude.",".$this->item->location->longitude."]";
    $attribs["map"]["options"]["zoom"] = 16;
    FootManager\UI\ui::map("#fm-stadium-map", $attribs);
    ?>
</div>