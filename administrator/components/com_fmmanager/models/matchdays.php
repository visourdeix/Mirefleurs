<?php
/**
 * @package     Fmmanager
 * @subpackage  Positions
 *
 * @copyright   Copyright (C) 2015 STéphane ANDRE. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Methods supporting a list of positions records.
 *
 */
class FmmanagerModelMatchdays extends FootManager\Model\Items
{
	/**
     * Constructor.
     *
     * @param   array  $config  An optional associative array of configuration settings.
     *
     * @see     JController
     * @since   1.6
     */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'name',
                'date',
                'id'
			);
		}

		parent::__construct($config);
	}

    /**
     * Method to auto-populate the model state.
     *
     * This method should only be called once per instantiation and is designed
     * to be called on the first call to the getState() method unless the model
     * configuration flag to ignore the request is set.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @param   string  $ordering   An optional ordering field.
     * @param   string  $direction  An optional direction (asc|desc).
     *
     * @return  void
     *
     * @since   12.2
     */
	protected function populateState($ordering = null, $direction = null)
	{
        if ($this->context)
		{
			$app = JFactory::getApplication();

            $competition = $app->getUserStateFromRequest('competition', 'competition', 0, "int");

            $this->setState('competition', $competition);
            $app->setUserState($this->context.'.competition', $competition);

        }

        parent::populateState("date", "ASC");
    }

	/**
     * Method to get a store id based on model configuration state.
     *
     * This is necessary because the model is used by the component and
     * different modules that might need different sets of data or different
     * ordering requirements.
     *
     * @param   string  $id    A prefix for the store id.
     *
     * @return  string  A store id.
     * @since   1.6
     */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id .= ':' . $this->getState('competition');

		return parent::getStoreId($id);
	}

    /**
     * Build an SQL query to load the list data.
     *
     * @return  \Illuminate\Database\Eloquent\Builder
     * @since   1.6
     */
	protected function getListQuery()
	{
        $query = parent::getListQuery()
                    ->with(["matches"]);

        // Where
        $competition = (int)$this->getState('competition');
        $query = $query->where("competition_id", "=", $competition);

        return $query;

	}

    protected function _getModel() {
        return new FMManager\Database\Models\Matchday();
    }

    /**
     * Get the filter form
     *
     * @param   array    $data      data
     * @param   boolean  $loadData  load current data
     *
     * @return  JForm/false  the JForm object or false
     *
     * @since   3.2
     */
	public function getAddMultipleForm()
	{
        $form = \JForm::getInstance("addmultiple", "matchdays_addmultiple", array("control" => "addmultiple"));

        $competition_id = $this->getState('competition', 0);

        if($competition_id) {
            $competition = \FMManager\Database\Models\Competition::find($competition_id);

            $form->setFieldAttribute("matchday_copy", "competition", $competition->id, "matchdays_list");
            $form->setFieldAttribute("name", "tournament_type", $competition->tournament->type->id, "matchdays_list");
            $form->setFieldAttribute("time", "default", $competition->default_time, "matchdays_list");

            if ($competition->tournament->type->by_match) {
                $form->removeField('time', 'matchdays_list');
                $form->removeField('stadium_id', 'matchdays_list');
            }
        }

        return $form;
	}

    public function getCompetition() {
        return \FMManager\Database\Models\Competition::find($this->getState('competition'));
    }

}