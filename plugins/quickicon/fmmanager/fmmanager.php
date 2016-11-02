<?php

/**
 * @copyright      Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * Copyright (C) 2006 - 2015 Ryan Demmer. All rights reserved
 * @@license@@
 */
defined('_JEXEC') or die;

/**
 * JCE File Browser Quick Icon plugin
 *
 * @package		JCE
 * @subpackage	Quickicon.JCE
 * @since		2.1
 */
class plgQuickiconFmmanager extends JPlugin {

    /**
     * Constructor
     *
     * @param       object  $subject The object to observe
     * @param       array   $config  An array that holds the plugin configuration
     *
     * @since       2.5
     */
    public function __construct(& $subject, $config) {
        parent::__construct($subject, $config);

		jimport("FMManager.framework");
        $app = JFactory::getApplication();

        // only in Admin and only if the component is enabled
        if ($app->isSite() || JComponentHelper::getComponent('com_fmmanager', true)->enabled === false) {
            return;
        }

    }

    /**
     * This method is called when the Quick Icons module is constructing its set
     * of icons. You can return an array which defines a single icon and it will
     * be rendered right after the stock Quick Icons.
     *
     * @param  $context  The calling context
     *
     * @return array A list of icon definition associative arrays, consisting of the
     * 				 keys link, image, text and access.
     *
     * @since       2.5
     */
    public function onGetIcons($context) {
        if ($context != $this->params->get('context', 'mod_quickicon-fmmanager')) {
            return;
        }

		$link = "index.php?option=com_fmmanager&view=%s";
		$id = "plg_quickicon_fmmanager_%s";

        return array(
            array(
            'link' => JText::sprintf($link, "dashboard"),
            'image' => "list-view",
            'access' => array('core.manage', FM_MANAGER_COMPONENT),
            'text' => JText::_('COM_FMMANAGER_DASHBOARD_TITLE'),
            'id' => JText::sprintf($id, "dashboard"),
            'group' => 'COM_FMMANAGER'
        ),
            array(
            'link' => JText::sprintf($link, "persons"),
            'image' => "user",
            'access' => array('persons.admin', FM_MANAGER_COMPONENT),
            'text' => JText::_('COM_FMMANAGER_PERSONS_TITLE'),
            'id' => JText::sprintf($id, "persons"),
            'group' => 'COM_FMMANAGER'
        ),
            array(
            'link' => JText::sprintf($link, "rosters"),
            'image' => "users",
            'access' => array('rosters.admin', FM_MANAGER_COMPONENT),
            'text' => JText::_('COM_FMMANAGER_ROSTERS_TITLE'),
            'id' => JText::sprintf($id, "rosters"),
            'group' => 'COM_FMMANAGER'
        ),
            array(
            'link' => JText::sprintf($link, "matchdays"),
            'image' => "calendar",
            'access' => array('competitions.admin', FM_MANAGER_COMPONENT),
            'text' => JText::_('COM_FMMANAGER_MATCHDAYS_TITLE'),
            'id' => JText::sprintf($id, "matchdays"),
            'group' => 'COM_FMMANAGER'
        ),
            array(
            'link' => JText::sprintf($link, "trainings"),
            'image' => "cube",
            'access' => array('trainings.admin', FM_MANAGER_COMPONENT),
            'text' => JText::_('COM_FMMANAGER_TRAININGS_TITLE'),
            'id' => JText::sprintf($id, "trainings"),
            'group' => 'COM_FMMANAGER'
        ));
    }

}