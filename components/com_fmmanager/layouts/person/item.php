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
$params = JArrayHelper::getValue($displayData, "params", array());
$class = JArrayHelper::getValue($displayData, "class", "");

$ajax = JArrayHelper::getValue($params, "ajax_loading", false);

?>

<?php  if($person) : ?>

<?php
           $category = isset($person->category) ? $person->category : null;
           $position = isset($person->position) ? $person->position : null;
           $function = isset($person->_function) ? $person->_function : null;
           $disabled = !$person->active ? "disabled" : "";

?>

<a class="fm-person-item <?php echo $class.' '.$disabled ?> fm-hover-panel fm-hover-panel-vertical" href="<?php echo FmmanagerHelperRoute::person($person) ?>">

    <!-- Photo -->
    <div class="fm-photo">
        <?php echo FMManager\Html\Person::image($person, array(), !$ajax); ?>
    </div>

    <!-- Category -->
    <?php if(isset($category)) : ?>
    <div class="fm-bull" style="background-color:<?php echo $category->color ?>">
        <span class="hasTooltip" title="<?php echo $category->label ?>">
            <?php echo ($category->abbreviation != "") ? $category->abbreviation : $category->label; ?>
        </span>
    </div>
    <?php endif; ?>

    <!-- Infos -->
    <div class="fm-info">
        <div class="fm-name">
            <span class="fm-last-name">
                <?php echo $person->last_name; ?>
            </span>
            <br />
            <span class="fm-first-name">
                <?php echo $person->first_name; ?>
            </span>
        </div>

        <!-- Position -->
        <?php if(isset($position)) : ?>
        <div class="fm-position">
            <?php echo $position->label; ?>
        </div>
        <?php endif; ?>

        <!-- Function -->
        <?php if(isset($function)) : ?>
        <div class="fm-function">
            <?php echo $function->label; ?>
        </div>
        <?php endif; ?>

        <!-- Diploma -->
        <?php if(isset($person->diploma)) : ?>
        <div class="fm-diploma">
            <span class="fm-badge">
                <i class="fa fa-certificate"></i>
                <?php echo $person->diploma->label; ?>
            </span>
        </div>
        <?php endif; ?>
    </div>
</a>

<!-- Contacts -->
<?php if(isset($person->contacts) && $person->active) {
          echo \FootManager\Helpers\Layout::render("person.info.contacts", array("contacts" => $person->contacts, "class" => "fm-contacts-in-person-item"));
      }
?>
<?php endif ?>