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
class plgFmactivityContent extends \FMActivity\Plugin\Fmactivity
{
    /**
     * Summary of isSupported
     * @param mixed $context
     * @return mixed
     */
    protected function isSupported($context) {

        // Set supported contexts
        $array = array(
            'com_content.article',
            'com_content.category',
            'com_banners.banner',
            'com_categories.category',
            'com_contact.contact',
        );

        return in_array($context, $array);
    }

}