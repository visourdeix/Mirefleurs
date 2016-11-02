<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
?>

<div class="row-fluid">
    <div class="span9">
        <fieldset class="adminform">
            <?php echo $this->form->getLabel('state_2'); ?>
            <?php echo $this->form->getInput('state_2'); ?>
            <?php echo $this->form->getLabel('start_date'); ?>
            <?php echo $this->form->getInput('start_date'); ?>
            &nbsp;-&nbsp;
            <?php echo $this->form->getInput('start_time'); ?>
            <?php echo $this->form->getLabel('end_date'); ?>
            <?php
            echo $this->form->getInput('end_date'); ?>
            &nbsp;-&nbsp;
            <?php echo $this->form->getInput('end_time'); ?>
            <?php echo $this->form->getLabel('location_id'); ?>
            <?php echo $this->form->getInput('location_id'); ?>
            <?php echo $this->form->getLabel('photo'); ?>
            <?php echo $this->form->getInput('photo'); ?>
            <?php echo $this->form->getLabel('description'); ?>
            <?php echo $this->form->getInput('description'); ?>
        </fieldset>
    </div>
    <div class="span3">
        <?php echo \JLayoutHelper::render('joomla.edit.global', $this); ?>
    </div>
</div>