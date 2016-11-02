<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

$value = isset($displayData["value"]) ? $displayData["value"] : "";
$value2 = isset($displayData["value2"]) ? $displayData["value2"] : "";
$icon = isset($displayData["icon"]) ? $displayData["icon"] : "";
$title = isset($displayData["title"]) ? $displayData["title"] : "";
$link = isset($displayData["link"]) ? $displayData["link"] : "";
$params = isset($displayData["params"]) ? $displayData["params"] : array();
$ajax = isset($params["ajax_loading"]) ? $params["ajax_loading"] : false;

?>

<?php if($link) : ?>
<a href="<?php echo $link ?>" class="fm-info-value hasTooltip" title="<?php echo $title ?>">
    <?php else : ?>
    <div class="fm-info-value hasTooltip" title="<?php echo $title ?>">
        <?php endif;?>

        <div class="fm-icon">
            <?php echo $icon ?>
        </div>
        <div class="fm-text <?php echo ($value) ? "" : "fm-text-nc" ?>">
            <?php echo ($value) ? $value : JText::_("FMLIB_NO_VALUE") ?>
        </div>

        <?php if($value2) : ?>
        <div class="fm-text-2">
            <?php echo $value2 ?>
        </div>
    <?php endif; ?>

    <?php if($link) : ?>
</a>
<?php else : ?>
</div>
        <?php endif;?>