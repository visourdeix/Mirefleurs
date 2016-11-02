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
$class = JArrayHelper::getValue($displayData, "class", "");
$inverse = JArrayHelper::getValue($displayData, "inverse", false);
$params = JArrayHelper::getValue($displayData, "params", array());
$ajax = JArrayHelper::getValue($params, "ajax_loading", false);
?>

<?php if(count($goals)) :
          $persons_goals = $goals->groupBy("striker_id");
?>

<div class="fm-strikers <?php echo $class ?>">
    <?php foreach ($persons_goals as $goals_list) :
              $person = $goals_list->first()->striker;
    ?>
    <div>

        <!-- Goals -->
        <?php if(!$inverse) : ?>
        <?php echo FootManager\Helpers\Layout::render('person.info.goals', array("goals" => $goals_list), '', array("component" => FM_MANAGER_COMPONENT)) ?>
        <?php endif; ?>

        <!-- Name -->
        <?php echo FootManager\Helpers\Layout::render('person.info.name', array("person" => $person), '', array("component" => FM_MANAGER_COMPONENT)) ?>

        <!-- Goals -->
        <?php if($inverse) : ?>
        <?php echo FootManager\Helpers\Layout::render('person.info.goals', array("goals" => $goals_list), '', array("component" => FM_MANAGER_COMPONENT)) ?>
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
</div>

<?php endif; ?>