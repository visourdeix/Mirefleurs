<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

$persons = JArrayHelper::getValue($displayData, "persons", array());
$inverse = JArrayHelper::getValue($displayData, "inverse", false);
$title = JArrayHelper::getValue($displayData, "title", "");
$params = JArrayHelper::getValue($displayData, "params",  array());
$ajax = JArrayHelper::getValue($displayData, "ajax_loading",  true);

$params["inverse"] = $inverse;

?>

<?php if(count($persons)) : ?>

<!-- Title -->
<?php if($title) : ?>
<div class="fm-title-3">
    <span>
        <?php echo JText::_($title) ?>
    </span>
</div>
<?php endif; ?>

<?php echo \FootManager\Helpers\Layout::render("html.list", array("items" => $persons, "layout" => "person.row", "params" => $params, "class" => ($inverse ? "text-right": ""), "component" => FM_MANAGER_COMPONENT));
?>

<?php endif; ?>