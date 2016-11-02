<?php
/*
 * @package Joomla 1.5
 * @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 *
 * @component Phoca Gallery
 * @copyright Copyright (C) Jan Pavelka www.phoca.cz
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
defined('_JEXEC') or die();

class FmgalleryModelFolder extends JModelLegacy
{
	function getState($property = null, $default = null) {
		static $set;

		if (!$set) {

            $app = JFactory::getApplication();

            $folder = $app->input->getString('folder', '');
			//$upload = JRequest::getVar( 'upload', '', '', 'int' );
			$this->setState('folder', $folder);
			$parent = str_replace("\\", "/", dirname($folder));
			$parent = ($parent == '.') ? null : $parent;
			$this->setState('parent', $parent);
			$set = true;

		}
		return parent::getState($property, $default);
	}

	function getFolders() {
		$list = $this->getList();
		return $list['folders'];
	}

	function getList() {
		static $list;

		// Only process the list once per request
		if (is_array($list)) {
			return $list;
		}

		// Get current path from request
		$current = $this->getState('folder');

		// If undefined, set to empty
		if ($current == 'undefined') {
			$current = '';
		}

		// Initialize variables
		if (strlen($current) > 0) {
			$orig_path = JPath::clean(FM_GALLERY_PATH_IMAGES.DS.$current);
		} else {
			$orig_path = FM_GALLERY_PATH_IMAGES.DS;
		}
		$orig_path_server 	= str_replace(DS, '/', FM_GALLERY_PATH_IMAGES);

		$folders 	= array ();

		// Get the list of files and folders from the given folder
		$folder_list 	= JFolder::folders($orig_path, '', false, false, array(0 => 'thumbs'));

		// Iterate over the folders if they exist
		if ($folder_list !== false) {
			foreach ($folder_list as $folder) {
				$tmp 							= new JObject();
				$tmp->name 						= basename($folder);
				$tmp->fullpath 			= str_replace(DS, '/', JPath::clean($orig_path . DS . $folder));
				$tmp->relativepath = FM_GALLERY_PATH_IMAGES_REL.DS . str_replace($orig_path_server, '', $tmp->fullpath);
				$tmp->path= str_replace($orig_path_server, '', $tmp->fullpath);
				$folders[] = $tmp;
			}
		}

		$list = array('folders' => $folders);
		return $list;
	}
}
?>