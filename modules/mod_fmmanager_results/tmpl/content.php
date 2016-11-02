<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  mod_latest
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>

<div>
    <input type="hidden" id="fm-date" value="<?php echo $data->datetime->format("Y-m-d G:i:s") ?>" />

    <?php echo FootManager\Helpers\Layout::render($data->type.'.header', array($data->type => $data, "params" => $params, "class" => "fm-small"), '', array("component" => FM_MANAGER_COMPONENT)); ?>
</div>