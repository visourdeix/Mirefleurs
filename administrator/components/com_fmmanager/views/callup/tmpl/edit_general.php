<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
?>

<div class="row-fluid">
    <div class="span6">
        <legend><?php echo JText::_("FMLIB_LEGEND_INFORMATIONS") ?></legend>
        <?php
        echo $this->form->renderField("date");
        echo $this->form->renderField("time");
        echo $this->form->renderField("end_time");
        echo $this->form->renderField("stadium_id");
        ?>
        <div id="fm_callup_venue"><?php echo $this->form->renderField("venue"); ?></div>

        <legend><?php echo JText::_("COM_FMMANAGER_LEGEND_PERSONS_CONTACTS") ?></legend>
        <?php
        echo $this->form->getField("contacts")->input;
        ?>
        <legend><?php echo JText::_("COM_FMMANAGER_LEGEND_PERSONS") ?></legend>
        <?php
        echo $this->form->getField("persons")->input;
        ?>
    </div>
    <div class="span6">
        <legend><?php echo JText::_("COM_FMMANAGER_LEGEND_MORE_INFORMATIONS") ?></legend>
        <?php
        echo $this->form->getField("information")->input;
        ?>
    </div>
</div>

<?php FootManager\UI\ui::toggleVisibility("#jform_stadium_id", "", "#fm_callup_venue") ?>