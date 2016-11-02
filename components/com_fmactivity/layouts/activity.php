<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  mod_latest
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$activity = JArrayHelper::getValue($displayData, "item");
$params = JArrayHelper::getValue($displayData, "params", array());
$show_date = JArrayHelper::getValue($params, "show_date", true);
$show_category = JArrayHelper::getValue($params, "show_category", true);
$show_description = JArrayHelper::getValue($params, "show_description", false);
$show_header = JArrayHelper::getValue($params, "show_header", true);

?>

<?php if($activity->itemLink) : ?>
<a href="<?php echo JRoute::_($activity->itemLink) ?>" class="fm-activity-item fm-hover-panel fm-hover-panel-vertical">
    <?php else : ?>
    <div class="fm-activity-item">
        <?php endif; ?>

        <div class="fm-row fm-content">

            <?php if($show_header) : ?>
            <div class="fm-activity-header">
                <?php echo $activity->header ?>
            </div>
            <?php endif; ?>

            <div class="fm-activity-content">
                <?php if($show_date) : ?>
                <div class="fm-activity-date pull-right">
                    <?php echo FootManager\Utilities\DateHelper::getRelativeDate($activity->date) ?>
                </div>
                <?php endif; ?>
                <?php if($show_category && $activity->category) : ?>
                <span class="fm-activity-category" style="background-color:<?php echo $activity->color ?>">
                    <?php echo $activity->category ?>
                </span>
                <?php endif; ?>
                <div class="fm-activity-title">
                    <?php echo $activity->text ?>
                </div>
                <?php if($show_description) : ?>
                <div class="fm-activity-description">
                    <?php echo $activity->description ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    <?php if($activity->itemLink) : ?>
</a>
<?php else : ?>
</div>
<?php endif; ?>