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

/**
 * Content User Activity plugin
 *
 */
class plgFmactivityContentArticle extends FMActivity\Activity\Activity
{

    public function itemLink() {
        JLoader::register('ContentHelperRoute', JPATH_SITE . '/components/com_content/helpers/route.php');
        if(!$this->_client_id)
            return ContentHelperRoute::getArticleRoute($this->_item->item_id, $this->_item->metadata["catid"]);
        return parent::itemLink();
    }

    public function color() {
        return "#618be2";
    }

    public function icon() {
        return "edit";
    }
}