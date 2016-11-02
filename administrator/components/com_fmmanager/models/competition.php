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
class FmmanagerModelCompetition extends FootManager\Model\Admin
{

    /**
     * Auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @return  void
     * @since    3.0
     */
    protected function preprocessForm(JForm $form, $data, $group = '') {

        $form->setFieldAttribute("ranking_columns", "default", json_encode(\FMManager\Helper::$RANKING_COLUMNS));
        $form->setFieldAttribute("ranking_sort", "default", json_encode(\FMManager\Helper::$RANKING_SORT));

        parent::preprocessForm($form, $data, $group);
    }
}