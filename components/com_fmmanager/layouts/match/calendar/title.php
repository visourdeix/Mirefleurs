<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$match = JArrayHelper::getValue($displayData, "event");
$types = \FMManager\Helper::getTypes();

$imgStyle = "height:20px";

$icon = "";
if(\FMManager\Helper::isMyClub($match->team1->club_id)) {
    $team = $match->team2;
    $icon = $types[1]["icon"];
} else {
    $team = $match->team1;
    $icon = $types[2]["icon"];
}
if($match->neutral_stadium)
    $icon = $types[3]["icon"];

?>

<?php if($match) : ?>

<?php if($match->isMyEvent()) : ?>

<?php echo \FMManager\Html\Team::image($team, array("style" => $imgStyle, "class" => "fm-margin-right-5"), false) ?>
<?php echo $team->small_name ?>
<i class="hidden-phone fm-margin-left-5 fm-margin-top-5 fm-text-120 pull-right fa fa-<?php echo $icon ?>"></i>

<?php else :  ?>

<?php echo \FMManager\Html\Team::image($match->team1, array("style" => $imgStyle), false).' - '.\FMManager\Html\Team::image($match->team2, array("style" => $imgStyle), false); ?>

<?php endif; ?>

<?php endif; ?>