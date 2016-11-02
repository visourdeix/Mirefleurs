<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

use Joomla\Registry\Registry;

$data = $displayData;

// Receive overridable options
$data['options'] = !empty($data['options']) ? $data['options'] : array();

if (is_array($data['options']))
{
	$data['options'] = new Registry($data['options']);
}

$filters = $data['view']->filterForm->getGroup('filter');
$visibleFilters = $data['view']->filterForm->getGroup(false);

// Options
$filterButton = ($data['options']->get('filterButton', true) && count($filters) > 1);

// Visible Filters
 if (!empty($visibleFilters)) : ?>
<?php foreach ($visibleFilters as $fieldName => $field) : ?>
<?php if ($fieldName != 'filter_search') : ?>
<div class="js-stools-field-filter">
    <?php echo $field->input; ?>
</div>
<?php endif; ?>
<?php endforeach; ?>
<?php endif;

// Speed search
if (!empty($filters['filter_search'])) : ?>
<div class="btn-wrapper input-append">
    <?php echo $filters['filter_search']->input; ?>
    <?php if ($filters['filter_search']->description) : ?>
    <?php JHtmlBootstrap::tooltip('#filter_search', array('title' => JText::_($filters['filter_search']->description))); ?>
    <?php endif; ?>
    <button type="submit" class="btn hasTooltip" title="<?php echo JHtml::tooltipText('JSEARCH_FILTER_SUBMIT'); ?>">
        <span class="icon-search"></span>
    </button>
</div>
<?php endif; ?>

<?php if ($filterButton) : ?>
<div class="btn-wrapper hidden-phone">
    <button type="button" class="btn hasTooltip js-stools-btn-filter" title="<?php echo JHtml::tooltipText('JSEARCH_TOOLS_DESC'); ?>">
        <?php echo JText::_('JSEARCH_TOOLS');?> <span class="caret"></span>
    </button>
</div>
<?php endif; ?>