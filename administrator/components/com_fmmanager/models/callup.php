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
class FmmanagerModelCallup extends FootManager\Model\Admin
{

    /**
     * Stock method to auto-populate the model state.
     *
     * @return  void
     *
     * @since   12.2
     */
    protected function populateState() {
        parent::populateState();

        $app = JFactory::getApplication('administrator');
        $type = $app->input->get("type", null, 'base64');
        $event_id = $app->input->get("event_id", null, 'int');

        $this->setState("type", base64_decode($type));
        $this->setState("event_id", $event_id);
    }

    /**
     * Method to get a menu item.
     *
     * @param   integer  $pk  An optional id of the object to get, otherwise the id from the model state is used.
     *
     * @return  mixed  Menu item data object on success, false on failure.
     *
     * @since   1.6
     */
	public function getItem($pk = null)
	{
        if($item = parent::getItem()) {

            $type = $this->getState("type", "");
            $evenId = $this->getState("event_id", 0);

            if($type && $evenId) {

                $modelName = "FMManager\Database\Models\\".ucfirst($type);
                $model = new $modelName();
                $model = $model->find($evenId);
                if(!$item->id) {
                    $item->date = $model->defaultDate()->format("Y-m-d");
                    $item->time = $model->defaultStartTime()->format("G:i:s");
                    if($end_date = $model->defaultEndTime()) $item->end_time = $end_date->format("G:i:s");
                    if($stadium = $model->defaultStadium()) $item->stadium_id = $stadium->id;
                    $item->contacts = $model->defaultContacts()->getColumn("person_id")->toArray();
                }

                $item->event = $model;
                $item->category_id = $model->category()->id;

            }
        }

        return $item;
    }

    /**
     * Auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @return  void
     * @since    3.0
     */
    protected function preprocessForm(JForm $form, $data, $group = 'fmmanager') {
        if ($data) {

            if(isset($data->event)) {

                $allpersons_id = $data->event->allPersons()->getColumn("person_id")->toArray();
                $persons_id = empty($data->persons) ? $allpersons_id : array_merge($allpersons_id, $data->persons);

                $allcontacts_id = $data->event->allContacts()->getColumn("person_id")->toArray();
                $contacts_id = empty($data->contacts) ? $allcontacts_id : array_merge($allcontacts_id, $data->contacts);

                $form->setFieldAttribute("persons", "persons", implode(",",$persons_id));
                $form->setFieldAttribute("contacts", "persons", implode(",",$contacts_id));
            }

            $venues = FMManager\Database\Models\Callup::orderBy("venue")->get(["venue"])->getColumn("venue")->toArray();
            $form->setFieldAttribute("venue", "source", implode(",", (array)$venues));
        }

        parent::preprocessForm($form, $data, $group);
    }

    /**
     * Method to save the form data.
     *
     * @param   array  $data  The form data.
     *
     * @return  boolean  True on success, False on error.
     *
     * @since   12.2
     */
	public function save($data)
	{
        if(parent::save($data)) {

            $app = JFactory::getApplication('administrator');
            $type = $app->input->get("type", null, 'base64');
            $type = base64_decode($type);
            $event_id = $app->input->get("event_id", null, 'int');
            $id = $this->getState($this->getName() . '.id', 0);

            if($type) {
                $eventTable = JTable::getInstance($type, "FmmanagerTable");
                // Allow an exception to be thrown.
                try
                {
                    // Load the row if saving an existing record.
                    if ($event_id > 0)
                    {
                        $eventTable->load($event_id);
                        $eventTable->call_up_id = $id;
                    }

                    // Store the data.
                    if (!$eventTable->store())
                    {
                        $this->setError($eventTable->getError());

                        return false;
                    }

                    // Clean the cache.
                    $this->cleanCache();
                }
                catch (Exception $e)
                {
                    $this->setError($e->getMessage());

                    return false;
                }

                return true;
            }

        }
        return false;
	}

}