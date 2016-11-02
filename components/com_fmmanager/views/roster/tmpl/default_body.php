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

<!-- Header -->
<?php echo FootManager\Helpers\Layout::render('roster.header', array("roster" => $this->item->roster, "view" => $this->getName(), "team_rosters" => $this->item->team_rosters, "season_rosters" => $this->item->season_rosters)); ?>

<div class="fm-roster">

    <!-- Photo -->
    <?php echo FMManager\Html\Roster::image($this->item->roster, array("style" => "display:block;margin:auto")); ?>

    <!-- Staff -->
    <div class="fm-title-2">
        <span>
            <?php echo JText::_("COM_FMMANAGER_STAFF_1") ?>
        </span>
    </div>

    <?php echo FootManager\Helpers\Layout::render("html.thumbnails", array("items" => $this->item->staff, "layout" => "person.thumbnail", "params" => $this->params->toArray())); ?>

    <!-- Trainings -->
    <div class="fm-title-2">
        <span>
            <?php echo JText::_("COM_FMMANAGER_TRAININGS") ?>
        </span>
    </div>

    <?php
    $maximum = 3;
    $visible_trainings = array();
    $more_trainings = array();
    $trainings = $this->item->trainings;

    if(count($trainings) > $maximum) {
        $visible_trainings = $trainings->slice(0, $maximum);
        $more_trainings = $trainings->slice($maximum, count($trainings) - $maximum);
    } else {
        $visible_trainings = $trainings;
    }

    ?>

    <div>
        <?php echo FootManager\Helpers\Layout::render("html.list", array("items" => $visible_trainings, "layout" => "event.item", "class" => "fm-small", "params" => $this->params->toArray())) ?>
    </div>
    <?php if($more_trainings) : ?>
    <div id="fm-more-trainings" class="collapse">
        <?php echo FootManager\Helpers\Layout::render("html.list", array("items" => $more_trainings, "layout" => "event.item", "class" => "fm-small", "params" => $this->params->toArray())) ?>
    </div>
    <?php echo FootManager\Helpers\Layout::render("html.collapse.more", array("target" => "fm-more-trainings")); ?>
    <?php endif; ?>

    <!-- Competitions -->
    <div class="fm-title-2">
        <span>
            <?php echo JText::_("COM_FMMANAGER_COMPETITONS") ?>
        </span>
    </div>

    <div class="fm-flex fm-competitions">
        <?php foreach($this->item->competitions as $competition) : ?>

        <?php
                  echo FootManager\Helpers\Layout::render("html.value", array("icon" => FMManager\Html\Competition::image($competition), "value" => $competition->tournament->name, "link" => FmmanagerHelperRoute::competition($competition, "results"), "params" => $this->params->toArray())); ?>
        <?php endforeach; ?>
    </div>

    <!-- Previous event -->
    <div class="fm-title-3">
        <span>
            <?php echo JText::_("COM_FMMANAGER_PREVIOUS_MATCH") ?>
        </span>
    </div>
    <?php echo FootManager\Helpers\Layout::render("html.list", array("items" => $this->item->previous_events, "layout" => "event.item", "params" => array_merge(array("myteam" => $this->item->roster->team_id), $this->params->toArray()))) ?>

    <!-- Next event -->
    <div class="fm-title-3">
        <span>
            <?php echo JText::_("COM_FMMANAGER_NEXT_MATCH") ?>
        </span>
    </div>
    <?php echo FootManager\Helpers\Layout::render("html.list", array("items" => $this->item->next_events, "layout" => "event.item", "params" => array_merge(array("myteam" => $this->item->roster->team_id), $this->params->toArray()))) ?>
</div>