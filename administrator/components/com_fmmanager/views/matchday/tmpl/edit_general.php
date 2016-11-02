<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
?>

<div class="row-fluid">
    <div class="span12">
        <?php
        echo $this->form->renderField("state");
        echo $this->form->renderField("date");
        echo $this->form->renderField("time");
        echo $this->form->renderField("stadium_id");
        ?>
    </div>
</div>
<div class="row-fluid">
    <div class="span12">

        <legend>
            <?php echo JText::_("COM_FMMANAGER_LEGEND_MATCHES") ?>
        </legend>
        <?php if(count($this->item->matches)) : ?>
        <?php echo $this->form->getField("matches")->input; ?>
        <?php else : ?>
        <div class="alert alert-no-items">
            <?php echo JText::_('FMLIB_MESSAGE_NO_ITEMS') ?>
        </div>
        <?php endif; ?>

        <legend class="center">
            <small>
                <?php echo JText::_("COM_FMMANAGER_LEGEND_ADD_MATCHES") ?>
            </small>
        </legend>
        <?php  if($this->actions->get("competitions.manage")) : ?>
        <?php echo \FootManager\UI\Html\Button::link(JRoute::_("index.php?option=".FM_MANAGER_COMPONENT."&task=competition.edit&id=".$this->item->competition_id), "COM_FMMANAGER_ADD_NEW_TEAMS_IN_COMPETITION", "", array("class" => "btn-small btn-info btn-wrapper fm-margin-bottom-5", "target" => "_blank")) ?>
        <?php endif; ?>
        <?php echo $this->form->getField("matchesToAdd")->input; ?>
    </div>
</div>
<div class="row-fluid">
    <div class="span12">
        <legend>
            <?php echo JText::_("COM_FMMANAGER_LEGEND_SUMMARY") ?>
        </legend>
        <?php
        echo $this->form->getField("summary")->input;
        ?>
    </div>
</div>