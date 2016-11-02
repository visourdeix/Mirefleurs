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

abstract class Items extends Admin
{
    /**
     * Items.
     * @var mixed
     */
    protected $items;

	/**
     * Pagination.
     * @var mixed
     */
	protected $pagination;

    /**
     * Summary of $order_field
     * @var mixed
     */
    protected $order_field;

    /**
     * Summary of $order_field
     * @var mixed
     */
    protected $order_direction;

    /**
     * Summary of $sidebar
     * @var mixed
     */
	protected $sidebar;

    protected function init() {

        if(parent::init()) {

            $this->items		= $this->get('Items');
            $this->pagination	= $this->get('Pagination');
            $this->activeFilters = $this->get('ActiveFilters');
            $this->filterForm = $this->get('FilterForm');
            $this->batchForm = $this->getBatchForm();

            $this->order_field	=$this->escape($this->state->get('list.ordering', ''));
            $this->order_direction	= $this->escape($this->state->get('list.direction', ''));

            $this->_insertPath('template', FM_PATH_LIBRARY . '/View/html/items');

            if ($this->getLayout() !== 'modal') {
                $this->sidebar = \JHtmlSidebar::render();
            }

            return true;
        }

        return false;
    }

    /**
     * Add the "Add" Button.
     */
    protected function addAddButton() {
        if (!empty($this->getEditView()))
			\JToolbarHelper::addNew($this->getEditView().'.add');
    }

    /**
     * Add the "Edit" Button.
     */
    protected function addEditButton() {
        if (!empty($this->getEditView()))
			\JToolbarHelper::editList($this->getEditView().'.edit');
    }

    /**
     * Add the "Delete" Button.
     */
    protected function addDeleteButton() {
        \JToolbarHelper::deleteList(\JText::_('FMLIB_MESSAGE_CONFIRMATION_DELETE'), $this->getName().'.delete');
    }

    /**
     * Add the "Delete" Button.
     */
    protected function addBatchButton() {
        // Add a batch button
        \JHtml::_('bootstrap.modal', 'collapseModal');
        $title = \JText::_('JTOOLBAR_BATCH');

        // Instantiate a new JLayoutFile instance and render the batch button
        $layout = new \JLayoutFile('joomla.toolbar.batch');

        $dhtml = $layout->render(array('title' => $title));
        \JToolBar::getInstance('toolbar')->appendButton('Custom', $dhtml, 'batch');

    }

    /**
     * Add the toolbar buttons.
     */
    protected function addToolbarButtons() {
        if ($this->canAdd())
            $this->addAddButton();

        if ($this->canEdit())
            $this->addEditButton();

        if ($this->canDelete())
            $this->addDeleteButton();

        if ($this->canEdit() && !empty($this->batchForm))
            $this->addBatchButton();

        // Parameters
        if ($this->actions->get('core.admin') && !empty($this->component)) {
            \JToolBarHelper::preferences($this->component);
        }
    }

    /**
     * Get the edit view name.
     */
    protected function getEditView() {
        return \FootManager\Utilities\StringHelper::singularize($this->getName());
    }

    protected function canAdd() {
        return true;
    }

    protected function canEdit($id = null, $i = 0) {
        return true;
    }

    protected function canDelete() {
        return true;
    }

    protected function canOrdering() {
        if(count($this->items)) {
            $item = $this->items->first();
            return isset($item->ordering);
        }

        return false;
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
	protected function getBatchForm()
	{
        try
        {
            $form = \JForm::getInstance("batch", "batch_".$this->getName(), array("control" => "batch"));
        }
        catch (\Exception $exception)
        {
            $form = null;
        }
		return $form;
	}

    protected abstract function getFields();

    protected function formatValue($key, $item, $i) {
        return (isset($item) && isset($item->$key) && is_string($item->$key)) ? $item->$key : "";
    }

    protected function getClassRow($item, $i) {
        return "";
    }
}