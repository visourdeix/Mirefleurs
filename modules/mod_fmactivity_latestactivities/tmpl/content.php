<?php
/**
 * @package     mod_fmactivity_latestactivities
 * @subpackage  content.php
 *
 * @copyright   Copyright (C) 2016 Stéphane ANDRE. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$input  = JFactory::getApplication()->input;
$Itemid = $input->getInt('Itemid', 0);

$newPage = $page + 1;
$paramsUrl = base64_encode(json_encode($paramsToArray));

?>

<?php if(count($data->activities)) : ?>
<?php echo FootManager\Helpers\Layout::render("html.list", array("items" => $data->activities, "layout" => "activity", "params" => $paramsToArray, "component" => FM_ACTIVITY_COMPONENT));  ?>
<a href="index.php?option=com_ajax&module=fmactivity_latestactivities&format=raw&Itemid=<?php echo $Itemid ?>&params=<?php echo $paramsUrl ?>&page=<?php echo $newPage ?>"></a>
<?php endif; ?>