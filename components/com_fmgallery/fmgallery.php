<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include framework
jimport("FMGallery.framework");

// Get an instance of the controller
$controller = JControllerLegacy::getInstance('Fmgallery');

// Perform the Request task
$input = JFactory::getApplication()->input;

$controller->execute($input->getCmd('task', ""));

// Redirect if set by the controller
$controller->redirect();