<?php
/**
 * @package     Fmmanager
 * @subpackage  com_fmmanager
 *
 * @copyright   Copyright (C) 2015 STéphane ANDRE. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Methods supporting a list of records.
 *
 */
class FmmanagerModelDiplomas extends FMManager\Model\Backend\DataList {

    protected function _getModel() {
        return new FMManager\Database\Models\Diploma();

    }
}