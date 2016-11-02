<?php
/**
 * @package      pkg_useractivity
 * @subpackage   plg_useractivity_content
 *
 * @author       Tobias Kuhn (eaxs)
 * @copyright    Copyright (C) 2013 Tobias Kuhn. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 */

defined('_JEXEC') or die();

jimport("FMActivity.library");
jimport("FMManager.library");

/**
 * Content User Activity plugin
 *
 */
class plgFmactivityFmmanagerPerson extends FMActivity\Activity\Activity
{
    public function itemLink() {
        if(!$this->_client_id)
            return FmmanagerHelperRoute::person($this->_item->item_id);
        return parent::itemLink();
    }

    public function icon() {
        return "user-plus";

    }

    public function siteText() {

        switch ($this->_event->name)
        {
        	case FMActivity\Constants::SAVE_NEW:
                return \JText::sprintf("PLG_FMACTIVITY_FMMANAGER_NEW_PERSON", $this->title);

            default:
                return parent::siteText();

        }

    }

}