<?php
// No direct access
defined('_JEXEC') or die('Restricted access');

if($this->form->getField("playersStatistics") || $this->form->getField("teamsStatistics")) {

    echo JHtml::_('bootstrap.addTab', 'myTab', 'statistics', JText::_('COM_FMMANAGER_TAB_STATISTICS', true));
    echo $this->loadTemplate("statistics");
    echo JHtml::_('bootstrap.endTab');
}