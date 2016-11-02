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
class FmgalleryModelPhoto extends FMGallery\Model\Backend\Media
{

    /**
     * Prepare and sanitise the table data prior to saving.
     *
     * @param   \JTable  $table  A JTable object.
     *
     * @return  void
     *
     * @since   1.6
     */
	protected function prepareTable($table)
	{
		parent::prepareTable($table);

        if(empty($table->date) && JFile::exists(JPATH_ROOT.DS.$table->file)) {
            $exif_data = exif_read_data (JPATH_ROOT.DS.$table->file);
            if (!empty($exif_data['DateTimeOriginal']) && \FootManager\Utilities\DateHelper::isValid($exif_data['DateTimeOriginal'])) {
                $table->date = $exif_data['DateTimeOriginal'];
            }
        }

	}

}