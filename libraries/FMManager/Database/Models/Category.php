<?php
/**
 * @package      FMManager
 * @subpackage   Models
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FMManager\Database\Models;

defined('JPATH_PLATFORM') or die;

use FootManager\Database\Models;

/**
 * This class contains common methods and properties for a database item
 *
 * @package      FMManager
 * @subpackage   Models
 */
class Category extends Models\ByOrdering {

    /**
     * Main Table.
     * @var string
     */
    protected $table = "fm_categories";

    /**
     * Get allowed categories.
     * @param array $rights
     */
    public static function isAllowed($rights) {
        $categories = static::all();
        $user = \JFactory::getUser();
        $categories = $categories->filter(function($obj) use($rights, $user) {
            foreach ($rights as $right) {
            	if($user->authorise($right.".edit", FM_MANAGER_COMPONENT.".category." . $obj->id)) {
                    return true;
                }
            }
            return false;
        });
        return $categories;
    }

}

?>