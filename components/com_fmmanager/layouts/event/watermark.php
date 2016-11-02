<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$state = JArrayHelper::getValue($displayData, "state", 0);

?>

<?php if($state == FootManager\Constants::REPORTED) : ?>
<?php echo FootManager\Helpers\Layout::render("html.watermark", array("class" => "fm-reported", "text" => JText::_("FMLIB_REPORTED"))) ?>
<?php endif; ?>

<?php if($state == FootManager\Constants::CANCELLED) : ?>
<?php echo FootManager\Helpers\Layout::render("html.watermark", array("class" => "fm-cancelled", "text" => JText::_("FMLIB_CANCELLED"))) ?>
<?php endif; ?>

<?php if($state == FootManager\Constants::STOPPED) : ?>
<?php echo FootManager\Helpers\Layout::render("html.watermark", array("class" => "fm-stopped", "text" => JText::_("FMLIB_STOPPED"))) ?>
<?php endif; ?>