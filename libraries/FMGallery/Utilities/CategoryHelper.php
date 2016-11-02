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
abstract class CategoryHelper
{

    public static function createCategory($title, $parent_id = 1, $date = "", $parent_folder = "", $newdata = array()) {
        $table = \JTable::getInstance("Category");

        $data = array();
        $data["title"] = $title;
        $data["access"] = 1;
        $data["published"] = 1;
        $data["language"] = "*";
        $data["extension"] = FM_GALLERY_COMPONENT;

        $alias_date = "";
        if(\FootManager\Utilities\DateHelper::isValid($date)) {
            $date = new \JDate($date);
            $data["params"]["date"] = $date->format('Y-m-d G:i:s');
            $alias_date = $date->format('Ymd')."-";
        }

        // Alter the title & alias
        $data["alias"] = \JApplication::stringURLSafe($alias_date.$title);

        if(!$table->load(array("alias" => $data["alias"], "parent_id" => $parent_id, "extension" => FM_GALLERY_COMPONENT))) {

            if($parent_folder == '') {
                if($parent_id > 1) {
                    $parent_table = \JTable::getInstance("Category");
                    if($parent_table->load($parent_id)) {
                        $params = json_decode($parent_table->params);
                        $parent_folder = $params->folder;
                    };
                }

            }

            if($parent_folder !== "") {
                FileHelper::createFolder($parent_folder, $data["alias"]);
            }

            $data["params"]["folder"] = $parent_folder.DS.$data["alias"];

            $data = array_merge($data, $newdata);

            // Set the new parent id if parent id not matched OR while New/Save as Copy .
            if ($parent_id)
            {
                $table->setLocation($parent_id, 'last-child');
            }

            // Bind the data.
            if (!$table->bind($data))
            {
                return $table->getError();
            }

            // Check the data.
            if (!$table->check())
            {
                return $table->getError();
            }

            // Store the data.
            if (!$table->store())
            {
                return $table->getError();
            }

            // Rebuild the path for the category:
            if (!$table->rebuildPath($table->id))
            {
                return $table->getError();
            }

            // Rebuild the paths of the category's children:
            if (!$table->rebuild($table->id, $table->lft, $table->level, $table->path))
            {
                return $table->getError();
            }
        }

        return $table;
    }

}