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

<?php  if($person) :

           $category = isset($person->category) ? $person->category : null;
           $position = isset($person->position) ? $person->position : null;

           $disabled = !$person->active ? "disabled" : "";
           $link = (FootManager\Helpers\Access::getActions(FM_MANAGER_COMPONENT)->get('persons.manage'))  ? JRoute::_('index.php?option='.FM_MANAGER_COMPONENT.'&task=person.edit&id='.$person->id) : "";
           $balise = $link ? "a" : "div";
           $address = ($person->address || $person->city || $person->postal_code) ? ["address" => $person->address, "city" => $person->city, "postal_code" => $person->postal_code] : [];
           $class = 'fm-person-thumbnail '.$class.' '.$disabled.($link ? "" : " fm-no-hover");

?>

<?php if($link) : ?>
<a class="<?php echo $class?>" href="<?php echo $link ?>">
    <?php else : ?>
    <div class="<?php echo $class?>">
        <?php endif; ?>

        <!-- Photo -->
        <div class="fm-photo <?php echo ($link ? "fm-hover-panel" : "") ?>">
            <?php echo FMManager\Html\Person::image($person, array(), !$ajax); ?>
        </div>

        <!-- Category -->
        <?php if(isset($category)) : ?>
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

            <!-- License -->
            <div class="fm-license">
                <?php echo $person->license; ?>
            </div>

            <!-- Position -->
            <?php if(isset($position)) : ?>
            <div class="fm-position">
                <?php echo $position->label; ?>
            </div>
            <?php endif; ?>
        </div>

        <?php if(!$link) : ?>
    </div>
    <?php else : ?>
</a>
<?php endif; ?>

<!-- Contacts -->
<?php
           if((isset($person->contacts) && count($person->contacts))) {
               echo \FootManager\Helpers\Layout::render("person.info.contacts", array("contacts" => $person->contacts, "class" => "fm-contacts-in-person-thumbnail"), '', array("component" => FM_MANAGER_COMPONENT));
           }
?>

<!-- Address -->
<?php
           if($address) {
               echo \FootManager\Helpers\Layout::render("person.info.address", array("address" => $address, "class" => "fm-address"), '', array("component" => FM_MANAGER_COMPONENT));
           }
?>
<?php endif ?>