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

class FmeventsViewLocations extends FootManager\View\Items
{
    protected function canAdd() {
        return $this->
actions->get("locations.manage");
    }

    protected function canEdit($id = null, $i = 0) {
        return $this->actions->get("locations.manage");
    }

    protected function canDelete() {
        return $this->actions->get("locations.manage");
    }

    protected function getFields() {
        return array(
            "name" => array("linkable" => true, "sortable" => true, "class" => "has-context"),
            "city" => array("sortable" => true)
            );
    }

}