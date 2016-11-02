<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace FMManager\View\Frontend;

defined('_JEXEC') or die;

/**
 * HTML Article View class for the Content component
 *
 * @since  1.5
 */
class Season extends \FootManager\View\Ajax
{

    protected function getItemTitle() {
        return \JText::_(strtoupper(FM_MANAGER_COMPONENT."_".$this->getName()))." ".$this->item->season->label;
    }

    protected function getDescription() {
        $club = \FMManager\Database\Models\Club::myClub();
        return \JText::sprintf(strtoupper(FM_MANAGER_COMPONENT."_DESCRIPTION_".$this->getName()), $club->name, $this->item->season->label);
    }
}