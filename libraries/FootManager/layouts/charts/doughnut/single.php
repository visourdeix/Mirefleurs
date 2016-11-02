<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$value = JArrayHelper::getValue($displayData, "value", "0");
$max = JArrayHelper::getValue($displayData, "max", "100");
$color = JArrayHelper::getValue($displayData, "color", "#333");
$label = JArrayHelper::getValue($displayData, "label", "");
$size = JArrayHelper::getValue($displayData, "size", "120");
$suffix = JArrayHelper::getValue($displayData, "suffix", "");
$class = JArrayHelper::getValue($displayData, "class", "");
$id = JArrayHelper::getValue($displayData, "id", uniqid());

?>

<div class="<?php echo $class ?>">
    <div>
        <?php
        $data = array();
        $data[] = array("value" => $value, "color" => $color);
        $data[] = array("value" => $max -  $value, "color" => "#ddd");
        echo FootManager\UI\Html\Chart::doughnut($data, $id.'-chart', '120', '120');
        echo FootManager\UI\Html\Form::hidden(array("id" => $id ,"name" => "charts[$id]" , "value" => $data));
        ?>
    </div>
    <div class="fm-text-400 fm-line-height-60" style="color:<?php echo $color ?>">
        <?php echo $value.$suffix ?>
    </div>
    <div class="fm-text-110">
        <?php echo $label ?>
    </div>
</div>