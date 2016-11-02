<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app = \JFactory::getApplication();
$Itemid = $app->input->getInt('Itemid', 0);

?>

<div id="<?php echo (\JFactory::getApplication()->isAdmin()) ? "fm-admin" : "fm" ?>">
    <div id="<?php echo $id ?>" class="<?php echo str_replace("_", "-", $module) ?>">

        <input type="hidden" id="fm-module-params" value='<?php echo base64_encode($params->toString()) ?>' />
        <input type="hidden" id="fm-itemid" value='<?php echo $Itemid ?>' />

        <?php require \JModuleHelper::getLayoutPath($module, 'default'); ?>
    </div>
</div>