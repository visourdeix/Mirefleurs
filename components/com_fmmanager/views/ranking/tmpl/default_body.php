<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

foreach ($this->item->types as $i => $type)
{
    $types_checkboxes[] = array(
        "id" => "type-".$i,
        "value" => $type["value"],
        "checked" => $type["value"] == FMManager\Constants::GENERAL,
        "text" => $type["label"],
        "icon" => $type["icon"],
        "name" => "type"
        );
}

?>

<!-- Header -->
<?php echo FootManager\Helpers\Layout::render('competition.header', array("competition" => $this->item->competition, "view" => $this->getName(), "competitions" => $this->item->competitions)); ?>

<div class="fm-competition-ranking">

    <?php if($this->item->competition->has_ranking) : ?>

    <?php if($this->params->get("ranking_show_filters", true)) : ?>

    <!-- Types -->
    <?php echo FootManager\Helpers\Layout::render("html.checkboxes.list", array("checkboxes" => $types_checkboxes, "responsive" => true, "class" => "fm-margin-top-20 fm-margin-bottom-30", "type" => "radio")); ?>

    <?php endif; ?>

    <!-- Body -->
    <div id="fm-content"></div>

    <?php else : ?>
    <?php echo FootManager\Helpers\Layout::render("system.message", array("message" => JText::_("COM_FMMANAGER_ERROR_NO_RANKING"), "color" => "error")); ?>
    <?php  endif; ?>
</div>