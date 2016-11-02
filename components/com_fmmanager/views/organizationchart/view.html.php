<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * HTML Article View class for the Content component
 *
 * @since  1.5
 */
class FmmanagerViewOrganizationChart extends \FootManager\View\Item
{

    protected function getDescription() {
        return JText::sprintf('COM_FMMANAGER_DESCRIPTION_ORGANIZATION_CHART', $this->item->season->name);
    }

    protected function getItemTitle() {
        return $this->item->season->name;
    }

}