<?php
/**
 * @package      Fmmanager
 * @subpackage   Dashboard
 *
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 */

namespace FMManager\View\Backend;

defined('_JEXEC') or die();

class Event extends \FootManager\View\Edit
{

    protected function canEditConvocation() {
        if($this->item) {
            return  $this->user->authorise( "call_up.edit", $this->component.".category." . $this->item->competition->tournament->category_id ) && \FootManager\Utilities\DateHelper::isAfterToday( $this->item->date.' '.$this->item->time) && $this->item->state == \FMManager\Constants::NOT_PLAYED;
        }

        return false;
    }

    /**
     * Add the toolbar buttons.
     */
    protected function addToolbarButtons() {
        parent::addToolbarButtons();

        if($this->canEditConvocation()) {

            $return_page = "&return_page=".base64_encode(\JFactory::getUri());
            $callUpParam = ($this->item->call_up_id) ? '&id='.$this->item->call_up_id : '';
            $matchParam = ($this->item->id) ? '&type='.base64_encode(ucfirst($this->getName())).'&event_id='.$this->item->id : '';

            $title =  ($this->item->call_up_id) ? "COM_FMMANAGER_EDIT_CALL_UP" : "COM_FMMANAGER_CREATE_CALL_UP";
            $class = "btn-primary btn-small";
            $icon = "fa fa-bell";
            $link = \JRoute::_('index.php?option='.$this->component.'&task=callup.edit'.$callUpParam.$return_page.$matchParam);

            \FootManager\UI\Html\Button\Group::addLink($link, $title, $icon, array("class" => $class));

            if($this->item->call_up_id) {
                \FootManager\UI\Html\Button\Group::addTask($this->getName().".applyAndDeleteCallUp", "COM_FMMANAGER_REMOVE_CALL_UP", "", array(), true);
            }

            \FootManager\UI\Html\Toolbar::buttonsgroup($class);

        }
    }
}