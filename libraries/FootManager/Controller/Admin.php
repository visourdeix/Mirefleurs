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
use FootManager\Utilities\StringHelper;

defined('JPATH_PLATFORM') or die;
/**
 * This class contains common methods and properties
 * used in work with admin actions.
 *
 * @package      FootManager
 * @subpackage   Controllers
 */
class Admin extends \JControllerAdmin
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
        if($name =='') $name = ucfirst(StringHelper::singularize($this->view_list));
        if($prefix == '') $prefix = ucfirst($this->getName())."Model";
        $model = parent::getModel($name, $prefix, $config);
        return $model;
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
     * This method prepare a link where the user will be redirected
     * after action he has done.
     *
     * @param array $options URL parameters used for generating redirect link.
     *
     * @return string
     */
    protected function prepareRedirectLink($options)
    {
        // Return predefined link
        $forceDirection = ArrayHelper::getValue($options, 'force_direction');
        if (null !== $forceDirection) {
            return $forceDirection;
        }

        $link = $this->defaultLink;

        $view   = ArrayHelper::getValue($options, 'view', $this->view_list);
        $layout = ArrayHelper::getValue($options, 'layout');

        // Remove standard parameters
        unset($options['view'], $options['layout']);

        // Set the view value
        if (\JString::strlen($view) > 0) {
            $link .= '&view=' . $view;
        }
        if (\JString::strlen($layout) > 0) {
            $link .= '&layout=' . $layout;
        }

        // Generate additional parameters
        $extraParams = \FootManager\Utilities\UrlHelper::prepareParameters($options);

        return $link.(($extraParams) ? "&". $extraParams : "");
    }
}