<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$show_call_up = ($this->item->matchday->state == FMManager\Constants::NOT_PLAYED && $this->item->matchday->call_up_id > 0);

$initialTab = ($show_call_up) ? "li#fm-callUp-tab" : "li#fm-matches-tab";

?>

<!-- link -->
<div class="fm-margin-bottom-15 text-right">
    <?php if($this->item->matchday->ranking_allowed) : ?>
    <a href="<?php echo FmmanagerHelperRoute::competition($this->item->matchday->competition, "ranking") ?>" class="fm-btn-icon">
        <span class="fa fa-bars"></span>
        <span>
            <?php echo JText::_("COM_FMMANAGER_SEE_FINAL_RANKING") ?>
        </span>
    </a>
    <?php endif; ?>

    <a href="<?php echo FmmanagerHelperRoute::competition($this->item->matchday->competition, "results") ?>" class="fm-btn-icon">
        <span class="fa fa-calendar"></span>
        <span>
            <?php echo JText::_("COM_FMMANAGER_SEE_ALL_RESULTS") ?>
        </span>
    </a>
</div>

<div class="fm-matchday">

    <?php echo FootManager\Helpers\Layout::render('matchday.filters', array("matchday" => $this->item->matchday, "matchdays" => $this->item->matchdays)); ?>

    <!-- Stadium -->
    <?php if($this->item->matchday->stadium_id) : ?>
    <div class="fm-stadium">
        <a class="fm-google-map" href="<?php echo $this->item->matchday->stadium->googleMap ?>" target="_blank"></a>
        <?php echo  $this->item->matchday->stadium->name_and_city ?>
    </div>
    <?php endif ?>

    <!-- Tabs -->
    <div id="fm-matchday-tabs">
        <?php
        $tabs = array();

        if($show_call_up)
            $tabs[] = array("label" => JText::_('COM_FMMANAGER_CALL_UP'), "target" => "fm-callUp", "icon" => "fa fa-bell");

        $tabs[] = array("label" => JText::_('COM_FMMANAGER_MATCHES'), "target" => "fm-matches", "tooltip" => false, "icon" => "fa fa-calendar");

        if(!$this->item->matchday->competition->tournament->type->by_match)
            $tabs[] = array("label" => JText::_('COM_FMMANAGER_SUMMARY'), "target" => "fm-summary", "icon" => "fa fa-comment");

        $tabs[] = array("label" => JText::_('COM_FMMANAGER_STATS'), "target" => "fm-stats", "icon" => "fm-icon-stats-dots");

        echo FootManager\Helpers\Layout::render('html.tabs', array("tabs" => $tabs, "params" => array("defaultTab" => $initialTab)));
        ?>
    </div>

    <!-- Call Up -->
    <?php  if($show_call_up) : ?>
    <div id="fm-callUp"></div>
    <?php endif; ?>

    <!-- Matches -->
    <div id="fm-matches" class="fm-matches fm-padding-top-20"></div>

    <!-- Summary -->
    <?php if(!$this->item->matchday->competition->tournament->type->by_match) : ?>
    <div id="fm-summary" class="fm-summary fm-margin-top-20">
        <?php if($this->item->matchday->summary) : ?>
        <?php echo $this->item->matchday->summary ?>
        <?php else : ?>
        <?php echo FootManager\Helpers\Layout::render("messages.nodata"); ?>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <!-- Stats -->
    <div id="fm-stats" class="fm-stats fm-padding-top-20"></div>
</div>