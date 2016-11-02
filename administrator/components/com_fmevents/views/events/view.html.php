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

class FmeventsViewEvents extends FootManager\View\Items
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
        $canDo = JHelperContent::getActions(FM_EVENTS_COMPONENT, 'category', $this->state->get('filter.category_id'));
		$user  = JFactory::getUser();

        // Create
        if ($canDo->get('core.create') || (count($user->getAuthorisedCategories(FM_EVENTS_COMPONENT, 'core.create'))) > 0 )
			JToolbarHelper::addNew('event.add');

        // Edit
		if (($canDo->get('core.edit')) || ($canDo->get('core.edit.own')))
			JToolbarHelper::editList('event.edit');

        // Publish
		if ($canDo->get('core.edit.state')) {
			JToolbarHelper::publish('events.publish', 'JTOOLBAR_PUBLISH', true);
			JToolbarHelper::unpublish('events.unpublish', 'JTOOLBAR_UNPUBLISH', true);
			JToolbarHelper::archiveList('events.archive');
		}

		// Batch
		if ($user->authorise('core.create', FM_EVENTS_COMPONENT)
			&& $user->authorise('core.edit', FM_EVENTS_COMPONENT)
			&& $user->authorise('core.edit.state', FM_EVENTS_COMPONENT))
            parent::addBatchButton();

        // Published
		if ($this->state->get('filter.published') == -2 && $canDo->get('core.delete'))
			JToolbarHelper::deleteList('', 'events.delete', 'JTOOLBAR_EMPTY_TRASH');
		elseif ($canDo->get('core.edit.state'))
			JToolbarHelper::trash('events.trash');

        // Preference
		if ($this->actions->get('core.admin') && !empty($this->component)) {
            JToolBarHelper::preferences($this->component);
        }

    }

    protected function getFields() {
        return array(
            "state" =>  array("width" => "1%", "sortable" => true, "class" => "center", "header" => "JSTATUS"),
            "photo" =>  array("width" => "50px", "class" => "center", "header" => ""),
            "title" =>  array("sortable" => true, "linkable" => true, "header" => "JGLOBAL_TITLE"),
            "date" =>  array("width" => "14%", "sortable" => true, "class" => "center", "header" => "JDATE", "sort" => "start_date"),
            "access" =>  array("width" => "10%", "sortable" => true, "class" => "hidden-phone", "header" => "JGRID_HEADING_ACCESS", "sort" => "viewlevels.title")
            );
    }

    protected function formatValue($key, $item, $i) {
        $user = \JFactory::getUser();
        switch ($key)
        {
            case "state":
                $archived  = $this->state->get('filter.published') == 2 ? true : false;
                $trashed   = $this->state->get('filter.published') == -2 ? true : false;
                $canCreate  = $user->authorise('core.create',     FM_EVENTS_COMPONENT.'.category.' . $item->catid);
                $html = '<div class="btn-group">';
                $html .= FootManager\UI\Html\Grid::published($item->state, $i, 'events.', $canCreate, 'cb');

                // Create dropdown items
                $action = $archived ? 'unarchive' : 'archive';
                FootManager\UI\Html\Actionsdropdown::$action('cb' . $i, 'events');
                $action = $trashed ? 'untrash' : 'trash';
                FootManager\UI\Html\Actionsdropdown::$action('cb' . $i, 'events');
                // Render dropdown list
                $html .= FootManager\UI\Html\Actionsdropdown::render($item->title);
                $html .=  '</div>';
                return $html;

            case "photo" :
                return \FMEvents\Html\Event::image($item, array("style" => "height:30px;width:auto;"));

            case "title":
                $html ='<div class="pull-left break-word">';
                $html .= '<span>'.$item->title.' <span>';
                $html .= '<span class="small break-word">';
                $html .= JText::sprintf('JGLOBAL_LIST_ALIAS', $this->escape($item->alias));
                $html .= '</span>';
                $html .= '<div class="small">';
                $html .= JText::_('JCATEGORY') . ": " . $this->escape($item->category->title);
                $html .= '</div>';
                $html .= '</div>';
                return $html;

            case "access" :
                return $item->viewlevel->title;

            case "date" :

                if($item->start_date == $item->end_date)
                    return '<b>'.$item->start_date_time->format('l d F Y').'</b><br />'.$item->start_date_time->format('G:i').' - '.$item->end_date_time->format('G:i');
                else
                    return '<b>'.$item->start_date_time->format('d F Y G:i').' - '.$item->end_date_time->format('d F Y G:i').'</b>';

                break;

        	default:
                return parent::formatValue($key, $item, $i);
        }
        return "";
    }

}