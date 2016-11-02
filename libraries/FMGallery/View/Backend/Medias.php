<?php
/**
 * @package      Fmmanager
 * @subpackage   Dashboard
 *
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 */

namespace FMGallery\View\Backend;

defined('_JEXEC') or die();

class Medias extends \FootManager\View\Items
{

    protected function canAdd() {
        return $this->actions->get("core.manage");
    }

    protected function canEdit($id = null, $i = 0) {
        return $this->actions->get("core.manage");
    }

    protected function canDelete() {
        return $this->actions->get("core.manage");
    }

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
            \JToolbarHelper::custom($this->getName().'.recreateThumbnails', 'copy', '', \JText::_('COM_FMGALLERY_RECREATE_THUMBNAILS'));
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
            "action" =>  array("width" => "1%", "class" => "center", "header" => "COM_FMGALLERY_FIELD_THUMBNAILS"),
            "thumb" =>  array("width" => "50px", "class" => "center", "header" => ""),
            "title" =>  array("sortable" => true, "linkable" => true, "header" => "JGLOBAL_TITLE"),
            "access" =>  array("width" => "10%", "sortable" => true, "class" => "hidden-phone", "header" => "JGRID_HEADING_ACCESS", "sort" => "viewlevels.title"),
            "date" =>  array("width" => "10%", "sortable" => true, "class" => "hidden-phone", "header" => "JDATE")
            );
    }

    protected function formatValue($key, $item, $i) {
        $user = \JFactory::getUser();
        switch ($key)
        {
            case "state":
                $archived  = $this->state->get('filter.published') == 2 ? true : false;
                $trashed   = $this->state->get('filter.published') == -2 ? true : false;
                $canCreate  = $user->authorise('core.create',     FM_GALLERY_COMPONENT.'.category.' . $item->catid);
                $html = '<div class="btn-group">';
                $html .= \FootManager\UI\Html\Grid::published($item->state, $i, $this->getName().'.', $canCreate, 'cb');

                // Create dropdown items
                $action = $archived ? 'unarchive' : 'archive';
                \FootManager\UI\Html\Actionsdropdown::$action('cb' . $i, $this->getName());
                $action = $trashed ? 'untrash' : 'trash';
                \FootManager\UI\Html\Actionsdropdown::$action('cb' . $i, $this->getName());
                // Render dropdown list
                $html .= \FootManager\UI\Html\Actionsdropdown::render($item->title);
                $html .=  '</div>';
                return $html;

            case "action":
                return \FootManager\UI\Html\Html::link("javascript:void(0);", '<i class="icon-copy"></i>', array("class" => "btn btn-mini hasTooltip", "title" => \JText::_("COM_FMGALLERY_RECREATE_THUMBNAILS"), "onclick" => "return listItemTask('cb".$i."','".$this->getName().".recreateThumbnails')"));

            case "thumb" :
                $class = "\FMGallery\Html\\".ucfirst($this->getEditView());
                return $class::image($item, "small", array("alt" => $item->title, "style" => "max-height:50px;width:auto"));

            case "title":
                $html ='<div class="pull-left break-word">';
                $html .= '<span>'.$item->title.' <span>';
                $html .= '<span class="small break-word">';
                $html .= \JText::sprintf('JGLOBAL_LIST_ALIAS', $this->escape($item->alias));
                $html .= '</span>';
                $html .= '<div class="small">';
                $html .= \JText::_('JCATEGORY') . ": " . $this->escape($item->category->title);
                $html .= '</div>';
                $html .= '</div>';
                return $html;

            case "access" :
                return $item->viewlevel->title;

            case "date" :
                if($item->date)
                    return \JHtml::_('date', $item->date, \JText::_('DATE_FORMAT_LC4'));
                return "";

        	default:
                return parent::formatValue($key, $item, $i);
        }
    }

}