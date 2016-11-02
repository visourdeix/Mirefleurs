<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * @deprecated  3.4 Use default_batch_body and default_batch_footer
 */

defined('_JEXEC') or die;

?>
<div class="modal hide fade" id="collapseModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&#215;</button>
        <h3><?php echo JText::_('COM_FMMANAGER_BATCH_OPTIONS'); ?></h3>
    </div>
    <div class="modal-body modal-batch">
        <div class="row-fluid">
            <?php echo $this->batchForm->renderField("roster"); ?>
            <?php echo $this->batchForm->renderField("stadium"); ?>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-danger" type="button" onclick="document.getElementById('batch_stadium').value='-1';" data-dismiss="modal">
            <?php echo JText::_('JCANCEL'); ?>
        </button>
        <button class="btn btn-primary" type="submit" onclick="Joomla.submitbutton('training.batch');">
            <?php echo JText::_('JGLOBAL_BATCH_PROCESS'); ?>
        </button>
    </div>
</div>