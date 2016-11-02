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

class FmmanagerViewTraining extends FMManager\View\Backend\Event {

    protected function canEdit() {
        return $this->actions->get("trainings.manage");
    }

    protected function canEditConvocation() {
        return false;
    }
}