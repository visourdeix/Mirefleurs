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

jimport('joomla.application.component.controller');

class FmgalleryController extends JControllerLegacy
{
    /**
     * The default view
     *
     * @var    string
     */
    protected $default_view = 'photos';

    public function display($cachable = false, $urlparams = false)
    {
        FmgalleryHelper::addSubmenu();
        parent::display();

        return $this;
    }
}