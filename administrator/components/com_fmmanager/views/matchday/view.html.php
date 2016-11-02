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

class FmmanagerViewMatchday extends \FMManager\View\Backend\Event
{
    protected function canEdit() {
        return ($this->item->competition->tournament->category_id) ? $this->user->authorise( "results.edit", FM_MANAGER_COMPONENT.".category." . $this->item->competition->tournament->category_id ) : false;
    }

    protected function canEditConvocation() {
        if($this->item) {
            return $this->item->id > 0 && parent::canEditConvocation() && !$this->item->competition->tournament->type->by_match;
        }
        return false;
    }

    /**
     * Display the view
     *
     */
    protected function loadScripts()
    {
        FootManager\UI\Loader::touchspin();

        parent::loadScripts();
    }

}