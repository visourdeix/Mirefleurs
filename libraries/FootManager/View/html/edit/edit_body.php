<?php
// No direct access
defined('_JEXEC') or die('Restricted access');

echo \JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general'));

// Général
echo \JHtml::_('bootstrap.addTab', 'myTab', 'general', \JText::_('FMLIB_TAB_GENERAL', true));
echo $this->loadTemplate("general");
echo \JHtml::_('bootstrap.endTab');

// Tabs
echo $this->loadTemplate("tabs");

// Rules
if($this->form->getInput('rules')) {
    echo \JHtml::_('bootstrap.addTab', 'myTab', 'permissions', \JText::_('COM_FMMANAGER_TAB_RULES', true));
    echo $this->form->getInput('rules');
    echo \JHtml::_('bootstrap.endTab');
}

// Params
echo \JLayoutHelper::render('joomla.edit.params', $this);

// Publishing Data
echo FootManager\Helpers\Layout::render('edit.publishingtab', array("form" => $this->form));

echo \JHtml::_('bootstrap.endTabSet');
?>