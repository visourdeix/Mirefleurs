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
<div class="modal hide fade" id="addMultipleModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&#215;</button>
        <h3><?php echo JText::_('COM_FMMANAGER_BATCH_ADD_MULTIPLE'); ?></h3>
    </div>
    <div class="modal-body modal-batch">
        <div class="row-fluid">
            <div class="span6">
                <?php echo JText::_('COM_FMMANAGER_FIELD_PERIOD'); ?>
                <br />
                <?php echo $this->addMultipleForm->getInput("start_date"); ?>
                &nbsp;&nbsp;-&nbsp;&nbsp;
            <?php echo $this->addMultipleForm->getInput("end_date"); ?>
                <?php echo $this->addMultipleForm->renderField("days"); ?>
                <?php echo JText::_('COM_FMMANAGER_FIELD_TIME'); ?>
                <br />
                <?php echo $this->addMultipleForm->getInput("start_time"); ?>
                &nbsp;&nbsp;-&nbsp;&nbsp;
            <?php echo $this->addMultipleForm->getInput("end_time"); ?>
            </div>
            <div class="span6">
                <?php echo $this->addMultipleForm->renderField("rosters"); ?>

                <?php echo $this->addMultipleForm->renderField("stadium_id"); ?>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-success" type="submit" onclick="Joomla.submitbutton('trainings.addmultiple');">
            <?php echo JText::_('JSAVE'); ?>
        </button>
    </div>
</div>