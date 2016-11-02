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

abstract class Admin extends View
{

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
        parent::__construct($config);
    }

    protected function init() {
		$this->state		= $this->get('State');
        return true;
    }

    /**
     * Prepare the page.
     * @return mixed
     */
    protected function prepare() {
        if ($this->getLayout() !== 'modal') {
            $this->addToolbar();
        }
        return parent::prepare();
    }

    /**
     * Add the page title and toolbar.
     *
     */
    protected function addToolbar()
    {
        // Title
        \JToolBarHelper::title($this->getTitle(), $this->getIcon());

        $this->addToolbarButtons();
    }

    /**
     * Add the toolbar buttons.
     */
    protected function addToolbarButtons() {}

    /**
     * Return the title.
     * @return string
     */
    protected function getTitle() {
        return \JText::_(strtoupper($this->component."_".$this->getName()."_TITLE"));
    }

    /**
     * Return the icon.
     * @return string
     */
    protected function getIcon() {
        return $this->getName().'-48.png';
    }

}