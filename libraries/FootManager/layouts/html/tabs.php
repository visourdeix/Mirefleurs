<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$tabs = JArrayHelper::getValue($displayData,"tabs", array());
$params = JArrayHelper::getValue($displayData,"params", array());
$id = uniqid();

$newTabs = array();
foreach ($tabs as $tab)
{
	$tabId =  isset($tab["target"]) ? $tab["target"] : array();
    $newTab = $tab;
    if($tabId) {
        $newTab["link"] = "#".$tabId;
        $newTab["id"] = $tabId.'-tab';
    }
    $newTabs[] = $newTab;
}
$displayData["tabs"] = $newTabs;

?>

<div id="<?php echo $id ?>" style="overflow: visible !important;">
    <?php echo FootManager\Helpers\Layout::render('html.links.tabs', $displayData); ?>
</div>

<?php

$script = "";
foreach ($tabs as $tab)
{
    $tabId =  isset($tab["target"]) ? $tab["target"] : array();
    if($tabId) {
        $script .= "var content = jQuery('#".$tabId."');
					jQuery('#" . $id . "').append(content);";
    }
}

if($script) \FootManager\UI\Loader::jQuery($script);

\FootManager\UI\ui::easytabs('#'.$id, $params);

?>