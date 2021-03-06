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
jimport("FootManager.framework");

JFactory::getLanguage()->load("com_fmsocial", JPATH_ADMINISTRATOR);

$controller = JControllerLegacy::getInstance('Fmsocial');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();