<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$form = $displayData["form"];
$tabName = isset($displayData["tabSet"]) ? $displayData["tabSet"] : "myTab";

echo JHtml::_('bootstrap.addTab', $tabName, 'publishing', JText::_('JGLOBAL_FIELDSET_PUBLISHING', true));
echo $form->renderField("id");
echo $form->renderField("created");
echo $form->renderField("created_by");
echo $form->renderField("modified");
echo $form->renderField("modified_by");
echo JHtml::_('bootstrap.endTab');