<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

$position = JArrayHelper::getValue($displayData, "position");
$class = JArrayHelper::getValue($displayData, "class", "");
?>

<?php if($position) : ?>
<span class="fm-person-position hasTooltip <?php echo $class ?>" title="<?php echo $position->label ?>">
    <?php echo substr($position->label, 0, 1) ?>
</span>
<?php endif; ?>