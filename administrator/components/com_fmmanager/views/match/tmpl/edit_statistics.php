<?php
// No direct access
defined('_JEXEC') or die('Restricted access');

for ($i = 1; $i <= 2; $i++)
{
    $rosterProperty = "roster".$i;
    $roster = $this->item->$rosterProperty;

    if(empty($roster)) continue;

    $teamProperty = "team".$i;
    $team = $this->item->$teamProperty;
?>

<legend>
    <?php echo $team->name ?>
</legend>

<!-- Actions -->
<div class="btn-toolbar fm-margin-bottom-15">
    <?php if($this->actions->get("competitions.manage"))
              echo FootManager\UI\Html\Button::link(JRoute::_("index.php?option=".FM_MANAGER_COMPONENT."&task=competition.edit&id=".$this->item->matchday->competition_id), "COM_FMMANAGER_ADD_STATISTICS_IN_COMPETITION", "", array("class" => "btn-small btn-info btn-wrapper", "target" => "_blank")) ?>
</div>

<!-- Stats -->
<div class="row-fluid">
    <div class="span12">

        <!-- Goals -->
        <legend class="center">
            <?php echo JText::_("COM_FMMANAGER_LEGEND_GOALS") ?>
        </legend>
        <?php echo $this->form->getField("goals".$i)->input; ?>

        <!-- Events -->
        <?php if($this->form->getField("playersEvents".$i) || $this->form->getField("staffEvents".$i)) : ?>
        <legend class="center">
            <?php echo JText::_("COM_FMMANAGER_LEGEND_OTHER_EVENTS") ?>
        </legend>

        <?php if($this->form->getField("playersEvents".$i)) : ?>
        <legend class="center">
            <small>
                <?php echo JText::_("COM_FMMANAGER_LEGEND_PLAYERS") ?>
            </small>
        </legend>
        <?php echo $this->form->getField("playersEvents".$i)->input; ?>
        <?php endif; ?>

        <?php if($this->form->getField("staffEvents".$i)) : ?>
        <legend class="center">
            <small>
                <?php echo JText::_("COM_FMMANAGER_LEGEND_STAFF") ?>
            </small>
        </legend>
        <?php echo $this->form->getField("staffEvents".$i)->input; ?>
        <?php endif; ?>

        <?php endif; ?>

        <!-- Statistics -->
        <?php if($this->form->getField("playersStatistics".$i) || $this->form->getField("staffStatistics".$i)) : ?>
        <legend class="center">
            <?php echo JText::_("COM_FMMANAGER_LEGEND_PERSONAL_STATISTICS") ?>
        </legend>

        <?php if($this->form->getField("playersStatistics".$i)) : ?>
        <legend class="center">
            <small>
                <?php echo JText::_("COM_FMMANAGER_LEGEND_PLAYERS") ?>
            </small>
        </legend>
        <?php echo $this->form->getField("playersStatistics".$i)->input; ?>
        <?php endif; ?>

        <?php if($this->form->getField("staffStatistics".$i)) : ?>
        <legend class="center">
            <small>
                <?php echo JText::_("COM_FMMANAGER_LEGEND_STAFF") ?>
            </small>
        </legend>
        <?php echo $this->form->getField("staffStatistics".$i)->input; ?>
        <?php endif; ?>

        <?php endif; ?>
    </div>
</div>

<?php } ?>

<?php if($this->form->getField("teamsStatistics")) : ?>
<legend class="center">
    <?php echo JText::_("COM_FMMANAGER_LEGEND_TEAMS_STATISTICS") ?>
</legend>
<?php echo $this->form->getField("teamsStatistics")->input; ?>

<?php endif; ?>