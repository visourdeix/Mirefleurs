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

use Joomla\Registry\Registry;

abstract class Item extends View
{
    /**
     * Item.
     * @var mixed
     */
    protected $item;

    /**
     * Summary of $menu
     * @var object
     */
    protected $menu;

    /**
     * Item.
     * @var mixed
     */
    protected $plugins;

    protected $print;

    protected $params;

    protected $pageclass_sfx;

    protected function init() {

        if(parent::init()) {

            $app        = \JFactory::getApplication();
            $this->menu = $app->getMenu()->getActive();

            $this->item  = $this->get('Item');
            $this->print = $app->input->getBool('print', false);
            $this->params = $this->state->get('params');
            $this->pageclass_sfx = htmlspecialchars($this->params->get('pageclass_sfx'));

            // $item->params are the item params, $temp are the menu item params
            if(isset($this->item->params)) {

                // Merge so that the menu item params take priority
                if($this->isActiveMenu()) {
                    $temp         = clone $this->item->params;
                    $temp->merge($this->params);
                    $this->params = $temp;
                } else {
                    $this->params         = $this->item->params;
                }

            }

            return true;
        }

        return false;
    }

    /**
     * Display the view
     *
     */
    public function display($tpl = null)
    {
        if($this->init()) {

            $item            = $this->item;
            $params            = $this->params;

            // Check for errors.
            if (count($errors = $this->get('Errors')))
            {
                \JError::raiseError(500, implode("\n", $errors));
                return false;
            }

            if (!$this->canView())
                return \JError::raiseWarning(404, \JText::_('JERROR_ALERTNOAUTHOR'));

            // Process the content plugins.

            \JPluginHelper::importPlugin(str_replace("com_", "", $this->component));
            $dispatcher = \JEventDispatcher::getInstance();
            $dispatcher->trigger('onContentPrepare', array ($this->component.".".$this->getName(), &$item, &$params));

            $this->plugins = new \stdClass;
            $results = $dispatcher->trigger(' onContentAfterTitle', array ($this->component.".".$this->getName(), &$item, &$params));
            $this->plugins->afterDisplayTitle = trim(implode("\n", $results));

            $results = $dispatcher->trigger('onContentBeforeDisplay', array ($this->component.".".$this->getName(), &$item, &$params));
            $this->plugins->beforeDisplayContent = trim(implode("\n", $results));

            $results = $dispatcher->trigger('onContentAfterDisplay', array ($this->component.".".$this->getName(), &$item, &$params));
            $this->plugins->afterDisplayContent = trim(implode("\n", $results));

            $this->prepare();

            $this->loadScripts();

            try
            {
                $result = $this->loadTemplate($tpl);
            }
            catch (\Exception $exception)
            {
                //Start capturing output into a buffer
                ob_start();

                // Include the requested template filename in the local scope
                // (this will execute the view logic).
                include FM_PATH_LIBRARY.'/View/html/item/default.php';

                // Done with the requested template; get the buffer and
                // clear it.
                $result = ob_get_contents();
                ob_end_clean();
            }

            echo $result;

        }

        return false;
    }

    protected function displayHeader() {

        try
        {
            $result = $this->loadTemplate('header');
        }
        catch (\Exception $exception)
        {
            //Start capturing output into a buffer
            ob_start();

            // Include the requested template filename in the local scope
            // (this will execute the view logic).
            include FM_PATH_LIBRARY.'/View/html/item/default_header.php';

            // Done with the requested template; get the buffer and
            // clear it.
            $result = ob_get_contents();
            ob_end_clean();
        }

        echo $result;
    }

    protected function displayBody() {

        try
        {
            $result = $this->loadTemplate('body');
        }
        catch (\Exception $exception)
        {
            //Start capturing output into a buffer
            ob_start();

            // Include the requested template filename in the local scope
            // (this will execute the view logic).
            include FM_PATH_LIBRARY.'/View/html/item/default_body.php';

            // Done with the requested template; get the buffer and
            // clear it.
            $result = ob_get_contents();
            ob_end_clean();
        }

        echo $result;
    }

    protected function prepare() {
        $this->_prepareDocument();
        return true;
    }

    private function _prepareDocument() {
        $app     = \JFactory::getApplication();
        $pathway = $app->getPathway();
        $config = \JFactory::getConfig();

        $title   = $this->getTitle();
        $pageTitle   = $this->getPageTitle();
        $description = $this->getDescription();
        $keywords = $this->getKeywords();
        $robots = $this->getRobots();
        $autor = $this->getAuthor();
        $metadata = $this->getMetadata();
        $path = $this->getPathway();

        // Title
        $this->params->def('page_heading', $title);

        // Page Title
		if (empty($pageTitle))
		{
			$pageTitle = $app->get('sitename');
		}
		elseif ($app->get('sitename_pagetitles', 0) == 1)
		{
			$pageTitle = \JText::sprintf('JPAGETITLE', $app->get('sitename'), $pageTitle);
		}
		elseif ($app->get('sitename_pagetitles', 0) == 2)
		{
			$pageTitle = \JText::sprintf('JPAGETITLE', $pageTitle, $app->get('sitename'));
		}
		$this->document->setTitle($pageTitle);

        // Pathway
        if (!$this->isActiveMenu())
		{
            foreach ($path as $item)
            {
                $pathway->addItem($item['title'], $item['link']);
            }
            $pathway->addItem($this->getPathwayTitle());
        }

        // Metadesc
        if ($description)
		{
			$this->document->setDescription($description);
		}
		elseif ($this->params->get('menu-meta_description'))
		{
			$this->document->setDescription($this->params->get('menu-meta_description'));
		} else {
            $this->document->setDescription($config->get('MetaDesc'));
        }

        // Metakey
        $metakeys = array_merge($keywords,array($this->params->get('menu-meta_keywords'), $config->get('MetaKeys')));
        $this->document->setMetadata('keywords', implode(",",(array)$metakeys));

        // Robots
		if ($robots)
		{
			$this->document->setMetadata('robots', $robots);
		}
        elseif ($this->params->get('robots'))
		{
			$this->document->setMetadata('robots', $this->params->get('robots'));
		} else {
            $this->document->setMetadata('robots', $config->get('robots'));
        }

        // MetaAuthor
		if ($app->get('MetaAuthor') == '1' && $autor)
		{
			$this->document->setMetaData('author', $autor);
		} elseif($app->get('MetaAuthor') == '1') {
            $this->document->setMetaData('author',  $config->get('sitename'));
        }

        // Metadata
		foreach ($metadata as $k => $v)
		{
			if ($v)
			{
				$this->document->setMetadata($k, $v);
			}
		}

		if ($this->print)
		{
			$this->document->setMetaData('robots', 'noindex, nofollow');
		}

        // Open Graph
        \FootManager\Social\OpenGraph::addTitleTag($title);
        \FootManager\Social\OpenGraph::addImageTag($this->getImage());
        \FootManager\Social\OpenGraph::addOgTag("description", $description);
    }

    protected function getTitle() {
		if ($this->isActiveMenu())
		{
            $title = $this->params->get('page_title', $this->menu->title);
		}
		else
		{
            $title = $this->getItemTitle();
		}

        return $title;
    }

    protected abstract function getItemTitle();

    protected function getItemPageTitle() {
        return $this->getItemTitle();
    }

    protected function getPathwayTitle() {
        return $this->getTitle();
    }

    protected function getPageTitle() {
        if ($this->isActiveMenu())
		{
            $title = $this->params->get('page_title', $this->menu->title);
		}
		else
		{
            $title = $this->getItemPageTitle();
		}

        return $title;
    }

    protected function getDescription() {
        return "";
    }

    protected function getImage() {
        return "";
    }

    protected function getKeywords() {
        return array($this->getTitle());
    }

    protected function getRobots() {
        return "";
    }

    protected function getAuthor() {
        return "";
    }

    protected function getMetadata() {
        return array();
    }

    protected function getPathway() {
        $path = array();
        return $path;
    }

    protected function canView() {
        return true;
    }

    protected function isActiveMenu() {

        $menu_id = isset($this->menu->query["id"]) ? $this->menu->query["id"] : 0;
        $item_id = $this->state->get($this->getName().".id", 0);
        return !empty($this->menu) && !empty($this->menu->query['option']) && !empty($this->menu->query['view']) && $this->menu->query['option'] == $this->component && $this->menu->query['view'] == $this->getName() && $menu_id == $item_id;
    }

}