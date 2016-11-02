<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Content.Contact
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\Registry\Registry;
jimport("FootManager.library");

/**
 * Contact Plugin
 *
 * @since  3.2
 */
class PlgFmeventsMatches extends JPlugin
{
    /**
     * Displays the voting area if in an article
     *
     * @param   string   $context  The context of the content being passed to the plugin
     * @param   object   &$row     The article object
     * @param   object   &$params  The article params
     * @param   integer  $page     The 'page' number
     *
     * @return  mixed  html string containing code for the votes if in com_content else boolean false
     *
     * @since   1.6
     */
	public function onContentPrepare($context, &$item, &$params)
	{
        if(FootManager\Helpers\Application::enabled('com_fmmanager') && FootManager\Helpers\Application::enabled('com_fmevents')) {
            jimport('FMManager.framework');
            jimport('FMEvents.framework');
        }

        return true;
    }

    /**
     * Determine areas searchable by this plugin.
     *
     * @return  array  An array of search areas.
     *
     * @since   1.6
     */
	public function onGetType()
	{
        jimport('FMManager.library');
		return [ FM_MANAGER_COMPONENT.'.matches' => ["title" => 'COM_FMMANAGER_FIELD_MATCHES', "icon" => "trophy"]];
	}

    /**
     * Determine areas searchable by this plugin.
     *
     * @return  array  An array of search areas.
     *
     * @since   1.6
     */
	public function onGetCategories($types)
	{
        if(!FootManager\Helpers\Application::enabled('com_fmmanager') || !FootManager\Helpers\Application::enabled('com_fmevents')) {
            return array();
        }

        jimport('FMManager.library');
        $result = array();
        if(empty($types) || in_array(FM_MANAGER_COMPONENT.".matches", $types) || in_array("all", $types)) {
            $teams = FMManager\Database\Models\Team::where("club_id", "=", FMManager\Helper::getMyClubId())->orderByCategory()->get();

            foreach ($teams as $team)
                $result[FM_MANAGER_COMPONENT.".".$team->id] = array("title" => $team->category_name, "color" => $team->category->color);
        }

		return $result;
	}

    /**
     * Plugin that retrieves contact information for contact
     *
     * @param   string   $context  The context of the content being passed to the plugin.
     * @param   mixed    &$row     An object with a "text" property
     * @param   mixed    $params   Additional parameters. See {@see PlgContentContent()}.
     * @param   integer  $page     Optional page number. Unused. Defaults to zero.
     *
     * @return  int	True on success.
     */
	public function onGetCount($start, $end, $types, $categories)
	{
        $query = $this->getQuery($start, $end, $types, $categories);
        return !empty($query) ? $query->count() : 0;
    }

    /**
     * Plugin that retrieves contact information for contact
     *
     * @param   string   $context  The context of the content being passed to the plugin.
     * @param   mixed    &$row     An object with a "text" property
     * @param   mixed    $params   Additional parameters. See {@see PlgContentContent()}.
     * @param   integer  $page     Optional page number. Unused. Defaults to zero.
     *
     * @return  int	True on success.
     */
	public function onGetEvents($start_date, $end_date, $types, $categories, $start = 0, $limit = 0)
	{
        $query = $this->getQuery($start_date, $end_date, $types, $categories);

        if($query) {
            $query = $query->with(["team1.club", "team2.club", "matchday.competition.tournament", "stadium"])
                        ->orderBy("fm_matches.date")
                        ->orderBy("fm_matches.time");
            if($start) $query = $query->offset($start);
            if($limit) $query = $query->take($limit);

            return $query->get()->map(function($obj) { return $obj->toCalendar(); });
        }

        return array();
    }

	/**
     * Summary of getQuery
     * @param mixed $types
     * @param mixed $categories
     * @return mixed
     */
	protected function getQuery($start, $end, $types, $categories)
	{
        if(!FootManager\Helpers\Application::enabled('com_fmmanager') || !FootManager\Helpers\Application::enabled('com_fmevents')) {
            return null;
        }

        jimport('FMManager.library');
        if(in_array("all", $types) || in_array(FM_MANAGER_COMPONENT.'.matches', $types)) {

            if(!in_array("all", $categories)) {
                $teams = array_filter($categories, function ($obj) {
                   $component = explode(".", $obj, 2)[0];
                    return $component == FM_MANAGER_COMPONENT;
                });
            } else {
                $teams = array_keys($this->onGetCategories($types));
            }

            $teams = array_map(function ($obj) {
                $id = explode(".", $obj, 2)[1];
                return $id;
            }, $teams);

            if($teams) {
                return FMManager\Database\Models\Match::withoutGlobalScopes()
                        ->byMatch(1)
                        ->betweenDates($start, $end)
                        ->where(function($query) use($teams) {
                            $query->whereIn("team1_id", $teams);
                            $query->orWhereIn("team2_id",$teams);
                        });
            }
        }
        return null;
    }

}