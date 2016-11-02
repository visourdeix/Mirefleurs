<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$roster = JArrayHelper::getValue($displayData, "roster");
$view = JArrayHelper::getValue($displayData, "view", "", "STRING");
$user = JFactory::getUser();

?>

<?php if(isset($roster)) : ?>

<?php echo FootManager\Helpers\Layout::render('roster.filters', $displayData); ?>

<!--Tabs -->
<?php echo FootManager\Helpers\Layout::render('roster.tabs', array("roster" => $roster, "active" => $view)); ?>

<?php endif; ?>