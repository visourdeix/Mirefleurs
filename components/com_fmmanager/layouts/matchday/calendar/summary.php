<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$matchday = JArrayHelper::getValue($displayData, "event");

?>

<?php if($matchday) : ?>
<div class="fm-event-title">
    <?php echo $matchday->name ?>
</div>
<?php if($matchday->stadium) : ?>
<div class="fm-event-subtitle">
    <?php echo $matchday->stadium->name ?>
</div>
<?php endif; ?>

<?php endif; ?>