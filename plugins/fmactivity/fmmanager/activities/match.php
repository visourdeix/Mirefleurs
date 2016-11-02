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
class plgFmactivityFmmanagerMatch extends FMActivity\Activity\Activity
{
    const SUMMARY_ADDED = "summary_added";
    const SCORE_ADDED = "score_added";

    public function itemLink() {
        if(!$this->_client_id)
            return FmmanagerHelperRoute::match($this->_item->item_id);
        return parent::itemLink();
    }

    public function icon() {
        switch ($this->_event->name)
        {
        	case self::SUMMARY_ADDED:
                return "edit";

            default:
                return "futbol-o";
        }

    }

    public function header() {
        switch ($this->_event->name)
        {
        	case self::SCORE_ADDED:
                return '<span class="fm-score fm-badge fm-badge-'.$this->_item->metadata["header_color"].' fm-badge-small fm-badge-number">'.$this->_item->metadata["score"].'</span>';
            default:
                return parent::header();
        }

    }

    public function siteText() {
        switch ($this->_event->name)
        {
        	case self::SUMMARY_ADDED:
                return JText::sprintf("PLG_FMACTIVITY_FMMANAGER_SUMMARY_ADDED", $this->_item->title);
            default:
                return parent::siteText();
        }

    }

}