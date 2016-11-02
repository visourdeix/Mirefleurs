<?php
// No direct access
defined('_JEXEC') or die('Restricted access');

?>
<div class="row-fluid">
    <div class="span5">
        <legend>
            <?php echo JText::_("COM_FMMANAGER_LEGEND_PERIOD") ?>
        </legend>
        <?php
        echo $this->form->renderField("start_date");
        echo $this->form->renderField("end_date");
        ?>
    </div>
    <div class="span7">
        <legend>
            <?php echo JText::_("COM_FMMANAGER_FIELD_MANAGERS") ?>
        </legend>
        <?php
        echo $this->form->getInput("managers");
        ?>
    </div>
</div>