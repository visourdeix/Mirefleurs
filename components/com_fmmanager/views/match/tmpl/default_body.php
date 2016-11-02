<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$show_before_match = true;
$show_call_up = ($this->item->state == FMManager\Constants::NOT_PLAYED && $this->item->call_up_id > 0);
$show_teams = ($this->item->played && ($this->item->isMyEvent() || $this->item->roster1 || $this->item->roster2));
$show_summary = $this->item->played && ($this->item->isMyEvent() || $this->item->summary);
$show_stats = ($this->item->played);
$show_results = true;
$show_ranking = ($this->item->matchday->competition->tournament->type->has_ranking);

$initialTab = ($show_teams) ? "li#fm-teams-tab" : (($show_call_up) ? "li#fm-callUp-tab" : "li#fm-beforeMatch-tab");

?>

<div class="fm-match">

    <!-- Header -->
    <?php echo FootManager\Helpers\Layout::render('match.header', array("match" => $this->item, "params" => $this->params)); ?>

    <!-- Tabs -->
    <div id="fm-tabs">
        <?php
        $tabs = array();

        if($show_call_up)
            $tabs[] = array("label" => JText::_('COM_FMMANAGER_CALL_UP'), "target" => "fm-callUp", "icon" => "fa fa-bell");

        if($show_before_match)
            $tabs[] = array("label" => JText::_('COM_FMMANAGER_BEFORE_MATCH'), "target" => "fm-beforeMatch", "icon" => "fa fa-info-circle");

        if($show_teams)
            $tabs[] = array("label" => JText::_('COM_FMMANAGER_TEAMS'), "target" => "fm-teams", "icon" => "fm-icon-tshirt");

        if($show_summary)
            $tabs[] = array("label" => JText::_('COM_FMMANAGER_SUMMARY'), "target" => "fm-summary", "icon" => "fa fa-comment");

        if($show_stats)
            $tabs[] = array("label" => JText::_('COM_FMMANAGER_STATS_SMALL'), "target" => "fm-stats", "icon" => "fm-icon-stats-dots");

        if($show_results)
            $tabs[] = array("label" => JText::_(($this->item->played) ? 'COM_FMMANAGER_RESULTS_SMALL' : 'COM_FMMANAGER_OTHER_MATCHES'), "target" => "fm-results-content", "icon" => "fa fa-calendar");

        if($show_ranking)
            $tabs[] = array("label" => JText::_('COM_FMMANAGER_RANKING_SMALL'), "target" => "fm-ranking-content", "icon" => "fa fa-bars");

        echo FootManager\Helpers\Layout::render('html.tabs', array("tabs" => $tabs, "class" => "fm-margin-top-25", "params" => array("defaultTab" => $initialTab)));
        ?>
    </div>

    <!-- Call Up -->
    <?php  if($show_call_up) : ?>
    <div id="fm-callUp"></div>
    <?php endif; ?>

    <!-- Before Match -->
    <?php  if($show_before_match) : ?>
    <div id="fm-beforeMatch">

        <!-- Face to face -->
        <div id="fm-faceToFace"></div>
    </div>
    <?php endif; ?>

    <!-- Teams -->
    <?php  if($show_teams) : ?>
    <div id="fm-teams" class="fm-padding-top-10"></div>
    <?php endif; ?>

    <!-- Summary -->
    <?php  if($show_summary) : ?>
    <div id="fm-summary" class="fm-padding-top-10">
        <?php if($this->item->summary) : ?>
        <p class="fm-summary">
            <?php echo $this->item->summary ?>
        </p>
        <?php else : ?>
        <?php echo FootManager\Helpers\Layout::render("messages.nodata"); ?>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <!-- Stats -->
    <?php  if($show_stats) : ?>
    <div id="fm-stats"></div>
    <?php endif; ?>

    <!-- Results -->
    <?php  if($show_results) : ?>
    <div id="fm-results-content">

        <!-- Link -->
        <div class="fm-margin-vertical-10 text-right">
            <a class="fm-btn-icon" href="<?php echo FmmanagerHelperRoute::competition($this->item->matchday->competition, "results") ?>">
                <span class="fa fa-calendar"></span>
                <span>
                    <?php echo JText::_("COM_FMMANAGER_SEE_ALL_RESULTS") ?>
                </span>
            </a>
        </div>

        <!-- Body -->
        <div id="fm-results"></div>
    </div>
    <?php endif; ?>

    <!-- Ranking -->
    <?php  if($show_ranking) : ?>
    <div id="fm-ranking-content">

        <!-- Link -->
        <div class="fm-margin-vertical-10 text-right">
            <a class="fm-btn-icon" href="<?php echo FmmanagerHelperRoute::competition($this->item->matchday->competition, "ranking") ?>">
                <span class="fa fa-bars"></span>
                <span>
                    <?php echo JText::_("COM_FMMANAGER_SEE_FINAL_RANKING") ?>
                </span>
            </a>
        </div>

        <!-- Body -->
        <div id="fm-ranking"></div>
    </div>
    <?php endif; ?>
</div>