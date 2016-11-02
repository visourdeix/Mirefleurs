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

jimport("FMEvents.library");

/**
 * Content User Activity plugin
 *
 */
class plgFmactivityFmevents extends \FMActivity\Plugin\Fmactivity
{
    /**
     * Summary of isSupported
     * @param mixed $context
     * @return mixed
     */
    protected function isSupported($context) {

        // Break the context into its parts
        $extension = explode('.', $context, 2)[0];

        return ($extension == FM_EVENTS_COMPONENT);
    }

}