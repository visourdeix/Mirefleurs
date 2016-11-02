<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Content.Contact
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

jimport("FootManager.library");

/**
 * Contact Plugin
 *
 * @since  3.2
 */
class PlgFmeventsTaggedarticles extends \FootManager\Plugin\Taggedarticles {

    protected function getTagFilters($context, &$item, &$params) {

        if(!FootManager\Helpers\Application::enabled("com_fmevents")) return array();

        jimport("FMEvents.library");

        switch ($context)
        {
        	case FM_EVENTS_COMPONENT.".event":
                return parent::getTagFilters($context, $item, $params);

        }

        return array();
    }

}