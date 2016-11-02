<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$home_color = "#CEF6EC";
$away_color = "#F3F781";
$neutral_color = "#fff";

$time = new JDate($event->start);
$time = $time->format("H:i");

$home = !$event->event->neutral_stadium && FMManager\Helper::isMyClub($event->event->team1->club_id);
$color = ($event->event->neutral_stadium) ? $neutral_color : ($home ? $home_color : $away_color);

$types = \FMManager\Helper::getTypes();

$icon = "";
$text = "";
if(\FMManager\Helper::isMyClub($event->event->team1->club_id)) {
    $team=$event->event->team2;
    $icon = $types[1]["icon"];
    $text = $types[1]["label"];
} else {
    $team=$event->event->team1;
    $icon = $types[2]["icon"];
    $text = $types[2]["label"];
}
if($event->neutral_stadium) {
    $icon = $types[3]["icon"];
    $text = $types[3]["label"];
}

$callup = "";
if($event->event->call_up) {
    $callup .= $event->event->call_up->datetime->format("G:i");

    if($event->event->call_up->stadium_id) {
        $callup .= '<br />'.$event->event->call_up->stadium->name_and_city;
    } elseif($event->event->call_up->venue) {
        $callup .= '<br />'.$event->event->call_up->venue;
    }
} else {
    $callup = JText::_("FMLIB_NOT_COMMUNICATE");
}

?>

<tr style="background-color:<?php echo $color ?>!important">
    <td data-title="<?php echo JText::_("PLG_FMCONTENTTEMPLATES_PLANNING_CATEGORY") ?>">
        <div class="fm-text-tradegothic  fm-text-120" style="color:<?php echo $event->color ?>">
            <?php echo $event->category ?>
        </div>
    </td>
    <td data-title="<?php echo JText::_("PLG_FMCONTENTTEMPLATES_PLANNING_TIME") ?>">
        <div class="text-center fm-text-tradegothic  fm-text-120">
            <?php echo $time ?>
        </div>
    </td>
    <td data-title="<?php echo JText::_("PLG_FMCONTENTTEMPLATES_PLANNING_TITLE") ?>">
        <div class="fm-text-tradegothic">
            <?php echo \FMManager\Html\Team::image($team, array("class" => "fm-margin-right-5", "style" => "height:20px;width:auto!important"), false); ?>
            <?php echo $team->small_name ?>
        </div>
        <div>
            <i class="fm-margin-right-5 fa fa-<?php echo $icon ?>">&nbsp;</i>
            <i>
                <?php echo $text ?>
            </i>
        </div>
    </td>
    <td data-title="<?php echo JText::_("PLG_FMCONTENTTEMPLATES_PLANNING_LOCATION") ?>">
        <?php if($event->event->stadium) : ?>
        <?php echo $event->event->stadium->name_and_city ?>
        <?php endif; ?>
    </td>
    <td data-title="<?php echo JText::_("PLG_FMCONTENTTEMPLATES_PLANNING_CALLUP") ?>">
        <div class="fm-text-italic fm-text-90">
            <?php echo $callup ?>
        </div>
    </td>
</tr>