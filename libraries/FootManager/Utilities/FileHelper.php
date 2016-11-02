<?php
/**
 * @package      FootManager
 * @subpackage   Utilities
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FootManager\Utilities;

defined('JPATH_PLATFORM') or die;

/**
 * Projectfork Date Helper Class
 *
 */
abstract class FileHelper
{
    /**
     * Gets the full path of a file. If it doesn't exist, get a default path defined in Configuration.
     * @return mixed
     */
    public static function getFullPath($rel_path, $replace_field_in_config = "empty_image", $component = '') {

        if($rel_path && \JFile::exists(JPATH_ROOT . DS . $rel_path))
            $file = $rel_path;
        else
            $file = \FootManager\Helpers\Application::getConfiguration($component)->get($replace_field_in_config, '');

        if($file) return \JUri::root() . DS . $file;

        return "";
    }

    public static function createFolder($path, $folderName) {

		if (strlen($folderName) > 0) {
			$folder = \JPath::clean($path.DS.$folderName);
			if (!\JFolder::exists($folder) && !\JFile::exists($folder)) {
                \JFolder::create($folder, 0777 );

				if (isset($folder)) {
					$data = "<html>\n<body bgcolor=\"#FFFFFF\">\n</body>\n</html>";
					\JFile::write($folder.DS."index.html", $data);

                    return true;
				}
			}
		}

        return false;
	}

    public static function listDirectory($dir)
    {
        $result = array();
        $root = scandir($dir);
        foreach($root as $value) {
            if($value === '.' || $value === '..') {
                continue;
            }

            if(is_file($dir.DS.$value)) {
                $result[] = $dir.DS.$value;
                continue;
            }
            if(is_dir($dir.DS.$value)) {
                $result[] = $dir.DS.$value;
            }
            foreach(self::listDirectory($dir.DS.$value) as $value)
            {
                $result[] = $value;
            }
        }
        return $result;
    }

    // Here the magic happens :)
    public static function zipFolder($source, $destination) {
        if (extension_loaded('zip')) {

            if (\JFolder::exists($source)) {
                $zip = new \ZipArchive();
                if ($zip->open($destination, \ZIPARCHIVE::CREATE)) {
                    $source = realpath($source);
                    $files = self::listDirectory($source);

                    foreach ($files as $file) {

                        $relativeFile = str_replace($source.DS, '', $file);

                        if($relativeFile != "" && $file != $destination) {
                            if (is_dir($file)) {
                                $zip->addEmptyDir($relativeFile);
                            } else if (is_file($file)) {
                                $zip->addFromString($relativeFile, file_get_contents($file));
                            }
                        }
                    }
                }
                return $zip->close();
            }
        }
        return false;
    }

}