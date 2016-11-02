<?php
/**
 * @package      Fmmanager
 * @subpackage   Dashboard
 *
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 */

defined('_JEXEC') or die();

class FmmanagerViewCompetition extends FootManager\View\Edit
{
    protected function canEdit() {
        return $this->actions->get("competitions.manage");
    }

    protected function canCopy() {
        return $this->actions->get("competitions.manage");
    }

    /**
     * Display the view
     *
     */
    protected function loadScripts()
    {
        // Include jQuery
		JHtml::_('jquery.framework');

		JHtml::_('script', 'jui/jquery.minicolors.min.js', false, true);
		JHtml::_('stylesheet', 'jui/jquery.minicolors.css', false, true);

        parent::loadScripts();
    }

}