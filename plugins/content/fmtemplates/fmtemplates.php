<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Editors-xtd.pagebreak
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Editor Pagebreak buton
 *
 * @since  1.5
 */
class PlgContentFmTemplates extends JPlugin
{

	/**
     * Display the button
     *
     * @param   string  $name  The name of the button to add
     *
     * @return array A two element array of (imageName, textToInsert)
     */
	public function onContentPrepareForm($form, $data)
	{

        // Check we are manipulating a valid form.
		$name = $form->getName();
        jimport("FootManager.library");

		if (!FootManager\Helpers\Application::enabled("com_fmcontenttemplates") || !in_array($name, array('com_content.article'))) return true;

        \FootManager\UI\Loader::addScript("com_fmcontenttemplates/backend.min.js");
        JFactory::getLanguage()->load("com_fmcontenttemplates");

        $buttons = $this->getButtons();

        if($buttons) {

            foreach ($buttons as $button)
            {
                if($button->modal) {
                    FootManager\UI\Html\Dropdown::addLink("index.php?option=com_fmcontenttemplates&view=form&layout=modal&tmpl=component&template=".$button->name, JText::_($button->title), $button->icon, array("class" => "modal", "rel" => '{handler: \'iframe\', size: {x:800, y:450}, id: \'iframe\'}'));
                } else {
                    FootManager\UI\Html\Dropdown::addLink("#", JText::_($button->title), $button->icon, array("onclick" => "FmContentTemplates.loadTemplate('".$button->name."');return false;"));
                }
            }

            FootManager\UI\Html\Toolbar::dropdownbutton(JText::_("COM_FMCONTENTTEMPLATES_BUTTON_TEMPLATES")."&nbsp;", "fm-button-templates btn-primary");
        }
    }

    /**
     * Plugin that loads module positions within content
     *
     * @param   string   $context   The context of the content being passed to the plugin.
     * @param   object   &$article  The article object.  Note $article->text is also available
     * @param   mixed    &$params   The article params
     * @param   integer  $page      The 'page' number
     *
     * @return  mixed   true if there is an error. Void otherwise.
     *
     * @since   1.6
     */
	public function onContentPrepare($context, &$article, &$params, $page = 0)
	{
        $allowed_contexts = array('com_content.category', 'com_content.article', 'com_content.featured');

		if (!in_array($context, $allowed_contexts)) return true;

        jimport("FootManager.framework");
    }

    private function getButtons() {
        return FootManager\Helpers\Plugin::trigger("fmcontenttemplates", 'onGetButton');
    }
}