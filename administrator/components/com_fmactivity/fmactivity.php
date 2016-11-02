<?php
/**
 * @package      Fmmanager
 * @subpackage   Dashboard
 *
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 */

defined('_JEXEC') or die();

// Include library
jimport("FMActivity.framework");

// Access check
if (!(FootManager\Helpers\Access::getActions()->get('core.manage'))) {
	return JError::raiseWarning(403, JText::_('JERROR_ALERTNOAUTHOR'));
}

// Register classes to autoload
JLoader::register('FmactivityHelper',  FM_ACTIVITY_PATH_ADMIN . '/helpers/fmactivity.php');

$controller = JControllerLegacy::getInstance('Fmactivity');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();