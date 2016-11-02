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

<button id="fm-previous" class="fm-slider-arrow fm-slider-arrow-white" data-direction="-1"></button>
<button id="fm-next" class="fm-slider-arrow fm-slider-arrow-right fm-slider-arrow-white" data-direction="1"></button>

<div id="fm-content">
    <?php
    if(!$ajax_loading) {

        if($data)
        {
            $params = $params->toArray();
            ob_start();
            include JModuleHelper::getLayoutPath('mod_fmmanager_results', 'content');
            $result = ob_get_contents();
            ob_end_clean();
            echo $result;
        } else {
            echo FootManager\Helpers\Layout::render("messages.nodata");
        }
    }
    ?>
</div>