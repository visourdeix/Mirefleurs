<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Script file of HelloWorld component
 */
class mod_fmactivity_latestactivitiesInstallerScript
{
	/**
     * method to install the component
     *
     * @return void
     */
	function install($parent)
	{
	}

	/**
     * method to uninstall the component
     *
     * @return void
     */
	function uninstall($parent)
	{
	}

	/**
     * method to update the component
     *
     * @return void
     */
	function update($parent)
	{
	}

	/**
     * method to run before an install/update/uninstall method
     *
     * @return void
     */
	function preflight($type, $parent)
	{
        jimport('FootManager.library');

        $name = htmlspecialchars($parent->get('manifest')->name, ENT_QUOTES, 'UTF-8');

        // Check if the library is installed
        if (!defined('FM_LIBRARY')) {
            JError::raiseWarning(1, JText::_('This extension (' . $name . ') requires the FootManager Library to be installed!'));
            return false;
        }

        // Check if the component is installed
        if (!FootManager\Helpers\Application::exists('com_fmactivity')) {
            JError::raiseWarning(1, JText::_('This extension (' . $name . ') requires the FMActivity Component to be installed!'));
            return false;
        }

	}

	/**
     * method to run after an install/update/uninstall method
     *
     * @return void
     */
	function postflight($type, $parent)
	{
	}
}