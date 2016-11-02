<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$date = isset($displayData["date"]) ? $displayData["date"] : "";
$class = isset($displayData["class"]) ? $displayData["class"] : "";
$show_day = isset($displayData["show_day"]) ? $displayData["show_day"] : true;
$show_time = isset($displayData["show_time"]) ? $displayData["show_time"] : false;

?>

<?php if(FootManager\Utilities\DateHelper::isValid($date)) :
          $date = new JDate($date);
?>
<div class="fm-date-style1 <?php echo $class ?>">
    <?php if($show_day) : ?>
    <div class="fm-day">
        <?php echo $date->format("l") ?>
    </div>
    <?php endif; ?>
    <div class="fm-number-month-year">
        <div class="fm-number">
            <?php echo $date->day ?>
        </div>
        <div class="fm-month-year">
            <div class="fm-month">
                <?php echo $date->monthToString($date->month, true) ?>
            </div>
            <div class="fm-year">
                <?php echo $date->year ?>
            </div>
        </div>
    </div>
    <?php if($show_time) : ?>
    <div class="fm-time">
        <?php echo $date->format('G:i') ?>
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>