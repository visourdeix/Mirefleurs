<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>

<?php if(count($events)) : ?>

<table class="fm-table fm-table-responsive">
    <thead>
        <tr>
            <th width="15%">
                <?php echo JText::_("PLG_FMCONTENTTEMPLATES_PLANNING_CATEGORY") ?>
            </th>
            <th width="10%">
                <?php echo JText::_("PLG_FMCONTENTTEMPLATES_PLANNING_TIME") ?>
            </th>
            <th width="30%">
                <?php echo JText::_("PLG_FMCONTENTTEMPLATES_PLANNING_TITLE") ?>
            </th>
            <th width="25%">
                <?php echo JText::_("PLG_FMCONTENTTEMPLATES_PLANNING_LOCATION") ?>
            </th>
            <th width="20%">
                <?php echo JText::_("PLG_FMCONTENTTEMPLATES_PLANNING_CALLUP") ?>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($events as $key => $items) { ?>
        <tr style="background-color: #333">
            <td colspan="5" class="fm-text-tradegothic text-center fm-text-130" style="text-transform: capitalize; color: #fff">
                <?php echo $key ?>
            </td>
        </tr>
        <?php
                  foreach ($items as $event)
                  {
                      include JPluginHelper::getLayoutPath("fmcontenttemplates", $this->_name, $event->type);
                  }

              } ?>
    </tbody>
</table>

<?php else : ?>
<?php echo FootManager\Helpers\Layout::render('messages.nodata'); ?>
<?php endif; ?>