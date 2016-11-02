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

<div class="fm-stadium">
    <div class="fm-row fm-row-responsive">

        <div class="fm-photo">
            <?php echo FMManager\Html\Stadium::image($this->item); ?>
        </div>
        <div class="fm-info">

            <div class="fm-title-2 fm-margin-top-0">
                <span>
                    <?php echo JText::_("FM_ADDRESS") ?>
                </span>
            </div>
            <div class="fm-summary">
                <?php echo $this->item->address ?>
                <br />
                <?php echo $this->item->postal_code ?>
                <?php echo utf8_strtoupper( $this->item->city) ?>
                <div class="text-center">
                    <a class="fm-google-map" href="<?php echo $this->item->googleMap ?>" target="_blank"></a>
                </div>
            </div>

            <div class="fm-title-2">
                <span>
                    <?php echo JText::_("FM_GROUND") ?>
                </span>
            </div>
            <div class="fm-ground" style="background-image:url(<?php echo \FMManager\Helper::getGroundImage($this->item->ground->image) ?>)" title="<?php echo $this->item->ground->label ?>"></div>
        </div>
    </div>

    <!-- Map -->
    <div class="fm-title-2">
        <span>
            <?php echo JText::_("FM_MAP") ?>
        </span>
    </div>
    <div id="fm-stadium-map" class="fm-map"></div>

    <?php
    $attribs["marker"]["latLng"] = "\\[".$this->item->latitude.",".$this->item->longitude."]";
    $attribs["map"]["options"]["center"] = "\\[".$this->item->latitude.",".$this->item->longitude."]";
    $attribs["map"]["options"]["zoom"] = 16;
    FootManager\UI\ui::map("#fm-stadium-map", $attribs);
    ?>

    <!-- Description -->
    <div class="fm-title-2">
        <span>
            <?php echo JText::_("FM_DECRIPTION") ?>
        </span>
    </div>
    <?php
    if($this->item->description) :
    ?>
    <div class="fm-summary">
        <?php echo $this->item->description ?>
    </div>
    <?php else : ?>
    <?php echo FootManager\Helpers\Layout::render ('messages.nodata'); ?>
    <?php endif; ?>
</div>