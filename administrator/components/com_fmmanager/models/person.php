<?php
/**
 * @package     Fmmanager
 * @subpackage  com_fmmanager
 *
 * @copyright   Copyright (C) 2015 STéphane ANDRE. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Methods supporting a record.
 *
 */
class FmmanagerModelPerson extends FootManager\Model\Admin
{

    /**
     * Allowed batch commands
     *
     * @var array
     */
	protected $batch_commands = array(
		'category' => 'batchCategory',
        'roster' => 'batchRoster'
	);

    /**
     * Auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @return  void
     * @since    3.0
     */
    protected function preprocessForm(JForm $form, $data, $group = '') {

        $postal_codes = FMManager\Database\Models\Person::where("postal_code", "<>", "")->orderBy("postal_code")->get(["postal_code"])->unique("postal_code");
        $cities = FMManager\Database\Models\Person::where("city", "<>", "")->orderBy("city")->get(["city"])->unique("city");
        $form->setFieldAttribute("postal_code", "source", $postal_codes->implode("postal_code", ","));
        $form->setFieldAttribute("city", "source",$cities->implode("city", ","));

        parent::preprocessForm($form, $data, $group);
    }

    /**
     * Batch change a linked category.
     *
     * @param   integer  $value     The new value matching a Category ID.
     * @param   array    $pks       An array of row IDs.
     * @param   array    $contexts  An array of item contexts.
     *
     * @return  boolean  True if successful, false otherwise and internal error is set.
     *
     * @since   2.5
     */
    protected function batchCategory($value, $pks, $contexts)
    {
        if($value != -1) {
            foreach ($pks as $pk)
            {
                if ($this->user->authorise('persons.edit', $contexts[$pk]))
                {
                    $this->table->reset();
                    $this->table->load($pk);

                    if($value > 0 || ($value == -2 && $this->table->category_id && strtotime($this->table->birthdate))) {

                        if($value == -2){
                            $date = new JDate($this->table->birthdate);
                            $year = $date->format("Y");
                            $category = FMManager\Database\Models\Category::where("year", ">=", (int)$year)->orderBy("year", "ASC")->first();
                            if($category) $category_id = $category->id;
                        } else
                            $category_id = (int) $value;

                        if (isset($category_id) && $category_id)
                            $this->table->category_id = (int) $category_id;

                        if (!$this->table->store())
                        {
                            $this->setError($this->table->getError());

                            return false;
                        }
                    }
                }
                else
                {
                    $this->setError(JText::_('JLIB_APPLICATION_ERROR_BATCH_CANNOT_EDIT'));

                    return false;
                }
            }
        }

        // Clean the cache
        $this->cleanCache();

        return true;
    }

    /**
     * Batch change a linked roster.
     *
     * @param   integer  $value     The new value matching a Category ID.
     * @param   array    $pks       An array of row IDs.
     * @param   array    $contexts  An array of item contexts.
     *
     * @return  boolean  True if successful, false otherwise and internal error is set.
     *
     * @since   2.5
     */
    protected function batchRoster($value, $pks, $contexts)
    {
        if($value) {
            if ($this->user->authorise('rosters.edit'))
            {
                $table = JTable::getInstance("Roster", "FmmanagerTable");
                if($table->load($value)) {
                    $players_ids = FootManager\Utilities\ArrayHelper::getColumn($table->players, "id");
                    $new_players = array();

                    foreach ($pks as $pk)
                    {
                    	if(!in_array($pk, $players_ids)) {
                            $person = FMManager\Database\Models\Person::find($pk);
                            $player = new stdClass();
                            $player->person_id = $pk;
                            $player->position_id = $person->position_id;
                            $player->category_id = $person->category_id;
                            $player->outclassed = 0;
                            array_push($new_players, $player);
                        }
                    }

                    $table->players = array_merge($table->players, $new_players);

                    if (!$table->store())
                    {
                        $this->setError($table->getError());

                        return false;
                    }
                }

            }
            else
            {
                $this->setError(JText::_('JLIB_APPLICATION_ERROR_BATCH_CANNOT_EDIT'));

                return false;
            }

        }

        // Clean the cache
        $this->cleanCache();

        return true;
    }

    /**
     * Method to toggle the featured setting of articles.
     *
     * @param   array    $pks    The ids of the items to toggle.
     * @param   integer  $value  The value to toggle to.
     *
     * @return  boolean  True on success.
     */
	public function active($pks, $value = 0)
	{
		// Sanitize the ids.
		$pks = (array) $pks;
		JArrayHelper::toInteger($pks);
        $user = JFactory::getUser();
        $table = $this->getTable();

		if (empty($pks))
		{
			$this->setError(JText::_('COM_FMMANAGER_MESSAGE_NO_ITEM_SELECTED'));

			return false;
		}

        foreach ($pks as $pk)
        {
            if ($user->authorise('persons.manager'))
            {
                $table->reset();
                $table->load($pk);

                $table->active = (int) $value;

                if (!$table->check())
                {
                    $this->setError($table->getError());

                    return false;
                }

                if (!$table->store())
                {
                    $this->setError($table->getError());

                    return false;
                }
            }
        }

		$this->cleanCache();

		return true;
	}

}