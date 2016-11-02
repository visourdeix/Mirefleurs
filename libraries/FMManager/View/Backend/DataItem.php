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

abstract class DataItem extends \FootManager\View\Edit
{
    protected function canEdit() {
        return $this->actions->get("data.manage");
    }
}