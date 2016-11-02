<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$event = JArrayHelper::getValue($displayData, "event");

?>

<?php if($event) : ?>
<div class="fm-event-summary fm-row fm-padding-0">
    <div class="fm-margin-right-5">
        <?php echo FMEvents\Html\Event::image($event, array(), false); ?>
    </div>
    <div>
        <span class="fm-event-title">
            <?php echo $event->title; ?>
        </span>
        <?php if($event->location) : ?>
        <br />
        <span class="fm-event-subtitle">
            <?php echo $event->location->name; ?>
        </span>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>