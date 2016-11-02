<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  mod_latest
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

if($data) :

?>

<?php if($params->get('show_tournament', true)) : ?>
<div class="fm-tournament text-center fm-margin-bottom-5">
    <span>
        <?php echo FMManager\Html\Competition::image($data->competition, array("class" => "fm-logo")); ?>
    </span>
    <span>
        <?php echo $data->competition->tournament->name ?>
    </span>
</div>
<?php endif ?>

<div id="fm-content">
    <?php
    if(!$ajax_loading) {
        if($data->ranking)
            echo FootManager\Helpers\Layout::render('stats.ranking', array("ranking" => $data->ranking->ranking, "columns" => $data->ranking->columns, "params" => $params->toArray(), "class" => "fm-small", "sortable" => false), '', array("component" => FM_MANAGER_COMPONENT));
    }
    ?>
</div>

<?php if($params->get('show_link', true)) : ?>
<div class="text-right fm-margin-top-10">
    <a class="fm-button" href="<?php echo FmmanagerHelperRoute::competition($data->competition, 'ranking') ?>">
        <span class="fa fa-bars fm-margin-right-10"></span>
        <?php echo JText::_("COM_FMMANAGER_SEE_ALL_RANKING") ?>
    </a>
</div>
<?php endif ?>
<?php endif ?>