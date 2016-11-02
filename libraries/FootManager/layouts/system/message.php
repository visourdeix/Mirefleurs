<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$message = isset($displayData["message"]) ? $displayData["message"] : "";
$color = isset($displayData["color"]) ? $displayData["color"] : "info";
$button = isset($displayData["button"]) ? $displayData["button"] : false;

?>

<div class="alert alert-<?php echo $color ?>">

    <?php if($button) : ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php endif; ?>

    <?php echo $message ?>
</div>