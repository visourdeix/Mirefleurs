<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$roster = $this->item->roster;

?>

<!-- Header -->
<?php echo FootManager\Helpers\Layout::render('roster.header', array("roster" => $this->item->roster, "view" => $this->getName(), "team_rosters" => $this->item->team_rosters, "season_rosters" => $this->item->season_rosters)); ?>

<!-- Players -->
<div id="fm-content"></div>