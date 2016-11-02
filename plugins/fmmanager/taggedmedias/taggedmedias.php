<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Content.Contact
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\Registry\Registry;
jimport("FMGallery.library");

/**
 * Contact Plugin
 *
 * @since  3.2
 */
class PlgFmmanagerTaggedmedias extends \FMGallery\Plugin\TaggedMedias
{
    protected function getTagFilters($context, &$item, &$params) {

        if(!FootManager\Helpers\Application::enabled("com_fmmanager")) return array();

        jimport("FMManager.library");

        switch ($context)
        {
        	case FM_MANAGER_COMPONENT.".person":
            case FM_MANAGER_COMPONENT.".stadium":
            case FM_MANAGER_COMPONENT.".match":
                return parent::getTagFilters($context, $item, $params);

            case FM_MANAGER_COMPONENT.".matchday":
                return array("note" => $context.".".$item->matchday->id);

        }

        return array();
    }
}