<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

$color = JArrayHelper::getValue($displayData, "color", "#333");
$tactic = JArrayHelper::getValue($displayData, "tactic");
$players = JArrayHelper::getValue($displayData, "players", array());
$inverse = JArrayHelper::getValue($displayData, "inverse", false);
$params = JArrayHelper::getValue($displayData, "params",  array());
$ajax = JArrayHelper::getValue($displayData, "ajax_loading",  true);

$start = ($inverse) ? 1 : 7;
$end = ($inverse) ? 7 : 1;

?>

<?php if(isset($tactic) && $tactic) : ?>

<div class="fm-match-info-tactic fm-column">
    <?php for($row=$start; (($inverse) ? $row <= $end : $row >= $end) ; (($inverse) ? $row++ : $row--)) : ?>
    <div class="fm-row">
        <?php for($column=1; $column <= 5 ; $column++) :
                  $exist = count($tactic->tacticPositions->filter(function ($obj) use($row, $column) { return $obj->row == $row && $obj->column == $column; })) > 0;
        ?>
        <div class="fm-position">

            <?php if($exist) :
                      $player = $players->filter(function ($obj) use($row, $column) { return $obj->row == $row && $obj->column == $column; })->first();
                      $number = (isset($player->number) && $player->number) ? $player->number : "";
                      $last_name = isset($player->person) ? $player->person->last_name : "";
                      $first_name = isset($player->person) ? $player->person->first_name : "";
                      $name = isset($player->person) ? $player->person->name : "";
                      $goals = isset($player->goals) ? $player->goals : array();
                      $captain = isset($player->captain) ? $player->captain : false;
                      $substitutions = isset($player->substitutions) ? $player->substitutions : array();
                      $link = isset($player->person) ? FmmanagerHelperRoute::person($player->person) : "";

            ?>

            <div class="hasTooltip" title="<?php echo $name; ?>">
                <div class="fm-tshirt" data-number="<?php echo $number ?>" style="color:<?php echo $color ?>"></div>

                <?php if(isset($player->person)) : ?>
                <?php echo FootManager\Helpers\Layout::render('person.info.name', array("person" => $player->person)) ?>
                <?php endif; ?>

                <!-- Links -->
                <?php if($link) : ?>
                <a href="<?php echo $link  ?>" class="fm-link"></a>
                <?php endif; ?>
            </div>

            <!-- Captain -->
            <?php if($captain) : ?>
            <?php echo FootManager\Helpers\Layout::render('person.info.captain') ?>
            <?php endif; ?>

            <!-- Goals -->
            <?php echo FootManager\Helpers\Layout::render('person.info.goals', array("goals" => $goals)) ?>

            <!-- Substitutions -->
            <?php if(isset($player->person)) : ?>
            <?php echo FootManager\Helpers\Layout::render('person.info.substitutions', array("substitutions" => $substitutions, "person" => $player->person)) ?>
            <?php endif; ?>

            <?php endif; ?>
        </div>

        <?php endfor; ?>
    </div>
    <?php endfor; ?>
</div>

<?php endif; ?>