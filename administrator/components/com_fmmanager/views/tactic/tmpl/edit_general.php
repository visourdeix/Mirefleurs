<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
?>

<div class="row-fluid">
    <div class="span6">
        <legend class="hasTooltip" title="<?php echo JText::_('COM_FMMANAGER_FIELD_POSITIONS_DESC') ?>">
            <?php echo JText::_('COM_FMMANAGER_LEGEND_POSITIONS') ?>
        </legend>
        <?php echo $this->form->getField("tacticPositions")->input; ?>
    </div>
</div>