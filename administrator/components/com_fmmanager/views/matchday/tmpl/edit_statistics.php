<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
?>

<!-- Actions -->
<div class="btn-toolbar fm-margin-bottom-15">
    <?php if($this->actions->get("competitions.manage")) : ?>
    <?php echo \FootManager\UI\Html\Button::link(JRoute::_("index.php?option=".FM_MANAGER_COMPONENT."&task=competition.edit&id=".$this->item->competition_id), "COM_FMMANAGER_ADD_STATISTICS_IN_COMPETITION", "", array("class" => "btn-small btn-info btn-wrapper", "target" => "_blank")) ?>
    <?php endif; ?>
</div>

<div class="row-fluid">
    <div class="span12">

        <!-- Statistics -->
        <?php if($this->form->getField("playersStatistics")) : ?>
        <legend class="center">
            <?php echo JText::_("COM_FMMANAGER_LEGEND_PLAYERS") ?>
        </legend>
        <?php echo $this->form->getField("playersStatistics")->input; ?>
        <?php endif; ?>

        <?php if($this->form->getField("teamsStatistics")) : ?>
        <legend class="center">
            <?php echo JText::_("COM_FMMANAGER_LEGEND_TEAMS_STATISTICS") ?>
        </legend>
        <?php echo $this->form->getField("teamsStatistics")->input; ?>

        <?php endif; ?>
    </div>
</div>