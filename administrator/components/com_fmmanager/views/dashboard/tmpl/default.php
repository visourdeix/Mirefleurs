<?php
/**
 * @package      Fmmanager
 * @subpackage   Dashboard
 *
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 **/

defined('_JEXEC') or die();

JHtml::_('behavior.tooltip');

?>

<div class="row-fluid">

    <!-- Sidebar -->
    <div id="j-sidebar-container" class="span2">
        <?php echo $this->sidebar; ?>
    </div>

    <div id="j-main-container" class="span10">
        <div class="row-fluid">

            <!-- Body -->
            <div class="span12">
                <?php echo $this->loadTemplate("body"); ?>
            </div>
        </div>
    </div>
</div>