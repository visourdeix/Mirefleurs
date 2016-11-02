<?php
/**
 * @package     mod_fmactivity_latestactivities
 * @subpackage  default.php
 *
 * @copyright   Copyright (C) 2016 Stéphane ANDRE. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$page = 1;
$id = uniqid();
$height=$params->get("height", "");
$style = ($height) ? "style='height:".$height."'" : "";

?>

<div id="<?php echo $id ?>" class="fm-scroll-loader" <?php echo $style ?>>
    <?php include JModuleHelper::getLayoutPath('mod_fmactivity_latestactivities', 'content');  ?>
</div>

<?php FootManager\UI\ui::jscroll("#$id"); ?>