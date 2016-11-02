<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  mod_latest
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>

<div class="fm-panel">

    <div id="filter" class="fm-panel-title form-inline form-inline-header">
        <?php echo \FootManager\UI\Html\Form::textboxAppend(array("name" => $id."[name]", "class" => "input-medium"), array(), 'search', false, "btn"); ?>
    </div>

    <div class="fm-panel-body">
        <div id="fm-content"></div>
    </div>
</div>