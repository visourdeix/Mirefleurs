<?php
/**
 * @package      FootManager
 * @subpackage   Helpers
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FootManager\Helpers;

defined('JPATH_PLATFORM') or die;
/**
 * This class contains common methods and properties for a database item
 *
 * @package      FootManager
 * @subpackage   Helpers
 */
abstract class Access
{
    /**
     * Get Rules.
     * @param mixed $component
     * @param mixed $section
     * @param mixed $id
     * @return JObject
     */
    public static function getActions($component = '', $section = 'component', $id = 0) {
        jimport('joomla.access.access');
        $user = \JFactory::getUser();
        $result = new \JObject;

		if(empty($component))
			$component = \JFactory::getApplication()->input->get('option');

        if (empty($id)) {
            $assetName = $component;
        } else {
            $assetName = $component .'.' . $section . '.' . (int) $id;
        }

        $actions = \JAccess::getActionsFromFile(
			JPATH_ADMINISTRATOR . '/components/' . $component . '/access.xml',
			"/access/section[@name='" . $section . "']/"
		);
        if($actions) {
            foreach ($actions as $action) {
                $result->set($action->name, $user->authorise($action->name, $assetName));
            }
        }

        return $result;
    }

    /**
     * Check if user is Super User.
     * @return boolean
     */
    public static function isAdmin() {
        $user = \JFactory::getUser();
        return $user->get('isRoot');
    }

}