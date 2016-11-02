<?php
/**
 * @package      FootManager
 * @subpackage   Layout
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FootManager\Layout;

defined('JPATH_PLATFORM') or die;
/**
 * This class contains common methods and properties for a database item
 *
 * @package      FootManager
 * @subpackage   Layout
 */
class File extends \JLayoutFile
{
	/**
     * Method to instantiate the file-based layout.
     *
     * @param   string  $layoutId  Dot separated path to the layout file, relative to base path
     * @param   string  $basePath  Base path to use when loading layout files
     * @param   mixed   $options   Optional custom options to load. Registry or array format [@since 3.2]
     *
     * @since   3.0
     */
	public function __construct($layoutId, $basePath = null, $options = null)
	{
		parent::__construct($layoutId, $basePath, $options);
	}

    /**
     * Get the default array of include paths
     *
     * @return  array
     *
     * @since   3.5
     */
	public function getDefaultIncludePaths()
	{
		// Reset includePaths
		$paths = array();

		// (1 - highest priority) Received a custom high priority path
		if (!is_null($this->basePath))
		{
			$paths[] = rtrim($this->basePath, DIRECTORY_SEPARATOR);
		}

		// Component layouts & overrides if exist
		$component = $this->options->get('component', null);

		if (!empty($component))
		{
			// (2) Component template overrides path
			$paths[] = JPATH_THEMES . '/' . \JFactory::getApplication()->getTemplate() . '/html/layouts/' . $component;

			// (3) Component path
			if ($this->options->get('client') == 0)
			{
				$paths[] = JPATH_SITE . '/components/' . $component . '/layouts';
                $paths[] = JPATH_ADMINISTRATOR . '/components/' . $component . '/layouts';
			}
			else
			{
				$paths[] = JPATH_ADMINISTRATOR . '/components/' . $component . '/layouts';
                $paths[] = JPATH_SITE . '/components/' . $component . '/layouts';
			}

		}

		// (4) Standard Joomla! layouts overriden
		$paths[] = JPATH_THEMES . '/' . \JFactory::getApplication()->getTemplate() . '/html/layouts';

        // (5) FootManager base layouts
		$paths[] = FM_PATH_LIBRARY . '/layouts';

		// (6 - lower priority) Frontend base layouts
		$paths[] = JPATH_ROOT . '/layouts';

		return $paths;
	}

}