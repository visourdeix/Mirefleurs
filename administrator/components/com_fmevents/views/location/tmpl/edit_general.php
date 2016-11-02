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
        echo $this->form->renderField("photo");
        ?>
    </div>
    <div class="span6">
        <legend>
            <?php echo JText::_("COM_FMEVENTS_LEGEND_CONTACTS") ?>
        </legend>
        <?php
        echo $this->form->renderField("address");
        echo $this->form->renderField("postal_code");
        echo $this->form->renderField("city");
        ?>
        <div class="control-group">
            <a id="button-coord" class="btn btn-info">
                <?php echo JText::_("COM_FMEVENTS_GET_COORD") ?>
            </a>
        </div>
        <?php
        echo $this->form->renderField("longitude");
        echo $this->form->renderField("latitude");
        ?>
    </div>
</div>
<div class="row-fluid">
    <div class="span12">
        <legend>
            <?php echo JText::_("COM_FMEVENTS_LEGEND_DESCRIPTION") ?>
        </legend>
        <?php
        echo $this->form->getField("description")->input;
        ?>
    </div>
</div>