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

?>

<div class="row-fluid">
    <?php
    $span_main = 12;
    $modules_left = FootManager\Helpers\Module::getModules(FM_MANAGER."-left");
    $modules_right = FootManager\Helpers\Module::getModules(FM_MANAGER."-right");
    $modules_tabs = FootManager\Helpers\Module::getModules(FM_MANAGER."-tabs");
    $modules_main = FootManager\Helpers\Module::getModules(FM_MANAGER."-main");

    if($modules_left) $span_main -= 4;
    if($modules_right) $span_main -= 4;
    ?>

    <?php if($modules_left) :?>
    <div class="span4">
        <?php echo FootManager\Helpers\Module::loadposition(FM_MANAGER.'-left'); ?>
    </div>
    <?php endif; ?>

    <?php if($modules_main || $modules_tabs) :?>
    <div class="span<?php echo $span_main ?>">

        <?php

              echo '<div class="fm-margin-bottom-15">';
              echo FootManager\Helpers\Module::loadposition(FM_MANAGER.'-main');
              echo '</div>';

        ?>

        <?php
              echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'tab0'));

              $i = 0;
              foreach ($modules_tabs as $module)
              {
                  echo JHtml::_('bootstrap.addTab', 'myTab', 'tab'.$i, $module->title);
                  echo JModuleHelper::renderModule($module, array());
                  echo JHtml::_('bootstrap.endTab');

                  $i += 1;
              }

              echo JHtml::_('bootstrap.endTabSet');
        ?>
    </div>
    <?php endif; ?>

    <?php if($modules_right) :?>
    <div class="span4">
        <?php echo FootManager\Helpers\Module::loadposition(FM_MANAGER.'-right'); ?>
    </div>
    <?php endif; ?>
</div>