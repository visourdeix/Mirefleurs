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
defined('_JEXEC') or die( 'Restricted access' );

class FmgalleryControllerFolders extends JControllerLegacy
{
	function __construct() {
		parent::__construct();
	}

	function createfolder() {
		$app	= JFactory::getApplication();

		$folderName		= JFilterOutput::stringURLSafe(JRequest::getString( 'foldername', ''));
		$folderBase			= JRequest::getVar( 'folderbase', '');
        $return_page			= base64_decode(JRequest::getVar( 'return_page', ''));

		if (strlen($folderName) > 0) {
            FMGallery\Utilities\FileHelper::createFolder($folderBase, $folderName);

		}

        $app->redirect($return_page);
	}
}