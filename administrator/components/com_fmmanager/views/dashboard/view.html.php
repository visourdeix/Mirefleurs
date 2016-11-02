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

class FmmanagerViewDashboard extends FootManager\View\Admin
{

    /**
     * Summary of $sidebar
     * @var mixed
     */
	protected $sidebar;

    protected function init() {

        if(parent::init()) {

            if ($this->getLayout() !== 'modal') {
                $this->sidebar = JHtmlSidebar::render();
            }

            // Parameters
            if ($this->actions->get('core.admin') && !empty($this->component)) {
                JToolBarHelper::preferences($this->component);
            }

            return true;
        }

        return false;
    }

    protected function getIcon() {
        return "futbol-o";
    }

}