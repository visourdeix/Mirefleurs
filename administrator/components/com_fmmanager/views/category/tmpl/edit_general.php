<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
?>

<div class="row-fluid">
    <div class="span6">
        <legend><?php echo JText::_("FMLIB_LEGEND_INFORMATIONS") ?></legend>
        <?php
        echo $this->form->renderField("abbreviation");
        echo $this->form->renderField("year");
        ?>
    </div>
    <div class="span6">
        <legend><?php echo JText::_("COM_FMMANAGER_LEGEND_DISPLAY") ?></legend>
        <?php
        echo $this->form->renderField("color");
        echo $this->form->renderField("in_team_name");
        echo $this->form->renderField("in_tournament_name");
        ?>
    </div>
</div>