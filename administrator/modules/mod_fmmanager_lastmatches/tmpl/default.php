<?php
/**
 * @package     mod_fmmanager_lastmatches
 * @subpackage  default.php
 *
 * @copyright   Copyright (C) 2016 Stéphane ANDRE. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$filterForm = $objects["filterForm"];
$show_filters = $params->get("show_filters", true);
$is_editable = $params->get("isEditable", true);
$hidden = !$show_filters && !$is_editable;

?>

<div id="message" style="display: none"></div>

<div class="fm-panel">

    <div class="fm-panel-title" <?php echo ($hidden) ? "style='display:none'" : "" ?>>

        <div id="filter" class="form-inline form-inline-header" <?php echo (!$show_filters) ? "style='display:none'" : "" ?>>
            <?php echo $filterForm->renderField('days');?>
            <?php echo $filterForm->renderField('states');?>
            <?php echo $filterForm->renderField('teams');?>
            <?php echo $filterForm->renderField('categories');?>
            <?php echo $filterForm->renderField('group_by');?>
        </div>

        <?php if($is_editable) : ?>
        <div id="toolbar" class="btn-toolbar clearfix">
            <span id="save" class="btn btn-success btn-wrapper pull-right" style="display: none">
                <i class="fa fa-save"></i>
                <?php echo '   '.JText::_("FMLIB_SAVE") ?>
            </span>
            <span id="refresh" class="btn btn-primary btn-wrapper pull-right" style="display: none">
                <i class="fa fa-refresh"></i>
                <?php echo '   '.JText::_("FMLIB_REFRESH") ?>
            </span>
        </div>
        <?php endif; ?>
    </div>

    <div class="fm-panel-body">
        <div id="fm-content"></div>
    </div>
</div>