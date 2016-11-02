<?php
/*
 * @package		Joomla.Framework
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 *
 * @component Phoca Component
 * @copyright Copyright (C) Jan Pavelka www.phoca.cz
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License version 2 or later;
 */
defined('_JEXEC') or die();

class FmgalleryViewFolder extends FootManager\View\View
{
	protected $field;
	protected $fce;
    protected $folders;
    protected $folder;
    protected $session;

    protected function init() {
        parent::init();

		JResponse::allowCache(false);

		$this->field	= JRequest::getVar('field');
		$this->fce 		= 'fmSelectFolder_'.$this->field;
        $this->folders = $this->get('Folders');
        $this->session = JFactory::getSession();

        return true;
    }
}
?>