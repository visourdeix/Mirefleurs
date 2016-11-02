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
$time = $time->format("G:i");

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
            <?php echo $event->event->title ?>
        </div>
    </td>
    <td data-title="<?php echo JText::_("PLG_FMCONTENTTEMPLATES_PLANNING_LOCATION") ?>">
        <?php if($event->event->location) : ?>
        <?php echo $event->event->location->name_and_city ?>
        <?php endif; ?>
    </td>
    <td data-title="<?php echo JText::_("PLG_FMCONTENTTEMPLATES_PLANNING_CALLUP") ?>"></td>
</tr>