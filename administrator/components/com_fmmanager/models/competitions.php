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
class FmmanagerModelCompetitions extends FootManager\Model\Items
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
                'types',
                'categories',
                'tournament',
                'season',
                'fm_seasons.ordering',
                'id'
			);

		}
        $this->default_search = ["fm_tournaments.name", "fm_seasons.label", "fm_categories.label"];

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
        parent::populateState("fm_seasons.ordering", "ASC");
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
		$id .= ':' . $this->getState('filter.search');
        $id .= ':' . implode(",", (array)$this->getState('filter.categories'));
        $id .= ':' . implode(",", (array)$this->getState('filter.types'));
        $id .= ':' . $this->getState('filter.season');
        $id .= ':' . $this->getState('filter.tournament');

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
                    ->joinTournamentType()
                    ->joinCategory()
                    ->joinSeason()
                    ->with(["matchdays", "competitionTeams", "tournament.category", "season"]);

        // Where
        $categories = (array)$this->getState('filter.categories');
        $types = (array)$this->getState('filter.types');
        $season = $this->getState('filter.season');
        $tournament = $this->getState('filter.tournament');

        if($categories) $query = $query->whereIn("fm_tournaments.category_id", $categories);
        if($types) $query = $query->whereIn("fm_tournaments.type_id", $types);
        if($season) $query = $query->where("season_id", "=", $season);
        if($tournament) $query = $query->where("tournament_id", "=", $tournament);

        // Order
        $orderCol = $this->state->get('list.ordering', '');

        switch ($orderCol)
        {
            case "fm_seasons.ordering" :
                $query = $this->_addSort($query, "fm_categories.ordering");
                $query = $this->_addSort($query, "fm_tournament_types.ordering");
                break;
        }

        return $query;

	}

    protected function _getModel() {
        return new FMManager\Database\Models\Competition();
    }

}