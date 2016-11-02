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
<h2>
    <small><?php echo $event->competition->small_name ?></small>
    <br />
    <?php echo $event->name ?>
</h2>
<legend><?php	echo $event->datetime->format("l d F, G:i"). (($event->stadium) ? " - " . $event->stadium->name_and_city : "")	?></legend>