<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$time = new JDate($event->start);
$time = $time->format("H:i");

$callup = "";
if($event->event->call_up) {
    $callup .= $event->event->call_up->datetime->format("G:i");

    if($event->event->call_up->stadium_id) {
        $callup .= '<br />'.$event->event->call_up->stadium->name_and_city;
    } elseif($event->event->call_up->venue) {
        $callup .= '<br />'.$event->event->call_up->venue;
    }
} else {
    $callup = JText::_("FMLIB_NOT_COMMUNICATE");
}

?>

<tr>
    <td data-title="<?php echo JText::_("PLG_FMCONTENTTEMPLATES_PLANNING_CATEGORY") ?>">
        <div class="fm-text-tradegothic  fm-text-120" style="color:<?php echo $event->color ?>">
            <?php echo $event->category ?>
        </div>
    </td>
    <td data-title="<?php echo JText::_("PLG_FMCONTENTTEMPLATES_PLANNING_TIME") ?>">
        <div class="text-center fm-text-tradegothic  fm-text-120">
            <?php echo $time ?>
        </div>
    </td>
    <td data-title="<?php echo JText::_("PLG_FMCONTENTTEMPLATES_PLANNING_TITLE") ?>">
        <div class="fm-text-tradegothic">
            <?php echo $event->event->name ?>
        </div>
    </td>
    <td data-title="<?php echo JText::_("PLG_FMCONTENTTEMPLATES_PLANNING_LOCATION") ?>">
        <?php if($event->event->stadium) : ?>
        <?php echo $event->event->stadium->name_and_city ?>
        <?php endif; ?>
    </td>
    <td data-title="<?php echo JText::_("PLG_FMCONTENTTEMPLATES_PLANNING_CALLUP") ?>">
        <div class="fm-text-italic fm-text-90">
            <?php echo $callup ?>
        </div>
    </td>
</tr>