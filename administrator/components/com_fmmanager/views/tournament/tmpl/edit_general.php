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
        echo $this->form->renderField("small_name");
        echo $this->form->renderField("logo");
        echo $this->form->renderField("category_id");
        echo $this->form->renderField("type_id");
        ?>
    </div>
    <div class="span6">
        <legend>
            <?php echo JText::_("COM_FMMANAGER_LEGEND_MANAGEMENT") ?>
        </legend>
        <?php
        echo $this->form->renderField("extra_time");
        echo $this->form->renderField("penalties");
        ?>
    </div>
</div>