<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

$address = JArrayHelper::getValue($displayData, "address");
$class = JArrayHelper::getValue($displayData, "class");
$show_value = JArrayHelper::getValue($displayData, "show_value", false);

?>

<?php if($address) : ?>

<?php if($show_value) : ?>

<div class="fm-contact <?php echo $class ?>">
    <span>
        <?php echo implode(" ", $address) ?>
    </span>
    <a class="fm-bull fm-bull-blue hasTooltip" href="<?php echo \FootManager\Helpers\Google::mapLink($address) ?>" title="<?php echo JText::_('COM_FMMANAGER_GOOGLE_MAP') ?>">
        <i class="fa fa-map-marker"></i>
    </a>
</div>

<?php else : ?>

<a class="hasTooltip fm-bull fm-bull-blue <?php echo $class ?>" href="<?php  echo \FootManager\Helpers\Google::mapLink($address) ?>" title="<?php echo JText::_('COM_FMMANAGER_GOOGLE_MAP') ?>" target="_blank">
    <i class="fa fa-map-marker"></i>
</a>

<?php endif; ?>

<?php endif; ?>