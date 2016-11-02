<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$training = JArrayHelper::getValue($displayData, "event");

?>

<?php if($training) : ?>
<div class="fm-training-calendar">
    <!-- State -->
    <?php echo FootManager\Helpers\Layout::render("event.watermark", array("state" => $training->state), '', array("component" => FM_MANAGER_COMPONENT)); ?>

    <div class="fm-content text-center">

        <!-- Stadium -->
        <?php if($training->stadium) : ?>
        <div class="fm-stadium">
            <a href="<?php echo $training->stadium->googleMap ?>" target="_blank">
                <i class="fa fa-map-marker"></i>
                <?php echo $training->stadium->name_and_city ?>
            </a>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>