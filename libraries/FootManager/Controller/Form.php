<?php
/**
 * @package      FootManager
 * @subpackage   Controllers
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FootManager\Controller;

use Joomla\Utilities\ArrayHelper;

defined('JPATH_PLATFORM') or die;

/**
 * This class contains common methods and properties
 * used in work with forms.
 *
 * @package      FootManager
 * @subpackage   Controllers
 */
class Form extends \JControllerForm
{
    /**
     * A default link to the extension
     * @var string
     */
    protected $defaultLink = '';

    public function __construct($config)
    {
        parent::__construct($config);
        $this->defaultLink = 'index.php?option=' . \JString::strtolower($this->option);
    }

    /**
     * Method to get a model object, loading it if required.
     *
     * @param   string  $name    The model name. Optional.
     * @param   string  $prefix  The class prefix. Optional.
     * @param   array   $config  Configuration array for model. Optional.
     *
     * @return  object  The model.
     *
     * @since   12.2
     */
    public function getModel($name = '', $prefix = '', $config = array('ignore_request' => true)) {
        if($name =='') $name = ucfirst($this->view_item);
        if($prefix == '') $prefix = ucfirst($this->getName())."Model";
        $model = parent::getModel($name, $prefix, $config);
        return $model;
    }

	/**
     * Method to run batch operations.
     *
     * @param   object  $model  The model.
     *
     * @return  boolean   True if successful, false otherwise and internal error is set.
     *
     * @since   1.6
     */
	public function batch($model = null)
	{
		\JSession::checkToken() or jexit(\JText::_('JINVALID_TOKEN'));

		// Set the model
		$model = $this->getModel();

		// Preset the redirect
        $this->setRedirectUrl();

		return parent::batch($model);
	}

    /**
     * Method to cancel an edit.
     *
     * @param   string  $key  The name of the primary key of the URL variable.
     *
     * @return  boolean  True if access level checks pass, false otherwise.
     *
     * @since   12.2
     */
	public function cancel($key = null)
	{
        if(parent::cancel($key)) {

            $return = $this->getReturnPage();

            if(!empty($return))
                $this->setRedirect($return);

            return true;
        }

        return false;
    }

    /**
     * Method to edit an existing record.
     *
     * @param   string  $key     The name of the primary key of the URL variable.
     * @param   string  $urlVar  The name of the URL variable if different from the primary key
     * (sometimes required to avoid router collisions).
     *
     * @return  boolean  True if access level check and checkout passes, false otherwise.
     *
     * @since   12.2
     */
	public function edit($key = null, $urlVar = null)
	{
        if(!parent::edit($key, $urlVar)) {

            $return = $this->getReturnPage();

            if(!empty($return))
                $this->setRedirect($return);

            return false;
        }

        return true;
    }

    /**
     * Method to save a record.
     *
     * @param   string  $key     The name of the primary key of the URL variable.
     * @param   string  $urlVar  The name of the URL variable if different from the primary key (sometimes required to avoid router collisions).
     *
     * @return  boolean  True if successful, false otherwise.
     *
     * @since   12.2
     */
	public function save($key = null, $urlVar = null)
	{
        if(parent::save($key, $urlVar)) {
            $task = $this->getTask();

            if($task == "save") {
                $return = $this->getReturnPage();

                if(!empty($return))
                    $this->setRedirect($return);
            }

            return true;
        }

        return false;
    }

    /**
     * Display a notice and redirect to a page.
     *
     * @param mixed  $messages Could be array or string.
     * @param array $options
     *
     * $options = array(
     *     "view"    => $view,
     *     "layout"  => $layout,
     *     "id"      => $itemId,
     *     "url_var" => $urlVar
     * );
     */
    protected function setMessageNotice($messages)
    {
        $this->setMessage($messages, 'notice');
    }

    /**
     * Display a warning and redirect to a page.
     *
     * @param mixed  $messages Could be array or string.
     * @param string $options
     *
     * $options = array(
     *     "view"    => $view,
     *     "layout"  => $layout,
     *     "id"      => $itemId,
     *     "url_var" => $urlVar
     * );
     */
    protected function setMessageWarning($messages)
    {
        $this->setMessage($messages, 'warning');
    }

    /**
     * Display a error and redirect to a page.
     *
     * @param mixed  $messages Could be array or string.
     * @param array $options
     *
     * $options = array(
     *     "view"    => $view,
     *     "layout"  => $layout,
     *     "id"      => $itemId,
     *     "url_var" => $urlVar
     * );
     */
    public function setMessageError($messages)
    {
        $this->setMessage($messages, 'error');
    }

    /**
     * Display a message and redirect to a page.
     *
     * @param mixed  $messages Could be array or string.
     * @param array $options
     *
     * $options = array(
     *     "view"    => $view,
     *     "layout"  => $layout,
     *     "id"      => $itemId,
     *     "url_var" => $urlVar
     * );
     */
    public function setMessage($messages, $type = "message")
    {
        $message = \FootManager\Utilities\MessageHelper::prepareMessage($messages);
        parent::setMessage($message, $type);
    }

    /**
     * Redirect the user on the default link with specified options.
     * @param array $options
     */
    protected function setRedirectUrl($options = array(), $message = "") {
        $link = $this->prepareRedirectLink($options);
        $this->setRedirect(\JRoute::_($link, false), $message);
    }

    /**
     * This method prepare a link where the user will be redirected, when his action be done.
     *
     * @param array $options URL parameters used for generating redirect link.
     *
     * @return string
     */
    protected function prepareRedirectLink($options = array())
    {
        // Return predefined link
        $forceDirection = ArrayHelper::getValue($options, 'force_direction');
        if (null !== $forceDirection) {
            return $forceDirection;
        }
        $link = $this->defaultLink;

        $view   = ArrayHelper::getValue($options, 'view', $this->view_list);
        $layout = ArrayHelper::getValue($options, 'layout');
        $itemId = ArrayHelper::getValue($options, 'id', 0, 'uint');
        $urlVar = ArrayHelper::getValue($options, 'url_var', 'id');

        // Remove standard parameters
        unset($options['view'], $options['layout'], $options['url_var'], $options['id']);

        // Redirect to different of common views
        if (null !== $view) {
            $link .= '&view=' . $view;
        }
        if (null !== $layout) {
            $link .= '&layout=' . $layout;
        }

        if ($itemId > 0) {
            $link .= $this->getRedirectToItemAppend($itemId, $urlVar);
        } else {
            $link .= $this->getRedirectToListAppend();
        }

        // Generate additional parameters
        $extraParams = \FootManager\Utilities\UrlHelper::prepareParameters($options);

        return $link.(($extraParams) ? "&". $extraParams : "");
    }

    /**
     * Gets the URL of the previous page.
     */
    protected function getReturnPage() {
        $return = $this->input->get("return_page", null, 'base64');

        if(!empty($return)) {
            return base64_decode($return);
        }

        return "";
    }

    /**
     * Gets the URL arguments to append to an item redirect.
     *
     * @param   integer  $recordId  The primary key id for the item.
     * @param   string   $urlVar    The name of the URL variable for the id.
     *
     * @return  string  The arguments to append to the redirect URL.
     *
     * @since   12.2
     */
    protected function getRedirectToItemAppend($recordId = null, $urlVar = 'id') {
        $append = parent::getRedirectToItemAppend($recordId, $urlVar);

        $return = $this->getReturnPage();

        if(!empty($return)) {
            $append .= "&return_page=".base64_encode($return);
        }

		return $append;
    }

    /**
     * Function that allows child controller access to model data after the data has been saved.
     *
     * @param   \JModelLegacy  $model      The data model object.
     * @param   array         $validData  The validated data.
     *
     * @return	void
     *
     * @since	3.1
     */
	protected function postSaveHook(\JModelLegacy $model, $validData = array())
	{
		return;
	}
}