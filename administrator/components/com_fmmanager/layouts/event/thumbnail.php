<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$event = JArrayHelper::getValue($displayData, "item");
$params = JArrayHelper::getValue($displayData, "params", array());
$class = JArrayHelper::getValue($displayData, "class", "");
$show_date = JArrayHelper::getValue($params, "show_date", true);
$show_tournament = JArrayHelper::getValue($params, "show_tournament", true);
$return_page = JArrayHelper::getValue($params, "return_page", false);
$isEditable = JArrayHelper::getValue($params, "isEditable", false, 'boolean');
$ajax = JArrayHelper::getValue($params, "ajax_loading", true);

$user = \JFactory::getUser();
$canEdit = (bool)$user->authorise( "results.edit", FM_MANAGER_COMPONENT.".category." . $event->category->id);

$canEditCallUp = ((bool)$user->authorise( "call_up.edit", FM_MANAGER_COMPONENT.".category." . $event->category->id) && $event->state == FMManager\Constants::NOT_PLAYED && $event->isMyEvent() && \FootManager\Utilities\DateHelper::isAfterToday($event->datetime) );

$return_page = "&return_page=".$return_page;
$eventParam = '&id='.$event->id;
$callUpParam = ($event->call_up_id) ? '&id='.$event->call_up_id : '';
$eventParamAlt = '&type='.base64_encode(ucfirst($event->type)).'&event_id='.$event->id;

$link = JRoute::_('index.php?option='.FM_MANAGER_COMPONENT.'&task='.$event->type.'.edit'.$return_page.$eventParam);
$linkCallUp = JRoute::_('index.php?option='.FM_MANAGER_COMPONENT.'&task=callup.edit'.$callUpParam.$return_page.$eventParamAlt);

$options = array();
if(!$event->played) {
    $notPlayed = new stdClass();
    $notPlayed->value = FMManager\Constants::NOT_PLAYED;
    $notPlayed->text = JText::_("FM_STATE_0");
    $options[] = $notPlayed;
}

$played = new stdClass();
$played->value = FMManager\Constants::PLAYED;
$played->text = JText::_("FM_STATE_1");
$options[] = $played;

if(!$event->played) {
    $reported = new stdClass();
    $reported->value = FMManager\Constants::REPORTED;
    $reported->text = JText::_("FM_STATE_2");
    $options[] = $reported;

    $cancelled = new stdClass();
    $cancelled->value = FMManager\Constants::CANCELLED;
    $cancelled->text = JText::_("FM_STATE_3");
    $options[] = $cancelled;

    $stopped = new stdClass();
    $stopped->value = FMManager\Constants::STOPPED;
    $stopped->text = JText::_("FM_STATE_4");
    $options[] = $stopped;
}

?>

<?php if($event) : ?>
<div class="fm-match-thumbnail <?php echo $class ?>">

    <!-- State -->
    <?php if($canEdit && $isEditable) : ?>
    <div class="fm-state-edit">
        <?php echo FootManager\UI\Html\Form::hidden(array("name" => "matches[id]", "value" => $event->id)); ?>
        <?php echo FootManager\UI\Html\Form::select($options, $event->state, array("id" => $event->id."_played", "name" => "matches[state]", "class" => "fm-results-state fm-chzn-states input-mini")) ?>
        <?php FootManager\UI\ui::statesselect('#'.$event->id."_played"); ?>
    </div>
    <?php else : ?>
    <div class="fm-state-edit hasTooltip fm-text-150" title="<?php echo JText::_("FM_STATE_".$event->state); ?>">
        <?php echo JText::_("FM_STATE_".$event->state."_ICON"); ?>
    </div>
    <?php endif; ?>

    <div class="fm-content">
        <!-- Tournament -->
        <?php if($show_tournament) : ?>
        <div class="fm-tournament" style="color:<?php echo $event->competition->tournament->category->color ?>">
            <?php echo FMManager\Html\Competition::image($event->competition, array("class" => "fm-logo"), !$ajax); ?>
            <?php echo $event->competition->medium_name ?>
        </div>
        <?php endif; ?>

        <!-- Date -->
        <?php if($show_date) : ?>
        <div class="fm-date">
            <?php echo $event->datetime->format("l d F Y - G:i"); ?>
        </div>
        <?php endif; ?>

        <?php echo $this->subLayout($event->type, $displayData); ?>
    </div>

    <div class="fm-actions">

        <?php

          if($canEdit) FootManager\UI\Html\Button\Group::addLink($link, "", "fa fa-edit", array("class" => "btn-primary btn-small hasTooltip", "title" => JText::_("FMLIB_EDIT")));
          if($canEditCallUp) FootManager\UI\Html\Button\Group::addLink($linkCallUp, "", "fa fa-bell", array("class" => "btn-small hasTooltip ".(($event->call_up_id) ? "btn-success" : "btn-default"), "title" => (($event->call_up_id) ? JText::_("COM_FMMANAGER_EDIT_CALL_UP") : JText::_("COM_FMMANAGER_CREATE_CALL_UP"))));

          echo FootManager\UI\Html\Button\Group::render();

        ?>
    </div>
</div>
<?php endif; ?>