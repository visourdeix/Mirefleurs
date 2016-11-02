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

class FmmanagerViewCallup extends FootManager\View\Edit
{
    protected function canEdit() {
        return ($this->item->category_id) ? $this->user->authorise( "call_up.edit", FM_MANAGER_COMPONENT.".category." . $this->item->category_id ) : true;
    }

    protected function canAdd() {
        return false;
    }

    protected function init() {
		if(parent::init()) {

            $this->type	= $this->state->get("type", "");
            $this->event_id	= $this->state->get("event_id", "");

            return true;
        }

        return false;
    }
}