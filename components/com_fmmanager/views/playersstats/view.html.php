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
class FmmanagerViewPlayersstats extends FMManager\View\Frontend\Roster
{

    public function canView() {
        return $this->user->authorise( "stats.view", FM_MANAGER_COMPONENT.".category." . $this->item->roster->team->category_id );
    }

    public  function loadAjaxContent() {
    }

}