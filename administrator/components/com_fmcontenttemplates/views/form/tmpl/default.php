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
JHtml::_('behavior.formvalidator');

?>
<div>
    <div class="modal-header">
        <h3><?php echo JText::_('FMLIB_TAB_PARAMS'); ?></h3>
    </div>
    <div class="modal-body modal-batch">
        <form id="paramsform" class="form-validate">
            <?php include_once JPluginHelper::getLayoutPath("fmcontenttemplates", $this->template, "form"); ?>
        </form>
    </div>
    <div class="modal-footer">
        <?php echo FootManager\UI\Html\Button::link("#", JText::_("FMLIB_CANCEL"), "", array("id" => "fm-button-templates-cancel", "class" => "btn-small btn-danger", "onclick" => "window.parent.SqueezeBox.close();return false;")); ?>
        <?php echo FootManager\UI\Html\Button::link("#", JText::_("FMLIB_VALIDATE"), "", array("id" => "fm-button-templates-validate", "class" => "btn-small btn-success", "onclick" => "loadTemplateInParent('".$this->template."');return false;")); ?>
    </div>
</div>