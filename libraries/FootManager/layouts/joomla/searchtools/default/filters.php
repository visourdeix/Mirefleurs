<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

$data = $displayData;

// Load the form filters
$filters = $data['view']->filterForm->getGroup('filter');
?>
<?php if ($filters) : ?>
	<?php foreach ($filters as $fieldName => $field) : ?>
		<?php if ($fieldName != 'filter_search') : ?>
			<div class="js-stools-field-filter">
				<?php echo $field->input; ?>
			</div>
		<?php endif; ?>
	<?php endforeach; ?>
<div class="js-stools-field-filter">
            <button type="submit" class="btn btn-inverse js-stools">
				<i class="fa fa-search"></i> <?php echo JText::_('JSEARCH_FILTER_SUBMIT');?>
			</button>
    </div>
		<div class="js-stools-field-filter">
			<button type="button" class="btn btn-danger js-stools-btn-clear">
				<i class="fa fa-remove"></i> <?php echo JText::_('JSEARCH_FILTER_CLEAR');?>
			</button>
		</div>
<?php endif; ?>
