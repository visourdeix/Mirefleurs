<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

$matchday = JArrayHelper::getValue($displayData, "item");
$params = JArrayHelper::getValue($displayData, "params", array());
$class = JArrayHelper::getValue($displayData, "class", "");
$show_date = JArrayHelper::getValue($params, "show_date", true);
$format_date = JArrayHelper::getValue($params, "format_date", "d/m");
$show_tournament = JArrayHelper::getValue($params, "show_tournament", false);
$ajax = JArrayHelper::getValue($params, "ajax_loading", false);

?>

<?php if($matchday) : ?>
<a class="fm-matchday-item fm-hover-panel fm-hover-panel-vertical <?php echo $class ?>" href="<?php echo FmmanagerHelperRoute::matchday($matchday) ?>">

    <!-- State -->
    <?php echo FootManager\Helpers\Layout::render("event.watermark", array("state" => $matchday->state)); ?>

    <div class="fm-content">

        <?php if($show_date) : ?>
        <!-- Date -->
        <div class="fm-date">
            <?php echo $matchday->datetime->format($format_date); ?>
        </div>
        <?php endif; ?>

        <div class="fm-column">

            <!-- Tournament -->
            <?php if($show_tournament) : ?>
            <div class="fm-tournament">
                <?php echo FMManager\Html\Competition::image($matchday->competition, array("class" => "fm-logo"), !$ajax); ?>
                <?php echo $matchday->competition->tournament->name ?>
            </div>
            <?php endif; ?>

            <div class="fm-content">

                <!-- Matchday -->
                <div class="fm-team">
                    <?php echo $matchday->name ?>
                </div>
            </div>
        </div>
    </div>
</a>
<?php endif; ?>