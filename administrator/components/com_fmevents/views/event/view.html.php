<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * View to edit an article.
 *
 * @since  1.6
 */
class FmeventsViewEvent extends FootManager\View\Edit
{

    protected function canEdit() {
        return ($this->item->catid) ? $this->user->authorise( "core.edit", FM_EVENTS_COMPONENT.".category." . $this->item->catid ) : true;
    }

}