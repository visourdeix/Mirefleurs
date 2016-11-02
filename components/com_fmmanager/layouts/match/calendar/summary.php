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

$icon = "";
$text = "";
if(\FMManager\Helper::isMyClub($match->team1->club_id)) {
    $team=$match->team2;
    $icon = $types[1]["icon"];
    $text = $types[1]["label"];
} else {
    $team=$match->team1;
    $icon = $types[2]["icon"];
    $text = $types[2]["label"];
}
if($match->neutral_stadium) {
    $icon = $types[3]["icon"];
    $text = $types[3]["label"];
}

?>

<?php if($match) : ?>
<div class="fm-match-summary fm-row fm-padding-0">
    <div class="fm-margin-right-5">
        <?php echo FMManager\Html\Team::image($team, array(), false); ?>
    </div>
    <div>
        <span class="fm-event-title">
            <?php echo $team->small_name; ?>
        </span>
        <br />
        <span class="fm-event-subtitle">
            <i class="fm-margin-right-5 fa fa-<?php echo $icon ?>"></i>
            <?php echo $text ?>
        </span>
    </div>
</div>
<?php endif; ?>