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
class FmgalleryModelVideos extends FMGallery\Model\Backend\Medias
{

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @param   string  $ordering   An optional ordering field.
     * @param   string  $direction  An optional direction (asc|desc).
     *
     * @return  void
     *
     * @since   1.6
     */
	protected function populateState($ordering = null, $direction = null)
	{
		// List state information.
		parent::populateState('date', 'desc');

	}

    protected function _getModel() {
        return new FMGallery\Database\Models\Video();
    }

}