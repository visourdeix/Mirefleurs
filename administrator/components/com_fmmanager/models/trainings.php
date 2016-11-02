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
 * Methods supporting a list of persons records.
 *
 */
class FmmanagerModelTrainings extends FootManager\Model\Items
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
				'date',
				'fm_stadiums.name',
                'stadium',
                'state'
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

            $period = $app->getUserStateFromRequest('period', 'period', "future", "string");

            $this->setState('period', $period);
            $app->setUserState($this->context.'.period', $period);

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
        $id .= ':' . $this->getState('period');
        $id .= ':' . $this->getState('filter.roster');
        $id .= ':' . $this->getState('filter.state');
        $id .= ':' . $this->getState('filter.stadium');

		return parent::getStoreId($id);
	}

    /**
     * Build an SQL query to load the list data.
     *
     * @return  \FootManager\Database\Eloquent\Builder
     * @since   1.6
     */
	protected function getListQuery()
	{
        $query = parent::getListQuery()->joinStadium()->with(["rosters", "stadium"]);

        // Where
        $stadium = $this->getState('filter.stadium');
        $roster = $this->getState('filter.roster');
        $state = $this->getState('filter.state', -1);
        $state = ($state =="") ? -1 : $state;
        $period = $this->getState('period');

        if($roster) $query = $query->whereHas("rosters", function($query) use($roster) {
                        $query->where("id", "=", $roster);
                    });
        if($stadium) $query = $query->where("stadium_id", "=", $stadium);
        if($state > -1) $query = $query->where("state", "=", $state);

        switch ($period)
        {
        	case "all":
                break;

            case "passed" :
                $today = new JDate();
                $query = $query->where("date", "<", $today->format('Y-m-d G:i:s'));
                break;

            default:
                $today = new JDate();
                $query = $query->where("date", ">", $today->format('Y-m-d G:i:s'));
        }

        return $query;

	}

    protected function _getModel() {
        return new FMManager\Database\Models\Training();
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
        $form = \JForm::getInstance("addmultiple", "trainings_addmultiple", array("control" => "addmultiple"));

        return $form;
	}

}