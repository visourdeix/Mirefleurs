<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
?>

<div class="row-fluid">
    <div class="span6">
        <legend>
            <?php echo JText::_("FMLIB_LEGEND_INFORMATIONS") ?>
        </legend>
        <?php
        echo $this->form->renderField("abbreviation");
        echo $this->form->renderField("image");
        echo $this->form->renderField("color");
        ?>
    </div>
    <div class="span6">
        <legend>
            <?php echo JText::_("COM_FMMANAGER_LEGEND_MANAGEMENT") ?>
        </legend>
        <?php
        echo $this->form->renderField("by_player");
        echo $this->form->renderField("by_staff");
        echo $this->form->renderField("by_team");
        echo $this->form->renderField("by_match");
        echo $this->form->renderField("by_matchday");
        echo $this->form->renderField("calculation");
        echo $this->form->renderField("unit");
        echo $this->form->renderField("is_event");
        ?>
    </div>
</div>