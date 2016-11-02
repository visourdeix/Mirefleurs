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

<div class="fm-about">
    <!-- Identity tab -->
    <div class="fm-header clearfix" data-toggle="collapse" data-target="#fm-content-1">
        <div class="pull-left fm-label">
            <?php echo JText::_("COM_FMMANAGER_FIELDS_ABOUT_TAB_IDENTITY") ?>
        </div>
        <div class="pull-right">
            <i class="fa fa-chevron-down"></i>
        </div>
    </div>

    <!-- Identity -->
    <div id="fm-content-1" class="fm-content in collapse">

        <div class="fm-row fm-row-responsive">
            <div class="fm-title-about">
                <?php echo JText::_("COM_FMMANAGER_FIELDS_ABOUT_NAME") ?>
            </div>
            <div class="fm-information">
                <?php if ($this->item->club) echo $this->item->club->name; ?>
            </div>
        </div>
        <div class="fm-row fm-row-responsive">
            <div class="fm-title-about">
                <?php echo JText::_("COM_FMMANAGER_FIELDS_ABOUT_LEVEL") ?>
            </div>
            <div class="fm-information">
                <?php if ($this->item->tournament) echo $this->item->tournament->name; ?>
            </div>
        </div>
        <div class="fm-row fm-row-responsive">
            <div class="fm-title-about">
                <?php echo JText::_("COM_FMMANAGER_FIELDS_ABOUT_COLOR") ?>
            </div>
            <div class="fm-information">
                <?php if ($this->item->club) echo $this->item->club->colors; ?>
            </div>
        </div>
        <div class="fm-row fm-row-responsive">
            <div class="fm-title-about">
                <?php echo JText::_("COM_FMMANAGER_FIELDS_ABOUT_HEAD_OFFICE") ?>
            </div>
            <div class="fm-information">
                <?php if ($this->item->club) echo $this->item->club->head_office; ?>
            </div>
        </div>
        <div class="fm-row fm-row-responsive">
            <div class="fm-title-about">
                <?php echo JText::_("COM_FMMANAGER_FIELDS_ABOUT_STADIUM") ?>
            </div>
            <div class="fm-information">
                <?php if ($this->item->stadium) : ?>
                <a href="<?php echo $this->item->stadium->googleMap ?>" target="_blank">
                    <i class="fa fa-map-marker"></i>
                    <?php echo $this->item->stadium->name_and_address; ?><!--if (isset($this->item->stadium)) echo $this->item->stadium->name. " - " .$this->item->stadium->address. " " .$this->item->stadium->postal_code. " " .$this->item->stadium->city; -->
                </a>
                <?php endif ?>
            </div>
        </div>
        <div class="fm-row fm-row-responsive">
            <div class="fm-title-about">
                <?php echo JText::_("COM_FMMANAGER_FIELDS_ABOUT_CONTACT") ?>
            </div>
            <div class="fm-information">
                <?php echo FootManager\Helpers\Layout::render("person.info.contacts", array("contacts" => $this->item->contacts, "show_value" => true)); ?>
            </div>
        </div>

    </div>

    <?php
                if($this->item->club &&
                    ($this->item->club->fff_form_url != "" ||
                     $this->item->club->facebook != "" ||
                     $this->item->club->twitter != "" ||
                     $this->item->club->googleplus != "")) :
    ?>

    <!-- Social tab -->
    <div class="fm-header clearfix" data-toggle="collapse" data-target="#fm-content-2">
        <div class="pull-left fm-label">
            <?php echo JText::_("COM_FMMANAGER_FIELDS_ABOUT_TAB_SOCIAL_NETWORK") ?>
        </div>
        <div class="pull-right">
            <i class="fa fa-chevron-down"></i>
        </div>
    </div>

    <!-- Social -->
    <div id="fm-content-2" class="fm-content in collapse">

        <?php if($this->item->club->fff_form_url != "") : ?>
        <div class="fm-row fm-row-responsive">
            <div class="fm-title-about">
                <?php echo JText::_("COM_FMMANAGER_FIELDS_ABOUT_FFF_URL") ?>
            </div>
            <div class="fm-information">
                <?php echo "<a href='".$this->item->club->fff_form_url."' target='blank'>".$this->item->club->fff_form_url."</a>"; ?>
            </div>
        </div>
        <?php endif ?>
        <?php if($this->item->club->facebook != "") : ?>
        <div class="fm-row fm-row-responsive">
            <div class="fm-title-about">
                <?php echo JText::_("COM_FMMANAGER_FIELDS_ABOUT_FACEBOOK") ?>
            </div>
            <div class="fm-information">
                <?php echo $this->item->club->facebook; ?>
            </div>
        </div>
        <?php endif ?>
        <?php if($this->item->club->twitter != "") : ?>
        <div class="fm-row fm-row-responsive">
            <div class="fm-title-about">
                <?php echo JText::_("COM_FMMANAGER_FIELDS_ABOUT_TWITTER") ?>
            </div>
            <div class="fm-information">
                <?php echo $this->item->club->twitter; ?>
            </div>
        </div>
        <?php endif ?>
        <?php if($this->item->club->googleplus != "") : ?>
        <div class="fm-row fm-row-responsive">
            <div class="fm-title-about">
                <?php echo JText::_("COM_FMMANAGER_FIELDS_ABOUT_GOOGLEPLUS") ?>
            </div>
            <div class="fm-information">
                <?php echo $this->item->club->googleplus; ?>
            </div>
        </div>
        <?php endif ?>

    </div>

    <?php endif ?>

</div>