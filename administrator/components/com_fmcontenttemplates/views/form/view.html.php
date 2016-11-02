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

class FmcontenttemplatesViewForm extends FootManager\View\View
{

    protected $form;
    protected $template;

    protected function init() {
		if(parent::init()) {

            $this->template = $this->state->get("template");
            $this->form = $this->get("Form");

            return true;
        }

        return false;
    }

}