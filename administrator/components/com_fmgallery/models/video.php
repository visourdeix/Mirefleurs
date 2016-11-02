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
class FmgalleryModelVideo extends FMGallery\Model\Backend\Media
{
	/**
     * @var        string    The prefix to use with controller messages.
     * @since   1.6
     */
	protected $image = 'thumb';

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

            $extensions = ["avi", "mp4", "mkv", "mpeg"];

            if(!in_array(JFile::getExt($file_name), $extensions)) {
                $this->setError(JText::sprintf('COM_FMGALLERY_NOT_ALLOWED_EXTENSIONS', implode(", ", $extensions)));
                return false;
            }

            // 1 - Create Folder
            \FMGallery\Utilities\FileHelper::createVideosFolder($category->folder);

            // 2 - Download file in folder
            jimport('joomla.filesystem.file');
            $file_dest = \JPath::clean(FM_GALLERY_PATH_IMAGES.DS.$category->folder.DS.\FMGallery\Constants::VIDEOS) . DS . $file['name'];
            JFile::upload($file['tmp_name'], $file_dest, false, true);

            // 3 - Save in database
            $data["file"] = str_replace(JPATH_ROOT.DS, "", $file_dest);
        }

        // Thumb
        if(!empty($category) and isset($data["thumb"]) && $data["thumb"]) {

            // 1 - Create Folders
            \FMGallery\Utilities\FileHelper::createThumbnailsFolders($category->folder);

            // 2 - Rename and Move file in folder
            $thumb = JPATH_ROOT.DS.$data["thumb"];

            if(dirname($thumb) != FM_GALLERY_PATH_IMAGES.DS.$category->folder)
                $thumb = \FMGallery\Utilities\FileHelper::moveInCategoryFolder($thumb, $category);

            // 3 - Create thumbnails
            $thumbs = \FMGallery\Utilities\FileHelper::createThumbnails($thumb);

            // 5 - Save in database
            $data["thumb"] = str_replace(JPATH_ROOT.DS, "", $thumb);

            foreach ($thumbs as $size => $file)
                $data["thumb_".$size] = str_replace(JPATH_ROOT.DS, "", $file);

        } else {
            $data["thumb"] = "";
            $data["thumb_small"] = "";
            $data["thumb_medium"] = "";
            $data["thumb_large"] = "";
        }

        return parent::save($data);
	}

}