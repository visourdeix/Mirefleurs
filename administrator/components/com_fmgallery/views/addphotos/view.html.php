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

class FmgalleryViewAddphotos extends \FootManager\View\Admin
{

    /**
     * Form.
     * @var mixed
     */
	protected $form;

    protected function init() {
		$this->form	= $this->get('Form');
        return parent::init();
    }

    /**
     * Add the toolbar buttons.
     */
    protected function addToolbarButtons() {

        JFactory::getApplication()->input->set('hidemainmenu', 1);

        JToolBarHelper::save($this->getName().'.save');
        JToolbarHelper::save2new($this->getName().'.save2new');
        JToolBarHelper::cancel($this->getName().'.cancel', 'JTOOLBAR_CLOSE');

    }

    /**
     * Return the icon.
     * @return string
     */
    protected function getIcon() {
        return "edit";
    }
}