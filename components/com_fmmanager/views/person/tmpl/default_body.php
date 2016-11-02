<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$show_contacts = $this->item->active && ($this->item->isStaff() || $this->item->isManager());

?>

<div class="fm-person">

    <!-- Header -->
    <div class="fm-row fm-row-border fm-row-responsive">

        <!-- Photo -->
        <div class="fm-photo">
            <?php echo FMManager\Html\Person::image($this->item) ?>
        </div>

        <!-- Info -->
        <div class="fm-info fm-flex">

            <?php if($this->item->active) : ?>

            <?php
                      $flag = ($this->item->country) ? \FootManager\Utilities\ImageHelper::render(JPATH_ROOT.DS.$this->item->country->flag) : "";

                      echo FootManager\Helpers\Layout::render("html.value", array("icon" => "<i class='fa fa-globe'></i>", "value" => $flag, "title" => JText::_("COM_FMMANAGER_FIELD_COUNTRY"), "params" => $this->params));
            ?>

            <?php
                      if(\FootManager\Utilities\DateHelper::isValid($this->item->birthdate)) {
                          $date_str = $this->item->birthdate->format("d/m/y");
                      } else {
                          $date_str = "";
                      }

                      echo FootManager\Helpers\Layout::render("html.value", array("icon" => "<i class='fa fa-birthday-cake'></i>", "value" => $date_str, "title" => JText::_("COM_FMMANAGER_FIELD_BIRTHDATE"), "params" => $this->params));
            ?>

            <?php
                      $cat = ($this->item->category) ? $this->item->category->label : "";
                      echo FootManager\Helpers\Layout::render("html.value", array("icon" => "<i class='fa fa-tag'></i>", "value" => $cat, "title" => JText::_("COM_FMMANAGER_FIELD_CATEGORY"), "params" => $this->params));
            ?>

            <?php
                      $pos = ($this->item->position) ? $this->item->position->label : "";
                      echo FootManager\Helpers\Layout::render("html.value", array("icon" => "<i class='fa fa-crosshairs'></i>", "value" => $pos, "title" => JText::_("COM_FMMANAGER_FIELD_POSITION"), "params" => $this->params));
            ?>

            <?php
                      echo FootManager\Helpers\Layout::render("html.value", array("icon" => "<i class='fa fa-arrows-v'></i>", "value" => $this->item->height, "title" => JText::_("COM_FMMANAGER_FIELD_HEIGHT"), "params" => $this->params));
            ?>

            <?php
                      echo FootManager\Helpers\Layout::render("html.value", array("icon" => "<i class='fa fa-balance-scale'></i>", "value" => $this->item->weight, "title" => JText::_("COM_FMMANAGER_FIELD_WEIGHT"), "params" => $this->params));
            ?>

            <?php else : ?>
            <?php echo FootManager\Helpers\Layout::render("system.message", array("message" => JText::_("COM_FMMANAGER_ERROR_OUT_OF_CLUB"), "color" => "error")); ?>
            <?php endif ?>
        </div>
    </div>

    <!-- Contact -->
    <?php if($show_contacts) : ?>
    <div>
        <div class="fm-title-3">
            <span>
                <?php echo JText::_("COM_FMMANAGER_CONTACTS") ?>
            </span>
        </div>

        <div class="fm-person-contacts">
            <?php echo FootManager\Helpers\Layout::render("person.info.contacts", array("contacts" => $this->item->contacts, "show_value" => true)); ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Career -->
    <div id="fm-content"></div>
</div>