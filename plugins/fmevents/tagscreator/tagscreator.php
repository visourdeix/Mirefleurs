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

/**
 * Contact Plugin
 *
 * @since  3.2
 */
class PlgFmeventsTagscreator extends \FootManager\Plugin\Tagscreator
{

    protected function getTitle($context, $table, $isNew) {

        if(!FootManager\Helpers\Application::enabled("com_fmevents")) return "";

        jimport("FMEvents.library");

        $title = "";
        switch ($context)
        {
        	case FM_EVENTS_COMPONENT.".event":

                if($this->params->get('event', true))
                    $title = $table->title;
                break;

        }

        return $title;
    }

}