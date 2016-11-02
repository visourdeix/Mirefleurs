<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

$goals = JArrayHelper::getValue($displayData, "goals", array());

?>

<?php if(count($goals)) : ?>

<span class="fm-goals">
    <?php foreach($goals as $goal) : ?>
    <i class="fm-goal fa fa-futbol-o"></i>
    <?php endforeach; ?>
</span>

<?php endif; ?>