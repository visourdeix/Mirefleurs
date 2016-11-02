<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$matchday = JArrayHelper::getValue($displayData, "item");
$params = JArrayHelper::getValue($displayData, "params", array());
$isEditable = JArrayHelper::getValue($params, "isEditable", true);
$ajax = JArrayHelper::getValue($params, "ajax_loading", false);

$canEdit = $isEditable;

?>
<?php if($matchday) : ?>
<div>

    <div class="fm-team">
        <?php echo $matchday->name ?>
    </div>
</div>
<?php endif; ?>