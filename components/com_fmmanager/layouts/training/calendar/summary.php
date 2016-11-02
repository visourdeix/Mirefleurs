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

<div class="fm-event-title">
    <?php echo JText::_("COM_FMMANAGER_FIELD_TRAINING"); ?>
</div>
<?php if($training->stadium) : ?>
<div class="fm-event-subtitle">
    <?php echo $training->stadium->name ?>
</div>
<?php endif; ?>

<?php endif; ?>