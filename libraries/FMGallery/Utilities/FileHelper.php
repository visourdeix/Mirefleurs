<?php
/**
 * @package      FootManager
 * @subpackage   Utilities
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FMGallery\Utilities;

defined('JPATH_PLATFORM') or die;

/**
 * Projectfork Date Helper Class
 *
 */
abstract class FileHelper
{
    public static function createThumbnailsFolders($category_path) {
        $folder = \JPath::clean(FM_GALLERY_PATH_IMAGES.DS.$category_path);
        $thumbs_folder = $folder.DS.\FMGallery\Constants::THUMBS;

        \FootManager\Utilities\FileHelper::createFolder($folder, \FMGallery\Constants::THUMBS);
        \FootManager\Utilities\FileHelper::createFolder($thumbs_folder, \FMGallery\Constants::SMALL);
        \FootManager\Utilities\FileHelper::createFolder($thumbs_folder, \FMGallery\Constants::MEDIUM);
        \FootManager\Utilities\FileHelper::createFolder($thumbs_folder, \FMGallery\Constants::LARGE);

    }

    public static function createVideosFolder($category_path) {
        $folder = \JPath::clean(FM_GALLERY_PATH_IMAGES.DS.$category_path);
        \FootManager\Utilities\FileHelper::createFolder($folder, \FMGallery\Constants::VIDEOS);
    }

    public static function createFilesFolder($category_path) {
        $folder = \JPath::clean(FM_GALLERY_PATH_IMAGES.DS.$category_path);
        \FootManager\Utilities\FileHelper::createFolder($folder, \FMGallery\Constants::FILES);
    }

    public static function createFolder($parent_path, $folderName) {
        \FootManager\Utilities\FileHelper::createFolder(FM_GALLERY_PATH_IMAGES.DS.$parent_path, $folderName);
        self::createThumbnailsFolders($parent_path.DS.$folderName);
    }

    /**
     * Load the event.
     * @param mixed $id
     */
    public static function moveInCategoryFolder($file, $category) {
        $defaultfilename = self::defaultFileName($file, $category);
        $ext = \JFile::getExt($file);
        $dest = FM_GALLERY_PATH_IMAGES.DS.$category->folder.DS.$defaultfilename.'.'.$ext;
		while (file_exists($dest))
		{
            $defaultfilename =  \JString::increment($defaultfilename, 'dash');
            $dest = FM_GALLERY_PATH_IMAGES.DS.$category->folder.DS.$defaultfilename.'.'.$ext;
		}
        \JFile::copy($file, $dest);
        return FM_GALLERY_PATH_IMAGES.DS.$category->folder.DS.$defaultfilename.'.'.$ext;
    }

    /**
     * Load the event.
     * @param mixed $id
     */
    public static function defaultFileName($file, $category) {
        $filename = self::defaultFileNamePrefix($category);

        $exif_data = exif_read_data ($file);
        if (!empty($exif_data['DateTimeOriginal']) && \FootManager\Utilities\DateHelper::isValid($exif_data['DateTimeOriginal'])) {
            $date = new \JDate($exif_data['DateTimeOriginal']);
            $filename = $filename.'_'.$date->format('YmdHis');
        }
        return $filename;
    }

    /**
     * Load the event.
     * @param mixed $id
     */
    public static function defaultFileNamePrefix($category) {
        return \JApplication::stringURLSafe($category->title);
    }

    public static function createThumbnails($file) {
        $result = [];

        $result[\FMGallery\Constants::SMALL] = self::createThumbnail($file, \FMGallery\Constants::SMALL);
        $result[\FMGallery\Constants::MEDIUM] = self::createThumbnail($file, \FMGallery\Constants::MEDIUM);
        $result[\FMGallery\Constants::LARGE] = self::createThumbnail($file, \FMGallery\Constants::LARGE);

        return $result;
    }

    public static function createThumbnail($file, $size) {
        $config = \FootManager\Helpers\Application::getConfiguration(FM_GALLERY_COMPONENT);
        $params = self::getParameters();

        $width = $config->get('thumb_'.$size.'_width');
        $height = $config->get('thumb_'.$size.'_height');

        switch ($size)
        {
            case  \FMGallery\Constants::SMALL:
                switch ($params["crop"])
                {
                    case 3:
                    case 5:
                    case 6:
                    case 7:
                        $params["crop"] = true;
                        break;

                    default:
                        $params["crop"] = false;

                }

                break;

            case  \FMGallery\Constants::MEDIUM:
                switch ($params["crop"])
                {
                    case 2:
                    case 4:
                    case 5:
                    case 7:
                        $params["crop"] = true;
                        break;

                    default:
                        $params["crop"] = false;

                }

                break;

            case  \FMGallery\Constants::LARGE:
                switch ($params["crop"])
                {
                    case 1:
                    case 4:
                    case 6:
                    case 7:
                        $params["crop"] = true;
                        break;

                    default:
                        $params["crop"] = false;

                }

                break;

            default:
                $params["crop"] = false;
        }

        $thumbnailFolder = dirname($file).DS.\FMGallery\Constants::THUMBS.DS.$size;
        $thumbnailPath = $thumbnailFolder.DS.\JFile::getName($file);

        if(!\JFolder::exists($thumbnailFolder)) {
            \JFolder::create($thumbnailFolder);
        }

        if(\FootManager\Utilities\ImageHelper::createThumbnail($file, $thumbnailPath, $width, $height, $params)) {

            return $thumbnailPath;
        }

        return "";
    }

    private static function getParameters() {

        $config = \FootManager\Helpers\Application::getConfiguration(FM_GALLERY_COMPONENT);

        $params["watermark"] = JPATH_ROOT.DS.$config->get('thumb_watermark');
        $params["watermark_x"] = $config->get('thumb_watermark_x');
        $params["watermark_y"] = $config->get('thumb_watermar_y');
        $params["crop"] = $config->get('thumb_crop');
        $params["jpeg_quality"] = $config->get('thumb_jpeg_quality');

        return $params;

    }

}