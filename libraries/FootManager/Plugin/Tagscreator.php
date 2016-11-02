<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Content.Contact
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace FootManager\Plugin;

defined('_JEXEC') or die;

use Joomla\Registry\Registry;
jimport("FootManager.library");

/**
 * Contact Plugin
 *
 * @since  3.2
 */
abstract class Tagscreator extends \JPlugin
{

    protected abstract function getTitle($context, $table, $isNew);

	/**
     * Plugin that retrieves contact information for contact
     *
     * @param   string   $context  The context of the content being passed to the plugin.
     * @param   mixed    &$row     An object with a "text" property
     * @param   mixed    $params   Additional parameters. See {@see PlgContentContent()}.
     * @param   integer  $page     Optional page number. Unused. Defaults to zero.
     *
     * @return  boolean	True on success.
     */
	public function onContentAfterSave($context, $table, $isNew)
	{

        if(!\FootManager\Helpers\Application::enabled("com_tags")) return false;

        $title = $this->getTitle($context, $table, $isNew);

        if($title) {
            $tag = array();

            $tag["note"] = $context.".".$table->id;
            $tag["published"] = $this->params->get('autopublish', 0);
            $tag["access"] = 1;
            $tag["parent_id"] = 1;
            $tag["title"] = $title;
            $tag["language"] = "*";
            $tag["params"] = '{"tag_layout":"","tag_link_class":"label label-info"}';
            $tag["metadata"] = '{"author":"","robots":""}';
            $alias = \JApplication::stringURLSafe($title);

            if (isset($tag['images']) && is_array($tag['images']))
            {
                $registry = new Registry;
                $registry->loadArray($tag['images']);
                $tag['images'] = (string) $registry;
            }

            if (isset($tag['urls']) && is_array($tag['urls']))
            {
                $registry = new Registry;
                $registry->loadArray($tag['urls']);
                $tag['urls'] = (string) $registry;
            }

            \JTable::addIncludePath(JPATH_ROOT . '/administrator/components/com_tags/tables');

            // Alter the title & alias
            $tableAlias = \JTable::getInstance("Tag", "TagsTable");

            while ($tableAlias->load(array('alias' => $alias)))
            {
                $alias = \JString::increment($alias, 'dash');
            }
            $tag["alias"] = $alias;

            $table      = \JTable::getInstance("Tag", "TagsTable");

            $table->load(array('note' => $tag["note"]));

            // Bind the data.
            if (!$table->bind($tag))
                return false;

            if (!$table->check())
                return false;

            // Store the data.
            if (!$table->store())
                return false;

            // Rebuild the path for the tag:
            if (!$table->rebuildPath($table->id))
                return false;

            // Rebuild the paths of the tag's children:
            if (!$table->rebuild($table->id, $table->lft, $table->level, $table->path))
                return false;
        }

        return true;

	}

}