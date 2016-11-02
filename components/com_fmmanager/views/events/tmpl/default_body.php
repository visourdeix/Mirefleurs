<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$competitions_checkboxes = array();
foreach ($this->item->competitions as $i => $competition)
{
    $competitions_checkboxes[] = array(
        "id" => "competition-".$i,
        "value" => $competition->id,
        "checked" => true,
        "text" => $competition->tournament->name,
        "image" => FMManager\Html\Competition::image($competition),
        "name" => "competitions[]"
        );
}

?>

<!-- Header -->
<?php echo FootManager\Helpers\Layout::render('roster.header', array("roster" => $this->item->roster, "view" => $this->getName(), "team_rosters" => $this->item->team_rosters, "season_rosters" => $this->item->season_rosters)); ?>

<?php if($this->params->get("events_show_filters", true)) : ?>

<!-- Button Filter -->
<?php echo FootManager\Helpers\Layout::render("html.collapse.filter", array("target" => "fm-events-filters")); ?>

<!-- Form Filters -->
<form id="fm-events-filters" class="collapse fm-margin-bottom-15 fm-filters">
    <div>

        <!-- Competitions -->
        <?php echo FootManager\Helpers\Layout::render("html.checkboxes.list", array("checkboxes" => $competitions_checkboxes)); ?>
    </div>
</form>
<?php endif; ?>

<!-- Results -->
<div id="fm-content"></div>