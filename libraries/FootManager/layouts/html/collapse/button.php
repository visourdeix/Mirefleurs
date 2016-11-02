<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$text = isset($displayData["text"]) ? $displayData["text"] : "";
$target = isset($displayData["target"]) ? $displayData["target"] : "";

?>

<div class="fm-title-3">
    <span data-toggle="collapse" data-target="#<?php echo $target ?>" class="fm-button-filter collapsed">
        <?php echo $text ?>
    </span>
</div>