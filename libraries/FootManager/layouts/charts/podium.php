<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

$item_1 = JArrayHelper::getValue($displayData, "item_1");
$item_2 = JArrayHelper::getValue($displayData, "item_2");
$item_3 = JArrayHelper::getValue($displayData, "item_3");
$params = JArrayHelper::getValue($displayData, "params", array());

?>

<div class="fm-podium">
    <div class="fm-rank-2">
        <div>
            <?php echo ($item_2) ? $item_2 : "<div class='fm-no-value'>".JText::_("FMLIB_NO_VALUE")."</div>" ?>
        </div>
        <div class="fm-spacer"></div>
        <div>2</div>
    </div>
    <div class="fm-rank-1">
        <div>
            <?php echo ($item_1) ? $item_1 : "<div class='fm-no-value'>".JText::_("FMLIB_NO_VALUE")."</div>" ?>
        </div>
        <div>1</div>
    </div>
    <div class="fm-rank-3">
        <div>
            <?php echo ($item_3) ? $item_3 : "<div class='fm-no-value'>".JText::_("FMLIB_NO_VALUE")."</div>" ?>
        </div>
        <div class="fm-spacer"></div>
        <div>3</div>
    </div>
</div>