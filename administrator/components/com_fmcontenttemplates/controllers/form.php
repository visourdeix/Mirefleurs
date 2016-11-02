<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * The article controller
 *
 * @package     Joomla.Administrator
 * @subpackage  com_content
 * @since       1.6
 */
class FmcontenttemplatesControllerForm extends JControllerLegacy
{
    public function ajaxEditor() {

        $input  = JFactory::getApplication()->input;
        $editor = JFactory::getConfig()->get("editor");

        $editor = new JEditor($editor);

        //echo the data
		//echo json_encode($editor->setContent($editor, "[[HTML]]"));
        echo json_encode($editor->setContent("[[EDITOR]]", "[[HTML]]"));
		exit;

    }

}