<?php
/**
 * @package      Fmmanager
 * @subpackage   Dashboard
 *
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 */

namespace FMManager\View\Backend;

defined('_JEXEC') or die();

abstract class DataList extends \FootManager\View\Items
{

    protected function canAdd() {
        return $this->actions->get("data.manage");
    }

    protected function canEdit($id = null, $i = 0) {
        return $this->actions->get("data.manage");
    }

    protected function canDelete() {
        return $this->actions->get("data.manage");
    }

    protected function getFields() {
        return array(
            "label" => array("linkable" => true, "sortable" => true, "class" => "nowrap has-context")
            );
    }

}