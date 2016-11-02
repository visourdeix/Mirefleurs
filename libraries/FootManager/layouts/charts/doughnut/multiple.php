<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$data = JArrayHelper::getValue($displayData, "data", array());
$size = JArrayHelper::getValue($displayData, "size", "200");
$suffix = JArrayHelper::getValue($displayData, "suffix", "");
$show_legend = JArrayHelper::getValue($displayData, "show_legend", true);
$class = JArrayHelper::getValue($displayData, "class", "");
$id = JArrayHelper::getValue($displayData, "id", uniqid());

?>

<div class="fm-column fm-column-border <?php echo $class ?>">

    <!-- Chart -->
    <div class="fm-chart">
        <?php echo FootManager\UI\Html\Chart::doughnut($data, $id."-chart"); ?>
        <?php echo FootManager\UI\Html\Form::hidden(array("id" => $id ,"name" => "charts[$id]" , "value" => $data)); ?>
    </div>

    <!-- Legend -->
    <div class="fm-row fm-row-border fm-chart-legend">

        <?php foreach ($data as $item) : ?>

        <div>
            <div class="fm-text-160" style="color:<?php echo $item["color"] ?>">
                <?php echo $item["value"].$suffix ?>
            </div>
            <div class="fm-text-110">
                <?php echo $item["label"] ?>
            </div>
        </div>

        <?php endforeach; ?>
    </div>
</div>