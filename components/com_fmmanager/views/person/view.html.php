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
class FmmanagerViewPerson extends \FootManager\View\Ajax
{

    protected function getDescription() {
        $desc = "";
        $club = \FMManager\Database\Models\Club::myClub();
        if($this->item->category_id)
            $desc = 'COM_FMMANAGER_DESCRIPTION_PLAYER';
        else
            $desc = 'COM_FMMANAGER_DESCRIPTION_MANAGER';

        return JText::sprintf($desc, $this->item->name, $club->name);
    }

    protected function getItemTitle() {
        return $this->item->name;
    }

}