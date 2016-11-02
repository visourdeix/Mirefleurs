<?php
/**
 * @package     Fmmanager
 * @subpackage  Position
 *
 * @copyright   Copyright (C) 2015 STéphane ANDRE. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Methods supporting a list of positions records.
 *
 */
class FmgalleryModelData extends JModelLegacy {

    public function getCategory($id) {
        return \FMGallery\Database\Models\Category::find($id);
    }
}