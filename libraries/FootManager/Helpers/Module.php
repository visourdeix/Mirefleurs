<?php
/**
 * @package      FootManager
 * @subpackage   Helpers
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FootManager\Helpers;

defined('JPATH_PLATFORM') or die;
/**
 * This class contains common methods and properties for a database item
 *
 * @package      FootManager
 * @subpackage   Helpers
 */
abstract class Module
{
    public static function initialize($module, $params = array(), $ajax_loading = false, $objects = array()) {

        // Include library component
        $path_module = (\JFactory::getApplication()->isAdmin() ? 'administrator'.DS : '').'modules'.DS.$module.DS;

        // Add css module
        \FootManager\UI\Loader::addStyle($path_module.'assets/css/default.min.css', false);

        // Add js module
        \FootManager\UI\Loader::addScript($path_module.'assets/js/default.min.js', false);

        $id = \FootManager\Utilities\StringHelper::camelize($module).rand();
        if($ajax_loading) {
            $mod = str_replace("mod_", "", $module);
            $params->set("ajax_loading", true);
            \FootManager\UI\ui::displayModule($mod, $id);
        }

        // Include Helper Module.
        $helperFile = JPATH_ROOT.DS.$path_module.'helper.php';
        if(\JFile::exists($helperFile)) {
            require_once $helperFile;
            $moduleClass = \FootManager\Utilities\StringHelper::camelize($module).'Helper';
            $paramsToArray=  $params->ToArray();
            $data = $moduleClass::getData($paramsToArray);
        }

        require FM_PATH_LIBRARY.DS.'View/html/module/default.php';
    }

    public static function getModules($position)
	{
		return \JModuleHelper::getModules($position);
	}

    public static function loadposition($position, $style = 'xhtml')
	{
		$document	= \JFactory::getDocument();
		$renderer	= $document->loadRenderer('module');
		$params		= array('style'=>$style);

		$contents = '';
		foreach (self::getModules($position) as $mod)  {
			$contents .= $renderer->render($mod, $params);
		}
		return $contents;
	}

    public static function loadmodule($module, $style = 'xhtml')
	{
		$document	= \JFactory::getDocument();
		$renderer	= $document->loadRenderer('module');
		$params		= array('style'=>$style);

		return $renderer->render($module, $params);
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
	public static function getForm($module, $component, &$params)
	{

		// Get the form.
		\JForm::addFormPath(JPATH_ROOT.DS.(\JFactory::getApplication()->isAdmin() ? 'administrator'.DS : '').'modules'.DS.$module.DS.'forms');
        \JForm::addFieldPath(FM_PATH_LIBRARY . '/forms/fields');
        \JForm::addFieldPath(JPATH_ADMINISTRATOR . '/components/'.$component.'/models/fields');

        $id = "form".rand();
        $form = \JForm::getInstance($id, 'filter', array("control" => $id), false, false);

        $form->bind($params);

		return $form;

	}

    /**
     * Method to set module params such as position, publishing state and title
     *
     * @param     object     $manifest    Instance of the XML manifest
     *
     * @return    boolean                 True on success, False on error
     */
    public static function setParams(&$manifest)
    {
        $db    = \JFactory::getDbo();
        $query = $db->getQuery(true);

        // Get module name, position and published state
        $name  = $manifest->name;
        $pos   = (isset($manifest->position) ? $manifest->position : '');
        $pub   = (isset($manifest->published) ? (int) $manifest->published : 1);
        $title = (isset($manifest->show_title) ? (int) $manifest->show_title : 1);
		$access = (isset($manifest->access) ? (int) $manifest->access : 3);

        // Get the module id
        $query->select('id')
              ->from('#__modules')
              ->where('module = ' . $db->quote($name));

        $db->setQuery((string) $query);
        $id = (int) $db->loadResult();

        if (!$id) return false;

        // Update params
        $query->clear();
        $query->update('#__modules');
        if ($pos) $query->set('position = ' . $db->quote($pos));
        if ($pub) $query->set('published = ' . $db->quote($pub));
		if ($access) $query->set('access = ' . $db->quote($access));
        $query->set('showtitle = ' . $db->quote($title));
        $query->where('module = ' . $db->quote($name));

        $db->setQuery((string) $query);
        $db->execute();

        return true;
    }
}