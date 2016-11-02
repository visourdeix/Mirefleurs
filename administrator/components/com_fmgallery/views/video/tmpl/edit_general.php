<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
?>

<div class="row-fluid">
    <div class="span9">
        <fieldset class="adminform">
            <div class="control-group">
                <div class="control-label">
                    <label id="jform_file-lbl" for="jform_file" class="hasTooltip" title="" data-original-title="<strong><?php echo JText::_("COM_FMGALLERY_FIELD_FILE_DESC") ?></strong><br /><?php echo JText::_("COM_FMGALLERY_FIELD_FILE_DESC") ?>">
                        <?php echo JText::_("COM_FMGALLERY_FIELD_FILE") ?></label>
                </div>
                <div class="controls">
                    <?php echo $this->item->file ?>
                    <br />
                    <input type="file" name="jform_file" id="jform_file">
                </div>
            </div>
            <?php echo $this->form->renderField('thumb'); ?>
            <?php echo $this->form->renderField('date'); ?>
            <?php echo $this->form->getLabel('description'); ?>
            <?php echo $this->form->getInput('description'); ?>
        </fieldset>
    </div>
    <div class="span3">
        <?php echo JLayoutHelper::render('joomla.edit.global', $this); ?>
    </div>
</div>