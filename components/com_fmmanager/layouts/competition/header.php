<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$competition = JArrayHelper::getValue($displayData, "competition");
$view = JArrayHelper::getValue($displayData, "view", "", "STRING");

?>

<?php if(isset($competition)) : ?>

<?php echo FootManager\Helpers\Layout::render('competition.filters', $displayData); ?>

<?php echo FootManager\Helpers\Layout::render('competition.tabs', array("competition" => $competition, "active" => $view)); ?>

<?php endif; ?>