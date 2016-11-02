<?php
// No direct access
defined('_JEXEC') or die('Restricted access');

if($this->item->roster1 || $this->item->roster2 || $this->form->getField("teamsStatistics")) {
    echo JHtml::_('bootstrap.addTab', 'myTab', 'teams', JText::_('COM_FMMANAGER_TAB_TEAMS', true));
    echo $this->loadTemplate("teams");
    echo JHtml::_('bootstrap.endTab');

    echo JHtml::_('bootstrap.addTab', 'myTab', 'statistics', JText::_('COM_FMMANAGER_TAB_STATISTICS', true));
    echo $this->loadTemplate("statistics");
    echo JHtml::_('bootstrap.endTab');
}