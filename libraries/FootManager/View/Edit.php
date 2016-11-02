<?php
/**
 * @package      FootManager
 * @subpackage   LIbrary
 *
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 */

namespace FootManager\View;

defined('_JEXEC') or die();

abstract class Edit extends Admin
{
    /**
     * Item.
     * @var mixed
     */
    protected $item;

	/**
     * Form.
     * @var mixed
     */
	protected $form;

    /**
     * Form.
     * @var mixed
     */
	protected $return_page;

    protected function init() {

        if(parent::init()) {

            $this->item		= $this->get('Item');
            $this->form	= $this->get('Form');

            $this->_insertPath('template', FM_PATH_LIBRARY.DS . '/View/html/edit');

            if($this->state)
                $this->return_page	= $this->state->get("return_page", "");

            if (!$this->canEdit()){
                \JError::raiseWarning(404, \JText::_('JERROR_ALERTNOAUTHOR'));
                return false;
            }

            return true;
        }

        return false;
    }

    /**
     * Add the toolbar buttons.
     */
    protected function addToolbarButtons() {

        \JFactory::getApplication()->input->set('hidemainmenu', 1);
        $isNew = (isset($this->item->id)) ? ($this->item->id == 0) : false;

	    \JToolbarHelper::apply($this->getName().'.apply');
        \JToolBarHelper::save($this->getName().'.save');
        if($this->canAdd()) \JToolbarHelper::save2new($this->getName().'.save2new');
        if($this->canCopy()) \JToolbarHelper::save2copy($this->getName().'.save2copy');
        \JToolBarHelper::cancel($this->getName().'.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');

    }

    /**
     * Add the page title and toolbar.
     *
     */
    protected function addToolbar()
    {
        parent::addToolbar();

        \JPluginHelper::importPlugin(str_replace("com_", "", $this->component));
        $dispatcher = \JEventDispatcher::getInstance();

        $dispatcher->trigger("onDisplayEditToolbar", array($this->getName(), $this->item, $this->actions));

    }

    /**
     * Return the icon.
     * @return string
     */
    protected function getIcon() {
        return "edit";
    }

    protected function canEdit() {
        return true;
    }

    protected function canAdd() {
        return true;
    }

    protected function canCopy() {
        return false;
    }

}