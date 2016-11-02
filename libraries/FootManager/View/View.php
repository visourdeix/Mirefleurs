<?php
/**
 * @package      FootManager
 * @subpackage   LIbrary
 *
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 */

namespace FootManager\View;

defined('_JEXEC') or die();

abstract class View extends \JViewLegacy
{

    /**
     * The current user object
     *
     * @var    object
     */
    protected $user;

    /**
     * Actions allowed for the user.
     *
     * @var    object
     */
    protected $actions;

    /**
     * Summary of $component
     * @var mixed
     */
    protected $component;

    /**
     * Summary of $state
     * @var mixed
     */
	protected $state;

    /**
     * Constructor
     *
     * @param   array  $config  A named configuration array for object construction.<br />
     *                          name: the name (optional) of the view (defaults to the view class name suffix).<br />
     *                          charset: the character set to use for display<br />
     *                          escape: the name (optional) of the function to use for escaping strings<br />
     *                          base_path: the parent path (optional) of the views directory (defaults to the component folder)<br />
     *                          template_plath: the path (optional) of the layout directory (defaults to base_path + /views/ + view name<br />
     *                          helper_path: the path (optional) of the helper files (defaults to base_path + /helpers/)<br />
     *                          layout: the layout (optional) to use to display the view<br />
     *
     * @since   12.2
     */
	public function __construct($config = array())
	{
        $this->component = \JFactory::getApplication()->input->get('option');
        $this->user       = \JFactory::getUser();
        $this->actions = \FootManager\Helpers\Access::getActions($this->component);
        parent::__construct($config);
    }

    /**
     * Initialise objects.
     * @return mixed
     */
    protected function init() {
		$this->state		= $this->get('State');
        return true;
    }

    /**
     * Prepare the page.
     * @return mixed
     */
    protected function prepare() {
        return true;
    }

    /**
     * Display the view
     *
     */
    public function display($tpl = null)
    {
        if($this->init()) {

            // Check for errors.
            if (count($errors = $this->get('Errors')))
            {
                \JError::raiseError(500, implode("\n", $errors));
                return false;
            }

            $this->prepare();

            $this->loadScripts();

            return parent::display($tpl);
        }

        return false;
    }

    /**
     * Display the view
     *
     */
    protected function loadScripts()
    {
        $folder = "";
        if(\JFactory::getApplication()->isSite()) {
            $folder = "frontend";
        } else {
            $folder = "backend";
        }
        \FootManager\UI\Loader::addScript($this->component.'/'.$folder.'/'.$this->getName().'.min.js');
    }

    /**
     * Adds to the search path for templates and resources.
     *
     * @param   string  $type  The type of path to add.
     * @param   mixed   $path  The directory or stream, or an array of either, to search.
     *
     * @return  void
     *
     * @since   12.2
     */
	protected function _insertPath($type, $path)
	{
		// Just force to array
		settype($path, 'array');

		// Loop through the path directories
		foreach ($path as $dir)
		{
			jimport('joomla.filesystem.path');

			// Clean up the path
			$dir = \JPath::clean($dir);

			// Add trailing separators as needed
			if (substr($dir, -1) != DIRECTORY_SEPARATOR)
			{
				// Directory
				$dir .= DIRECTORY_SEPARATOR;
			}

			// Add to the top of the search dirs
			array_push($this->_path[$type], $dir);
		}
	}
}