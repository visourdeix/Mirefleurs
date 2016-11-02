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
class plgFmactivityFmmanagerCallup extends FMActivity\Activity\Activity
{

    public function itemLink() {

        $type = $this->_item->metadata["type"];
        $id  =$this->_item->metadata["id"];
        if($this->_client_id == 1) {
            return ($this->_activity->event_id != \FMActivity\Constants::DELETE) ? 'index.php?option=' . $this->_type->extension . '&task=' . $type . '.edit&id=' . (int) $id : "";
        }

        return FmmanagerHelperRoute::$type($id);
    }

    public function icon() {
        return "bell";
    }

    public function siteText() {
        return JText::sprintf("PLG_FMACTIVITY_FMMANAGER_CALLUP_TITLE", $this->_item->title);

    }

}