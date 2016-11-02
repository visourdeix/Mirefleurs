<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$icon = empty($displayData['icon']) ? 'generic' : $displayData['icon'];
$is_image  = false;

$pos=strrpos($icon, ".");
if($pos >= 0) {
    $len=strlen($icon);
    $ext = strtolower(substr($icon,$pos+1,$len-$pos));
    $is_image = ($ext == "jpg" || $ext == "png" || $ext == "jpeg");
}
?>
<h1 class="page-title">
    <span class="fm-margin-right-7 fa fa-<?php echo $icon; ?>"></span>
    <?php echo $displayData['title']; ?>
</h1>