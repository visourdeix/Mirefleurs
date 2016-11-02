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

/**
 * This class contains common methods and properties.
 *
 * @package      FootManager
 * @subpackage   Controllers
 */
class DefaultController extends \JControllerLegacy
{
    /**
     * The URL option for the component.
     *
     * @var    string
     * @since  12.2
     */
    protected $option;

    /**
     * A default link to the extension
     * @var string
     */
    protected $defaultLink = '';

    public function __construct($config)
    {
        parent::__construct($config);

        // Guess the option as com_NameOfController
        if (null === $this->option) {
            $this->option = 'com_' . \JString::strtolower($this->getName());
        }

        $this->defaultLink = 'index.php?option=' . \JString::strtolower($this->option);
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
     * This method prepare a link where the user will be redirected
     * after action he has done.
     *
     * @param array $options URL parameters used for generating redirect link.
     *
     * @return string
     */
    protected function prepareRedirectLink($options)
    {
        $link = $this->defaultLink;

        $view   = ArrayHelper::getValue($options, 'view');
        $layout = ArrayHelper::getValue($options, 'layout');

        // Remove standard parameters
        unset($options['view'], $options['layout']);

        // Set the view value
        if (null !== $view) {
            $link .= '&view=' . $view;
        }
        if (null !== $layout) {
            $link .= '&layout=' . $layout;
        }

        // Generate additional parameters
        $extraParams = \FootManager\Utilities\UrlHelper::prepareParameters($options);

        return $link.(($extraParams) ? "&". $extraParams : "");
    }
}