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

class FmactivityViewActivities extends FootManager\View\Items
{

    protected function canAdd() {
        return false;
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
        $canDo = JHelperContent::getActions(FM_ACTIVITY_COMPONENT);
		$user  = JFactory::getUser();

        // Edit
		if (($canDo->get('core.edit')) || ($canDo->get('core.edit.own')))
			JToolbarHelper::editList('activity.edit');

        // Publish
		if ($canDo->get('core.edit.state')) {
			JToolbarHelper::publish('activities.publish', 'JTOOLBAR_PUBLISH', true);
			JToolbarHelper::unpublish('activities.unpublish', 'JTOOLBAR_UNPUBLISH', true);
            JToolbarHelper::custom('activities.featured', 'featured.png', 'featured_f2.png', 'JFEATURE', true);
			JToolbarHelper::custom('activities.unfeatured', 'unfeatured.png', 'featured_f2.png', 'JUNFEATURE', true);
			JToolbarHelper::archiveList('activities.archive');
		}

        // Published
		if ($this->state->get('filter.published') == -2 && $canDo->get('core.delete'))
			JToolbarHelper::deleteList('', 'activities.delete', 'JTOOLBAR_EMPTY_TRASH');
		elseif ($canDo->get('core.edit.state'))
			JToolbarHelper::trash('activities.trash');

        // Preference
		if ($this->actions->get('core.admin') && !empty($this->component)) {
            JToolBarHelper::preferences($this->component);
        }

    }

    protected function getFields() {
        return array(
            "state" =>  array("width" => "1%", "sortable" => true, "class" => "center", "header" => "JSTATUS"),
            "title" =>  array("header" => "COM_FMACTIVITY_FIELD_ACTIVITY"),
            "extension" =>  array("class" => "hidden-phone"),
            "created" =>  array("width" => "14%", "sortable" => true, "class" => "center hidden-phone", "header" => "JDATE"),
            "access" =>  array("width" => "10%", "sortable" => true, "class" => "hidden-phone", "header" => "JGRID_HEADING_ACCESS", "sort" => "viewlevels.title")
            );
    }

    protected function formatValue($key, $item, $i) {
        switch ($key)
        {
            case "state":
                $archived  = $this->state->get('filter.published') == 2 ? true : false;
                $trashed   = $this->state->get('filter.published') == -2 ? true : false;
                $html = '<div class="btn-group">';
                $html .= FootManager\UI\Html\Grid::published($item->state, $i, 'activities.', true, 'cb');
                $html .= FootManager\UI\Html\Grid::featured($item->featured, $i, 'activities.', true, 'cb');

                // Create dropdown items
                $action = $archived ? 'unarchive' : 'archive';
                FootManager\UI\Html\Actionsdropdown::$action('cb' . $i, 'activities');
                $action = $trashed ? 'untrash' : 'trash';
                FootManager\UI\Html\Actionsdropdown::$action('cb' . $i, 'activities');
                // Render dropdown list
                $html .= FootManager\UI\Html\Actionsdropdown::render($item->title);
                $html .=  '</div>';
                return $html;

            case "title":
                $html ='<div class="pull-left break-word">';
                $html .= '<span>'.$item->text.' <span>';
                $html .= '</div>';
                return $html;

            case "extension":
                $html ='<div>';
                $html .= '<b>'.$item->extension.'</b>';
                $html .= '</div>';
                $html .= '<div class="small">';
                $html .= $item->view;
                $html .= '</div>';
                return $html;

            case "access" :
                return $item->viewlevel->title;

            case "created" :
                return $item->created->format('d/m/y H:i');

        	default:
                return parent::formatValue($key, $item, $i);
        }
    }

}