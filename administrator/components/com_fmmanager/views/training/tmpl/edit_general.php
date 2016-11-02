<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
?>

<div class="row-fluid">
    <div class="span6">
        <legend><?php echo JText::_("FMLIB_LEGEND_INFORMATIONS") ?></legend>
        <?php
        echo $this->form->renderField("state");
        echo $this->form->renderField("rosters");
        echo $this->form->renderField("stadium_id");
        ?>
    </div>
</div>
<div class="row-fluid">
    <div class="span12">
        <legend><?php echo JText::_("COM_FMMANAGER_LEGEND_DESCRIPTION") ?></legend>
        <?php
        echo $this->form->getField("description")->input;
        ?>
    </div>
</div>