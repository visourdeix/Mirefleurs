<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

$ajax = JArrayHelper::getValue($params, "ajax_loading", false);

?>

<?php  if($this->item->seasonmanagers) : ?>

<div class="fm-organization-chart">

    <?php foreach ($this->item->seasonmanagers as $manager) : ?>
    <div>
        <div class="fm-manager-item hexagon">

            <!-- Fonction -->
            <div class="fm-manager-function"><?php echo $manager->_function->label; ?></div>

            <!-- Nom -->
            <div class="fm-manager-name"><?php echo $manager->person->last_name." ".$manager->person->first_name; ?></div>

            <!-- Photo -->
            <div class="fm-manager-photo">
                <?php echo FMManager\Html\Person::image($manager->person, array(), !$ajax); ?>
            </div>

            <!-- Contacts -->
            <div class="fm-manager-contacts"><?php echo \FootManager\Helpers\Layout::render("person.info.contacts", array("contacts" => $manager->person->contacts, "class" => "fm-contacts-in-person-organization-charts"), '', array("component" => FM_MANAGER_COMPONENT)); ?></div>
        </div>  
    </div>

    <?php endforeach; ?>
</div>

<?php endif ?>

<?php echo $this->item->seasonmanagers; ?>