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
jimport("FMGallery.library");

/**
 * Content User Activity plugin
 *
 */
class plgFmactivityFmgalleryAddphotos extends FMActivity\Activity\Activity
{

    public function itemLink() {

        if($this->_client_id == 1) {
            return ($this->_activity->event_id != \FMActivity\Constants::DELETE) ? 'index.php?option=' . $this->_type->extension : "";
        }

        return FmgalleryHelperRoute::photos($this->_item->item_id);
    }

    public function icon() {
        return "camera";
    }

    public function siteText() {
        return JText::sprintf("PLG_FMACTIVITY_FMGALLERY_PHOTOS_ADDDED_TITLE", $this->_item->title);
    }

}