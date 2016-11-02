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
        echo $this->form->renderField("abbreviation");
        echo $this->form->renderField("logo");
        echo $this->form->renderField("city");
        echo $this->form->renderField("head_office");
        echo $this->form->renderField("colors");
        echo $this->form->renderField("person_id");
        ?>
        <legend>
            <?php echo JText::_("COM_FMMANAGER_LEGEND_CONTACT") ?>
        </legend>
        <?php
        echo $this->form->renderField("fff_form_url");
        echo $this->form->renderField("facebook");
        echo $this->form->renderField("twitter");
        echo $this->form->renderField("googleplus");
        ?>
    </div>
    <div class="span6">
        <legend>
            <?php echo JText::_("COM_FMMANAGER_LEGEND_TEAMS") ?>
        </legend>
        <?php
        echo $this->form->renderField("home_color");
        echo $this->form->renderField("away_color");
        echo $this->form->getField("teams")->input;
        ?>
    </div>
</div>