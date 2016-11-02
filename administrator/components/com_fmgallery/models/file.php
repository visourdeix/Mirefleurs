<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;
use Joomla\Registry\Registry;
/**
 * Item Model for an Article.
 *
 * @since  1.6
 */
class FmgalleryModelFile extends FMGallery\Model\Backend\Media
{
    /**
     * Method to save the form data.
     *
     * @param   array  $data  The form data.
     *
     * @return  boolean  True on success.
     *
     * @since   1.6
     */
	public function save($data)
	{
        // 1 - Get Category
        $category = FMGallery\Database\Models\Category::find($data["catid"]);

        // Get the uploaded file information.
		$input    = JFactory::getApplication()->input;

		// Do not change the filter type 'raw'. We need this to let files containing PHP code to upload. See JInputFiles::get.
		$file = $input->files->get('jform_file', null, 'raw');
        $file_name =isset($file['name']) ? $file['name'] : "";

        // If there is no uploaded file, we have a problem...
		if ((!isset($data["id"]) || !$data["id"]) && !$file_name)
		{
            $this->setError(JText::_('COM_FMGALLERY_NO_FILE_SELECTED'));
			return false;
		}

        //File
        if(!empty($category) && $file_name) {

            // Is the PHP tmp directory missing?
            if ($file['error'] && ($file['error'] == UPLOAD_ERR_NO_TMP_DIR))
            {
                $this->setError(JText::_('COM_FMGALLERY_WARNINSTALLUPLOADERROR') . '<br />' . JText::_('COM_FMGALLERY_WARNINGS_PHPUPLOADNOTSET'));
                return false;
            }

            // Is the max upload size too small in php.ini?
            if ($file['error'] && ($file['error'] == UPLOAD_ERR_INI_SIZE))
            {
                $this->setError(JText::_('COM_FMGALLERY_WARNINSTALLUPLOADERROR') . '<br />' . JText::_('COM_FMGALLERY_SMALLUPLOADSIZE'));
                return false;
            }

            // Check if there was a different problem uploading the file.
            if ($file['error'] || $file['size'] < 1)
            {
                $this->setError(JText::_('COM_FMGALLERY_WARNINSTALLUPLOADERROR'));
                return false;
            }

            // 1 - Create Folder
            \FMGallery\Utilities\FileHelper::createFilesFolder($category->folder);

            // 2 - Download file in folder
            jimport('joomla.filesystem.file');
            $file_dest = \JPath::clean(FM_GALLERY_PATH_IMAGES.DS.$category->folder.DS.\FMGallery\Constants::FILES) . DS . $file['name'];
            JFile::upload($file['tmp_name'], $file_dest, false, true);

            // 3 - Save in database
            $data["file"] = str_replace(JPATH_ROOT.DS, "", $file_dest);
        }

        return parent::save($data);
	}
}