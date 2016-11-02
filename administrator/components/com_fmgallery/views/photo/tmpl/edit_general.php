<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
?>

<div class="row-fluid">
    <div class="span9">
        <fieldset class="adminform">
            <?php echo FootManager\Utilities\ImageHelper::render(JPATH_ROOT.DS.$this->item->file, array("style" => "max-width:500px;margin-bottom:10px;")); ?>
            <?php echo $this->form->renderField('date'); ?>
            <?php echo $this->form->getLabel('description'); ?>
            <?php echo $this->form->getInput('description'); ?>
        </fieldset>
    </div>
    <div class="span3">
        <?php echo JLayoutHelper::render('joomla.edit.global', $this); ?>
    </div>
</div>