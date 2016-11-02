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
class Competition extends \FootManager\View\Ajax
{

    protected function getItemTitle() {
        return \JText::_(FM_MANAGER_COMPONENT."_".strtoupper($this->getName()));
    }

    protected function getItemPageTitle() {
        return $this->item->competition->name." - ".\JText::_(FM_MANAGER_COMPONENT."_".strtoupper($this->getName()));
    }

    protected function getDescription() {
        return \JText::sprintf(FM_MANAGER_COMPONENT."_DESCRIPTION_".strtoupper($this->getName()), $this->item->competition->name);
    }

    protected function getPathwayTitle() {
        return $this->item->competition->small_name;
    }

}