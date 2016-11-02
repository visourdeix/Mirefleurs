<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  mod_latest
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$page = 1;
$id = uniqid();
$height=$params->get("height", "");
$style = ($height) ? "style='height:".$height."'" : "";

?>

<div id="<?php echo $id ?>" class="fm-scroll-loader" <?php echo $style ?>>
    <?php include JModuleHelper::getLayoutPath('mod_fmevents_nextevents', 'content');  ?>
</div>

<?php FootManager\UI\ui::jscroll("#$id"); ?>