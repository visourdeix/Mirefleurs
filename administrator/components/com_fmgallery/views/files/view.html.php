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

class FmgalleryViewFiles extends \FMGallery\View\Backend\Medias
{
    /**
     * Add the toolbar buttons.
     */
    protected function addToolbarButtons() {
        $canDo = \JHelperContent::getActions(FM_GALLERY_COMPONENT, 'category', $this->state->get('filter.category_id'));
		$user  = \JFactory::getUser();

		if (($canDo->get('core.create') || (count($user->getAuthorisedCategories(FM_GALLERY_COMPONENT, 'core.create'))) > 0) && $this->canAdd())
		{
            \JToolbarHelper::addNew($this->getEditView().'.add');
		}

		if (($canDo->get('core.edit')) || ($canDo->get('core.edit.own')))
		{
			\JToolbarHelper::editList($this->getEditView().'.edit');
		}

		if ($canDo->get('core.edit.state'))
		{
			\JToolbarHelper::publish($this->getName().'.publish', 'JTOOLBAR_PUBLISH', true);
			\JToolbarHelper::unpublish($this->getName().'.unpublish', 'JTOOLBAR_UNPUBLISH', true);
			\JToolbarHelper::archiveList($this->getName().'.archive');
		}

		// Add a batch button
		if ($user->authorise('core.create', FM_GALLERY_COMPONENT)
			&& $user->authorise('core.edit', FM_GALLERY_COMPONENT)
			&& $user->authorise('core.edit.state', FM_GALLERY_COMPONENT))
		{
            parent::addBatchButton();
		}

		if ($this->state->get('filter.published') == -2 && $canDo->get('core.delete'))
		{
			\JToolbarHelper::deleteList('', $this->getName().'.delete', 'JTOOLBAR_EMPTY_TRASH');
		}
		elseif ($canDo->get('core.edit.state'))
		{
			\JToolbarHelper::trash($this->getName().'.trash');
		}

		if ($this->actions->get('core.admin') && !empty($this->component)) {
            \JToolBarHelper::preferences($this->component);
        }

    }

    protected function getFields() {
        return array(
            "state" =>  array("width" => "1%", "sortable" => true, "class" => "center", "header" => "JSTATUS"),
            "thumb" =>  array("width" => "50px", "class" => "center", "header" => ""),
            "title" =>  array("sortable" => true, "linkable" => true, "header" => "JGLOBAL_TITLE"),
            "access" =>  array("width" => "10%", "sortable" => true, "class" => "hidden-phone", "header" => "JGRID_HEADING_ACCESS", "sort" => "viewlevels.title"),
            "created" =>  array("width" => "10%", "sortable" => true, "class" => "hidden-phone", "header" => "JDATE")
            );
    }
}