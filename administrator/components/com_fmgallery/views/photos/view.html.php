<?php
/**
 * @package      Fmmanager
 * @subpackage   Dashboard
 *
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 */

defined('_JEXEC') or die();

class FmgalleryViewPhotos extends \FMGallery\View\Backend\Medias
{

    protected function canAdd() {
        return false;
    }

    /**
     * Add the toolbar buttons.
     */
    protected function addToolbarButtons() {
        $canDo = JHelperContent::getActions(FM_GALLERY_COMPONENT, 'category', $this->state->get('filter.category_id'));
		$user  = JFactory::getUser();

		if ($canDo->get('core.create') || (count($user->getAuthorisedCategories(FM_GALLERY_COMPONENT, 'core.create'))) > 0 )
		{
            FootManager\UI\Html\Toolbar::linkbutton("index.php?option=".FM_GALLERY_COMPONENT.'&view=addphotos', "COM_FMGALLERY_ADD_NEW_PHOTOS", "fa fa-plus-circle", array("class" => "btn-success"));
		}

        parent::addToolbarButtons();

    }
}