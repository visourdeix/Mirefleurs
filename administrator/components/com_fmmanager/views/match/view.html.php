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

class FmmanagerViewMatch extends FMManager\View\Backend\Event
{

    protected function canEdit() {
        return ($this->item->competition->tournament->category_id) ? $this->user->authorise( "results.edit", FM_MANAGER_COMPONENT.".category." . $this->item->competition->tournament->category_id ) : false;
    }

    protected function canEditConvocation() {
        if($this->item) {
            return  parent::canEditConvocation() && $this->item->competition->tournament->type->by_match && (!empty($this->item->roster1) || !empty($this->item->roster2));
        }

        return false;
    }

    protected function canAdd() {
        return false;
    }

    protected function canEditRoster($category_id = null) {
        return ($category_id) ? $this->user->authorise( "roster.edit", FM_MANAGER_COMPONENT.".category." . $category_id ) : true;
    }

    /**
     * Display the view
     *
     */
    protected function loadScripts()
    {
        FootManager\UI\Loader::radio();
        FootManager\UI\Loader::toggle();
        FootManager\UI\Loader::touchspin();

        parent::loadScripts();
    }

}