<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>

<!-- Header -->
<?php echo \FootManager\Helpers\Layout::render('season.header', array("season" => $this->item->season, "view" => $this->getName(), "seasons" => $this->item->seasons)); ?>

<!-- Content -->
<div id="fm-content" class="fm-staff"></div>