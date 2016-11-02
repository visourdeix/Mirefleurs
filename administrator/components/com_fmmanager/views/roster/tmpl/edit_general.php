<?php
// No direct access
defined('_JEXEC') or die('Restricted access');

?>
<div class="row-fluid">
    <div class="span6">
        <legend><?php echo JText::_("FMLIB_LEGEND_INFORMATIONS") ?></legend>
        <?php
        echo $this->form->renderField("photo");
        echo $this->form->renderField("relation_team_id");
        ?>
    </div>
    <div class="span6">
        <legend><?php echo JText::_("COM_FMMANAGER_LEGEND_STAFF") ?></legend>
        <?php
        echo $this->form->getField("staff")->input;
        ?>
    </div>
</div>
<div class="row-fluid">
    <div class="span9">
        <legend><?php echo JText::_("COM_FMMANAGER_LEGEND_PLAYERS") ?></legend>
        <?php
        echo $this->form->getField("players")->input;
        ?>
    </div>
</div>