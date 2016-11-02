<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Script file of HelloWorld component
 */
class com_fmgalleryInstallerScript
{
	/**
     * method to install the component
     *
     * @return void
     */
	function install($parent)
	{
		// $parent is the class calling this method
		$parent->getParent()->setRedirectURL('index.php?option=com_fmgallery');
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
            jimport('FootManager.library');

            // Check if the library is installed
            if (!defined('FM_LIBRARY')) {
                JLog::add('This extension requires the FootManager Library to be installed!', JLog::WARNING, 'jerror');
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
		if (strtolower($type) != 'uninstall') {
            jimport('joomla.filesystem.folder');
            jimport('joomla.filesystem.file');

            //change this to the name of the folder you want to create
            $folder = JPATH_ROOT . '/administrator/components/com_fmgallery/images/'.strtolower($type);

            if(strtolower($type) == 'update') {
                $folder .= "/".$parent->get('manifest')->version;
            }

            if(\JFolder::exists($folder)) {
                $folders = \JFolder::folders($folder);

                foreach ($folders as $f)
                {
                    $folder_path = $folder."/".$f;
                    if(\JFolder::exists($folder_path)) {
                        \JFolder::copy($folder_path, JPATH_ROOT."/images/".$f, "", true);
                    }
                }
                //\JFolder::delete($folder);
            }
		}
	}
}