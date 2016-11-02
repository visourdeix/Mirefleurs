<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Script file of HelloWorld component
 */
class PlgContentFmtemplatesInstallerScript
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
		if (strtolower($type) == 'install' || strtolower($type) == 'update') {
            jimport('FootManager.library');

			$name = htmlspecialchars($parent->get('manifest')->name, ENT_QUOTES, 'UTF-8');

            // Check if the library is installed
            if (!defined('FM_LIBRARY')) {
                JError::raiseWarning(1, JText::_('This plugin (' . $name . ') requires the FootManager Library to be installed!'));
                return false;
            }
		}
	}

	/**
     * method to run after an install/update/uninstall method
     *
     * @return void
     */
	function postflight($type, $parent)
	{
		if (strtolower($type) == 'install') {
            // Get the XML manifest data
            $manifest = $parent->get('manifest');

            // Get plugin published state
            $name  = $manifest->name;

            FootManager\Helpers\Plugin::publish($name);
        }

        return true;
	}
}