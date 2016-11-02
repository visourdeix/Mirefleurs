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

class FmmanagerViewRoster extends FootManager\View\Edit
{
    protected function canEdit() {
        if(!empty($this->item->team->category_id))
            return $this->user->authorise( "roster.edit", FM_MANAGER_COMPONENT.".category." . $this->item->team->category_id ) && $this->actions->get("rosters.manage");
        else
            return $this->actions->get("rosters.manage");
    }

}