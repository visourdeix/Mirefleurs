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
$show_year = isset($displayData["show_year"]) ? $displayData["show_year"] : false;
$show_time = isset($displayData["show_time"]) ? $displayData["show_time"] : false;
$abbreviation = isset($displayData["abbreviation"]) ? $displayData["abbreviation"] : false;
$color = isset($displayData["color"]) ? $displayData["color"] : "";

$fontColor = ($color) ? "color:".$color.";" : "";
$backColor = ($color) ? "background-color:".$color.";" : "";
$borderColor = ($color) ? "border-color:".$color.";" : "";

?>

<?php if(FootManager\Utilities\DateHelper::isValid($date)) :
          $date = new JDate($date);
?>
<div class="fm-date-style2 <?php echo $class ?>">

    <?php if($show_year == 'left') : ?>
    <div class="fm-year" style="<?php echo $fontColor ?>">
        <?php echo implode("<br />", str_split($date->year)) ?>
    </div>
    <?php endif; ?>

    <div class="fm-date-content" style="<?php echo $borderColor ?>">
        <?php if($show_day) : ?>
        <div class="fm-day" style="<?php echo $backColor ?>">
            <?php echo $date->dayToString((($date->dayofweek == 7) ? 0 : $date->dayofweek), $abbreviation) ?>
        </div>
        <?php endif; ?>
        <div class="fm-number" style="<?php echo $fontColor ?>">
            <?php echo $date->day ?>
        </div>
        <div class="fm-month" style="<?php echo $backColor ?>">
            <?php echo $date->monthToString($date->month, $abbreviation) ?>
        </div>
    </div>

    <?php if($show_year == 'right') : ?>
    <div class="fm-year" style="<?php echo $fontColor ?>">
        <?php echo implode("<br />", str_split($date->year)) ?>
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>