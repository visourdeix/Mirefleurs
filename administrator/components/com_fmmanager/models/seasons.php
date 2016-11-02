<?php
/**
 * @package     Fmmanager
 * @subpackage  Positions
 *
 * @copyright   Copyright (C) 2015 STéphane ANDRE. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Methods supporting a list of positions records.
 *
 */
class FmmanagerModelSeasons extends FMManager\Model\Backend\DataList {

    /**
     * Set the query.
     * @param JDatabaseQuery $query
     */
    protected function getListQuery() {
        return parent::getListQuery()->with("managers");
    }

    protected function _getModel() {
        return new FMManager\Database\Models\Season();
    }
}