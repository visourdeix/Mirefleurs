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
        echo $this->form->renderField("gender");
        echo $this->form->renderField("birthdate");
        echo $this->form->renderField("country_id");
        ?>
        <legend>
            <?php echo JText::_("COM_FMMANAGER_LEGEND_CLUB") ?>
        </legend>
        <?php
        echo $this->form->renderField("active");
        echo $this->form->renderField("license");
        echo $this->form->renderField("category_id");
        echo $this->form->renderField("position_id");
        echo $this->form->renderField("diplomas");
        ?>
    </div>
    <div class="span6">
        <legend>
            <?php echo JText::_("COM_FMMANAGER_LEGEND_CONTACTS") ?>
        </legend>
        <?php
        echo $this->form->renderField("address");
        echo $this->form->renderField("postal_code");
        echo $this->form->renderField("city");
        echo $this->form->renderField("contacts");
        ?>
        <legend>
            <?php echo JText::_("COM_FMMANAGER_LEGEND_PHYSIC") ?>
        </legend>
        <?php
        echo $this->form->renderField("height");
        echo $this->form->renderField("weight");
        ?>
    </div>
</div>