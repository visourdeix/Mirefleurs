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

    $previousMatchProperty = "previousMatch".$i;
    $previousMatch = $this->item->$previousMatchProperty;
?>

<legend>
    <?php echo $team->name ?>
</legend>

<!-- Actions -->
<div class="btn-toolbar fm-margin-bottom-15">

    <!-- Edit Roster -->
    <?php if($this->canEditRoster($team->category_id)) : ?>
    <?php echo FootManager\UI\Html\Button::link(JRoute::_("index.php?option=".FM_MANAGER_COMPONENT."&task=roster.edit&id=".$roster->id), "COM_FMMANAGER_ADD_NEW_PERSONS_IN_ROSTER", "", array("class" => "btn-small btn-info btn-wrapper", "target" => "_blank")) ?>
    <?php endif; ?>

    <!-- Import Previous Match -->
    <span id='<?php echo $teamProperty."-import-from-previous-match" ?>' class="btn btn-small btn-primary btn-wrapper <?php echo $previousMatch ? '' : 'disabled' ?>" href="#">
        <?php echo JText::_("COM_FMMANAGER_IMPORT_FROM_PREVIOUS_MATCH") ?>
    </span>

    <!-- Import Call Up -->
    <span id='<?php echo $teamProperty."-import-from-call-up" ?>' class="btn btn-small btn-primary btn-wrapper <?php echo $this->item->call_up_id ? '' : 'disabled' ?>" href="#">
        <?php echo JText::_("COM_FMMANAGER_IMPORT_FROM_CALL_UP") ?>
    </span>
</div>

<!-- Team -->
<div id="fm-teams" class="row-fluid">
    <div class="span8">

        <!-- Players -->
        <legend class="center">
            <small>
                <?php echo JText::_("COM_FMMANAGER_LEGEND_PLAYERS") ?>
            </small>
        </legend>

        <div id="fm-players-<?php echo $i ?>">

            <?php echo $this->form->renderField("tactic".$i."_id"); ?>

            <div id="fm-match-players<?php echo $i ?>" style="max-width:100%;overflow-x:auto;overflow-y:hidden">
                <?php echo $this->form->getField("players".$i)->input; ?>
            </div>

            <div id="fm-match-tactic<?php echo $i ?>">
                <div class="pull-left fm-margin-right-10 fm-margin-bottom-10">
                    <?php echo $this->form->getField("firstTeamPlayers".$i)->input; ?>
                </div>
                <div class="pull-left">
                    <legend>
                        <small>
                            <?php echo JText::_("COM_FMMANAGER_LEGEND_SUBSTITUTES"); ?>
                        </small>
                    </legend>
                    <?php echo $this->form->getField("substitutes".$i)->input; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="span4">
        <!-- Staff -->
        <legend class="center">
            <small>
                <?php echo JText::_("COM_FMMANAGER_LEGEND_STAFF") ?>
            </small>
        </legend>
        <div style="max-width: 100%; overflow-x: auto; overflow-y: hidden">
            <?php echo $this->form->getField("staff".$i)->input; ?>
        </div>

        <!-- Substitutions -->
        <legend class="center">
            <small>
                <?php echo JText::_("COM_FMMANAGER_LEGEND_SUBSTITUTIONS") ?>
            </small>
        </legend>
        <?php echo $this->form->getField("substitutions".$i)->input; ?>
    </div>
</div>

<?php
}