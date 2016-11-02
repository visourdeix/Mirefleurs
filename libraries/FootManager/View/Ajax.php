<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace FootManager\View;

defined('_JEXEC') or die;

use Joomla\Registry\Registry;

/**
 * HTML Article View class for the Content component
 *
 * @since  1.5
 */
abstract class Ajax extends Item
{

    protected function init() {

        if(parent::init()) {
            $params = $this->params->toObject();
            $params->ajax_loading = true;

            $registry = new Registry;
            $this->params = $registry->loadObject($params);

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
        $this->loadAjaxContent();
        parent::display($tpl);
    }

    protected function loadAjaxContent() {
        \FootManager\UI\ui::displayContent();
    }
}