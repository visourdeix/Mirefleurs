<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;
$call_up = JArrayHelper::getValue($displayData, "callup");
$params = JArrayHelper::getValue($displayData, "params", array());
$ajax = JArrayHelper::getValue($params, "ajax_loading", false);
?>

<?php if(isset($call_up) && $call_up) : ?>

<div class="fm-event-callup">

    <div class="fm-row fm-row-border fm-row-responsive">

        <div class="fm-info">
            <!-- Informations -->
            <div class="fm-column">

                <!-- Calendar Links -->
                <div class="fm-link">
                    <a href="#">Ajouter au calendrier</a>
                </div>

                <!-- Time -->
                <div class="fm-time">
                    <?php if($call_up->datetime) : ?>
                    <div class="fm-time-metal">
                        <?php
                              echo '<span>'.$call_up->datetime->format('H').'</span>';
                              echo '<span>'.$call_up->datetime->format('i').'</span>';
                        ?>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Location -->
                <div class="fm-location">
                    <?php if($call_up->stadium) : ?>
                    <?php echo $call_up->stadium->name_and_city ?>
                    <?php elseif($call_up->venue) : ?>
                    <?php echo $call_up->venue ?>
                    <?php endif; ?>
                </div>

                <!-- Links -->
                <div>
                    <?php if($call_up->stadium && $call_up->stadium->googleMap) : ?>
                    <a class="fm-google-map" href="<?php echo $call_up->stadium->googleMap ?>" target="_blank"></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Contacts -->
        <div class="fm-callup-contacts">
            <div class="fm-title-3">
                <span>
                    <?php echo JText::_("COM_FMMANAGER_CONTACTS") ?>
                </span>
            </div>
            <?php echo FootManager\Helpers\Layout::render("html.list", array("items" => $call_up->contacts, "layout" => "person.item", "params" => $params, "component" => FM_MANAGER_COMPONENT)) ?>
        </div>
    </div>

    <!-- Contacts -->
    <?php if($call_up->information) : ?>
    <div class="fm-summary">
        <div class="fm-title-3">
            <span>
                <?php echo JText::_("COM_FMMANAGER_INFORMATIONS") ?>
            </span>
        </div>
        <?php echo $call_up->information ?>
    </div>
    <?php endif; ?>

    <!-- Persons -->
    <div class="fm-title-3">
        <span>
            <?php echo JText::_("COM_FMMANAGER_CALLED_UP_PERSONS") ?>
        </span>
    </div>
<?php echo FootManager\Helpers\Layout::render("html.thumbnails", array("items" => $call_up->persons, "layout" => "person.thumbnail", "params" => $params, "component" => FM_MANAGER_COMPONENT)) ?>

<?php endif; ?>