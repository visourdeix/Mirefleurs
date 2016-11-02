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
$value = JArrayHelper::getValue($displayData, "value", "");

$ajax = JArrayHelper::getValue($params, "ajax_loading", false);

?>

<?php  if($person) :

           $category = isset($person->category) ? $person->category : null;
           $position = isset($person->position) ? $person->position : null;
           $function = isset($person->_function) ? $person->_function : null;
           $team = isset($person->team) ? $person->team : null;

           $disabled = !$person->active ? "disabled" : "";

?>

<a class="fm-person-thumbnail <?php echo $class.' '.$disabled ?>" href="<?php echo FmmanagerHelperRoute::person($person) ?>">

    <!-- Photo -->
    <div class="fm-photo fm-hover-panel">
        <?php echo FMManager\Html\Person::image($person, array(), !$ajax); ?>
    </div>

    <!-- Special Value -->
    <?php if($value !== "") : ?>
    <div class="fm-bull-value fm-bull fm-bull-dark-green">
        <?php echo $value; ?>
    </div>

    <!-- Category -->
    <?php elseif(isset($category)) : ?>
    <div class="fm-bull-value fm-bull" style="background-color:<?php echo $category->color ?>!important">
        <span class="hasTooltip" title="<?php echo $category->label ?>">
            <?php echo ($category->abbreviation != "") ? $category->abbreviation : $category->label; ?>
        </span>
    </div>
    <?php endif; ?>

    <!-- Infos -->
    <div class="fm-info <?php echo isset($person->contacts) ? "fm-padding-top-20" :"" ?>">
        <div class="fm-last-name">
            <?php echo $person->last_name; ?>
        </div>
        <div class="fm-first-name">
            <?php echo $person->first_name; ?>
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
        <?php if(isset($person->diplomas) && count($person->diplomas)) : ?>
        <div class="fm-diploma">
            <span class="fm-badge">
                <i class="fa fa-certificate"></i>
                <?php echo $person->diploma->label; ?>
            </span>
        </div>
        <?php endif; ?>

        <!-- Team -->
        <?php if(isset($team)) : ?>
        <div class="fm-person-team hasTooltip" title="<?php echo JText::sprintf("COM_FMMANAGER_RELATION_TEAM_PLAYER", $team->small_name) ?>" style="background-image:url('<?php echo FMManager\Helper::getClubLogo($team->logo) ?>')"></div>
        <?php endif; ?>
    </div>
</a>

<!-- Contacts -->
<?php if(isset($person->contacts) && $person->active) {
          echo \FootManager\Helpers\Layout::render("person.info.contacts", array("contacts" => $person->contacts, "class" => "fm-contacts-in-person-thumbnail"));
      }
?>
<?php endif ?>