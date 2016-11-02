<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$target = isset($displayData["target"]) ? $displayData["target"] : "";
$text = " <i class='fa fa-chevron-down'></i>
            &nbsp;&nbsp;&nbsp;".JText::_("FMLIB_FILTER")."&nbsp;&nbsp;&nbsp;
        <i class='fa fa-chevron-down'></i>";
echo FootManager\Helpers\Layout::render("html.collapse.button", array("target" => $target, "text" => $text));

?>