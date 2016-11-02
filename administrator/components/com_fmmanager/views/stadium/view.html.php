<?php
/**
 * @package      Fmmanager
 * @subpackage   com_fmmanager
 *
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 */

defined('_JEXEC') or die();

class FmmanagerViewStadium extends FootManager\View\Edit {

    protected function canEdit() {
        return $this->actions->get("stadiums.manage");
    }

    protected function loadScripts() {
        parent::loadScripts();

        FootManager\UI\Loader::google();
    }
}