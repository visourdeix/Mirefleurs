<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

$person = JArrayHelper::getValue($displayData, "item");
$params = JArrayHelper::getValue($displayData, "params",  array());
$inverse = JArrayHelper::getValue($params, "inverse", false);
$ajax = JArrayHelper::getValue($displayData, "ajax_loading",  true);

?>

<?php if($person) : ?>

<div class="fm-person-row">

    <!-- Function -->
    <?php if($person->person->_function) : ?>
    <div class="fm-person-function">
        <?php echo $person->person->_function->label ?>
    </div>
    <?php endif; ?>

    <!-- Position -->
    <?php if($inverse && isset($person->person->position)) : ?>
    <?php echo FootManager\Helpers\Layout::render('person.info.position', array("position" => $person->person->position, "class" => "pull-left")) ?>
    <?php endif; ?>

    <!-- Substitutions -->
    <?php if($inverse && count($person->substitutions)) : ?>
    <?php echo FootManager\Helpers\Layout::render('person.info.substitutions', array("substitutions" => $person->substitutions, "person" => $person->person)) ?>
    <?php endif; ?>

    <!-- Goals -->
    <?php if($inverse && count($person->goals)) : ?>
    <?php echo FootManager\Helpers\Layout::render('person.info.goals', array("goals" => $person->goals)) ?>
    <?php endif; ?>

    <!-- Captain -->
    <?php if($inverse && isset($person->captain) && $person->captain) : ?>
    <?php echo FootManager\Helpers\Layout::render('person.info.captain', array()) ?>
    <?php endif; ?>

    <!-- Link -->
    <a href="<?php echo FmmanagerHelperRoute::person($person->person) ?>">

        <!-- Number -->
        <?php if(!$inverse && isset($person->number) && $person->number) : ?>
        <?php echo FootManager\Helpers\Layout::render('person.info.number', array("number" => $person->number)) ?>
        <?php endif; ?>

        <!-- Name -->
        <?php echo FootManager\Helpers\Layout::render('person.info.name', array("person" => $person->person)) ?>

        <!-- Number -->
        <?php if($inverse && isset($person->number) && $person->number) : ?>
        <?php echo FootManager\Helpers\Layout::render('person.info.number', array("number" => $person->number)) ?>
        <?php endif; ?>
    </a>

    <!-- Captain -->
    <?php if(!$inverse && isset($person->captain) && $person->captain) : ?>
    <?php echo FootManager\Helpers\Layout::render('person.info.captain', array()) ?>
    <?php endif; ?>

    <!-- Goals -->
    <?php if(!$inverse && count($person->goals)) : ?>
    <?php echo FootManager\Helpers\Layout::render('person.info.goals', array("goals" => $person->goals)) ?>
    <?php endif; ?>

    <!-- Substitutions -->
    <?php if(!$inverse && count($person->substitutions)) : ?>
    <?php echo FootManager\Helpers\Layout::render('person.info.substitutions', array("substitutions" => $person->substitutions, "person" => $person->person)) ?>
    <?php endif; ?>

    <!-- Position -->
    <?php if(!$inverse && isset($person->person->position)) : ?>
    <?php echo FootManager\Helpers\Layout::render('person.info.position', array("position" => $person->person->position, "class" => "pull-right")) ?>
    <?php endif; ?>
</div>

<?php endif; ?>