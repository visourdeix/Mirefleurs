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
<?php echo FootManager\Helpers\Layout::render('competition.header', array("competition" => $this->item->competition, "view" => $this->getName(), "competitions" => $this->item->competitions)); ?>

<div id="fm-content"></div>