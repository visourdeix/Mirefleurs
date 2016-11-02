<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  mod_version
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$version = $data->version;
$joomla_version = $data->joomlaVersion;

?>

<div class="well well-small">

    <ul class="unstyled">

        <li>
            <small>
                <?php echo JText::sprintf("MOD_FMMANAGER_VERSIONS_FOOT_MANAGER", $version);?>
            </small>
        </li>

        <li>
            <small>
                <?php echo JText::sprintf("MOD_FMMANAGER_VERSIONS_JOOMLA", $joomla_version);?>
            </small>
        </li>
        <li>
            <small>
                <?php echo JText::sprintf("MOD_FMMANAGER_VERSIONS_PHP", phpversion());?>
            </small>
        </li>
    </ul>
</div>