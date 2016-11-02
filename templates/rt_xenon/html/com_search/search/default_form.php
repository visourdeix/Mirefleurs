<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_search
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

jimport('FootManager.framework');
JHtml::_('bootstrap.tooltip');

$lang = JFactory::getLanguage();
$upper_limit = $lang->getUpperLimitSearchWord();
?>
<form id="searchForm" class="clearfix" action="<?php echo JRoute::_('index.php?option=com_search');?>" method="post">

    <div class="btn-toolbar dir-rtl text-center">
        <div class="input-append">
            <input type="text" name="searchword" placeholder="<?php echo JText::_('COM_SEARCH_SEARCH_KEYWORD'); ?>" id="search-searchword" size="30" maxlength="<?php echo $upper_limit; ?>" value="<?php echo $this->escape($this->origkeyword); ?>" class="inputbox input-medium" />
            <button name="Search" onclick="this.form.submit()" class="btn hasTooltip" title="<?php echo JHtml::tooltipText('COM_SEARCH_SEARCH');?>">
                <span class="icon-search"></span>
                <?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?>
            </button>
        </div>
        <input type="hidden" name="task" value="search" />
        <div class="clearfix"></div>
    </div>

    <?php if ($this->params->get('search_areas', 1)) : ?>
    <!-- Button Filter -->
    <?php echo FootManager\Helpers\Layout::render("html.collapse.filter", array("target" => "fm-search-filters")); ?>

    <!-- Form Filters -->
    <div id="fm-search-filters" class="collapse fm-margin-bottom-15 fm-collapse-panel">
        <div>

            <fieldset class="phrases">
                <?php
              $searchareas_checkboxes = [];
              foreach ($this->searchareas['search'] as $val => $txt) {
                  $searchareas_checkboxes[] = array(
      "id" => "area-".$val,
      "value" => $val,
      "checked" => is_array($this->searchareas['active']) && in_array($val, $this->searchareas['active']),
      "text" => JText::_($txt),
      "icon" => "fa fa-chevron-right",
      "name" => "areas[]"
      );
              }

              echo FootManager\Helpers\Layout::render("html.checkboxes.list", array("checkboxes" => $searchareas_checkboxes));

                ?>
            </fieldset>
        </div>
    </div>

    <?php endif; ?>

    <?php if ($this->total > 0) : ?>
    <div class="form-limit pull-right">
        <label for="limit">
            <?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>
        </label>
        <?php echo $this->pagination->getLimitBox(); ?>
    </div>
    <?php endif; ?>

    <div class="searchintro<?php echo $this->params->get('pageclass_sfx'); ?>">
        <?php if (!empty($this->searchword)):?>
        <p>
            <?php echo JText::plural('COM_SEARCH_SEARCH_KEYWORD_N_RESULTS', '<span class="fm-badge fm-badge-green fm-badge-small">' . $this->total . '</span>');?>
        </p>
        <?php endif;?>
    </div>
</form>