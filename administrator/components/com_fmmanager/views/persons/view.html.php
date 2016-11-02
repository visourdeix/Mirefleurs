<?php
/**
 * @package      Fmmanager
 * @subpackage   com_fmmanager
 *
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 */

defined('_JEXEC') or die();

class FmmanagerViewPersons extends FootManager\View\Items
{
    protected function canAdd() {
        return $this->
actions->get("persons.manage");
    }

    protected function canEdit($id = null, $i = 0) {
        return $this->actions->get("persons.manage");
    }

    protected function canDelete() {
        return $this->actions->get("persons.manage");
    }

    protected function getFields() {
        $fields = array();

        if($this->getLayout() != 'modal')
            $fields["active"] = array("width" => "1%", "sortable" => true, "class" => "center");

        $fields["photo"] = array("width" => "50px", "class" => "", "header" => "");
        $fields["name"] = array("linkable" => true, "sortable" => true, "sort" => "last_name", "class" => "has-context", "header" => "COM_FMMANAGER_FIELD_NAME");

        if($this->getLayout() != 'modal')
            $fields["license"] = array("sortable" => true, "class" => "hidden-phone");

        $fields["gender"] = array("sortable" => true, "class" => "center hidden-phone");
        $fields["category"] = array("sortable" => true, "sort" => "fm_categories.ordering");

        if($this->getLayout() != 'modal') {
            $fields["birthdate"] = array("sortable" => true, "class" => "center hidden-phone");
            $fields["address"] = array("class" => "hidden-phone");
            $fields["contacts"] = array("class" => "hidden-phone");
        }

        return $fields;
    }

    protected function formatValue($key, $item, $i) {
        switch ($key)
        {

            case "name":
                return $item->last_name.'<br />'.$item->first_name;
                break;

            case "active" :
                if($this->canEdit()) {
                    if($item->active)
                        return FootManager\UI\Html\Button::link("javascript:void(0)", "", "fa fa-check", array("onclick" => 'listItemTask(\'cb' . $i . '\', \'persons.inactive\')', "class" => "btn-success btn-mini hasTooltip", "title" => JText::_("COM_FMMNAGER_BUTTON_INACTIVE")));
                    else
                        return FootManager\UI\Html\Button::link("javascript:void(0)", "", "fa fa-remove", array("onclick" => 'listItemTask(\'cb' . $i . '\', \'persons.active\')', "class" => "btn-danger btn-mini hasTooltip", "title" => JText::_("COM_FMMNAGER_BUTTON_ACTIVE")));
                } else {
                    if($item->active)
                        return "<span class='fa fa-check fm-text-color-green'></span>";
                    else
                        return "<span class='fa fa-remove fm-text-color-red'></span>";
                }

            case "photo" :
                return FMManager\Html\Person::image($item);

            case "gender" :
                if($item->gender) {
                    switch($item->gender) {
                        case 2 :
                            $icon = "venus";
                            $color="pink";
                            break;

                        default:
                            $icon = "mars";
                            $color="light-blue";

                    }

                    return '<span class="fm-text-140 fm-text-color-'.$color.'">
                                <span class="hasTooltip fa fa-'.$icon.'" title='.JText::_("FMLIB_GENDER_".$item->gender).'></span>
                            </span>';
                }
                break;

            case "category":
                if($item->category) {
                    return '<span class="fm-text-bold" style="color:'.$item->category->color.'">'.$item->category->label.'</span>';
                }
                break;

            case "birthdate":
                if ($item->birthdate) {
                    return '<span class="hasTooltip" title="' .$item->birthdate->format('l d F Y') . '">' . $item->birthdate->format('d-m-Y') . '</span>';
                }
                break;

            case "address":
                return $item->address.'<br />'.$item->postal_code.' '.$item->city;

            case "contacts" :
                $contacts = array();
                foreach ($item->contacts as $contact)
                {
                    $value = "";
                    switch($contact->type) {
                        case 1 :
                        case 2 :
                            $value = '<a href="tel:'.$contact->value.'">'.$contact->value.'</a>';
                            break;

                        case 3:
                            $value = '<a href="mailto:'.$contact->value.'">'.$contact->value.'</a>';
                            break;

                        default:
                            $value = $contact->value;
                    }
                    $label = ($contact->label) ? $contact->label : JText::_("FMLIB_CONTACT_".$contact->type);
                    $contacts[]= $value.' <i>('.$label.')</i>';
                }
                return implode("<br />", $contacts);

        	default:
                return parent::formatValue($key, $item, $i);
        }

    }

    protected function addToolbarButtons() {
        parent::addToolbarButtons();

        if($this->canEdit()) FootManager\UI\Html\Toolbar::taskbutton('persons.active', "COM_FMMNAGER_BUTTON_ACTIVE", "fa fa-check");
        if($this->canEdit())  FootManager\UI\Html\Toolbar::taskbutton('persons.inactive', "COM_FMMNAGER_BUTTON_INACTIVE", "icon-delete");
    }

}