<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Script file of HelloWorld component
 */
class com_fmactivityInstallerScript
{
	/**
     * method to install the component
     *
     * @return void
     */
	function install($parent)
	{
		// $parent is the class calling this method
		$parent->getParent()->setRedirectURL('index.php?option=com_fmactivity');
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
		if (strtolower($route) == 'install') {
            jimport('FMActivity.library');

            // Check if the library is installed
            if (!defined('FM_LIBRARY')) {
                JLog::add('This extension requires the FootManager Library to be installed!', JLog::WARNING, 'jerror');
                return false;
            }
			
			// Check if the library is installed
            if (!defined('FM_ACTIVITY_LIBRARY')) {
                JLog::add('This extension requires the FMActivity Library to be installed!', JLog::WARNING, 'jerror');
                return false;
            }
        }
	}

}