<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  mod_latest
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$filterForm = $objects["filterForm"];

?>

<div id="message" style="display: none"></div>

<div class="fm-panel">

    <div class="fm-panel-title">

        <div id="filter" class="form-inline form-inline-header">
            <?php echo $filterForm->renderField('start_date');?>
            <?php echo $filterForm->renderField('end_date');?>
            <?php echo $filterForm->renderField('states');?>
            <?php echo $filterForm->renderField('categories');?>
            <?php echo $filterForm->renderField('competition');?>
            <?php echo $filterForm->renderField('teams');?>
            <?php echo $filterForm->renderField('group_by');?>
        </div>
        <div id="toolbar" class="btn-toolbar clearfix">
            <span id="search" class="btn btn-inverse btn-wrapper pull-right">
                <i class="fa fa-search"></i>
                <?php echo '   '.JText::_("FMLIB_SEARCH") ?>
            </span>
            <span id="save" class="btn btn-success btn-wrapper pull-right" style="display: none">
                <i class="fa fa-save"></i>
                <?php echo '   '.JText::_("FMLIB_SAVE") ?>
            </span>
            <span id="refresh" class="btn btn-primary btn-wrapper pull-right" style="display: none">
                <i class="fa fa-refresh"></i>
                <?php echo '   '.JText::_("FMLIB_REFRESH") ?>
            </span>
        </div>
    </div>

    <div class="fm-panel-body">
        <div id="fm-content">
            <?php echo FootManager\Helpers\Layout::render('system.message', array("message" => JText::_("FMLIB_ERROR_NO_FILTER"), "color" => "error")); ?>
        </div>
    </div>
</div>