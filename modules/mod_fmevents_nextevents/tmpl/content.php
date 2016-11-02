<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  mod_latest
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$input  = JFactory::getApplication()->input;
$Itemid = $input->getInt('Itemid', 0);

$newPage = $page + 1;
$paramsUrl = base64_encode(json_encode($paramsToArray));

$group_by = JArrayHelper::getValue($paramsToArray, "group_by", 0);

?>

<?php if(count($data->events)) : ?>

<?php if($group_by) : ?>

<?php echo FootManager\Helpers\Layout::render("html.list.grouped", array("items" => $data->events, "title_class" => "fm-title-3", "layout" => "event.item", "params" => $paramsToArray, "component" => FM_EVENTS_COMPONENT));  ?>

<?php else : ?>

<?php echo FootManager\Helpers\Layout::render("html.list", array("items" => $data->events, "layout" => "event.item", "params" => $paramsToArray, "component" => FM_EVENTS_COMPONENT));  ?>

<?php endif; ?>

<a href="index.php?option=com_ajax&module=fmevents_nextevents&format=raw&Itemid=<?php echo $Itemid ?>&params=<?php echo $paramsUrl ?>&page=<?php echo $newPage ?>"></a>
<?php endif; ?>