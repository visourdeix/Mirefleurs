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
class plgQuickiconFmgallery extends JPlugin {

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

		jimport("FMGallery.framework");
        $app = JFactory::getApplication();

        // only in Admin and only if the component is enabled
        if ($app->isSite() || JComponentHelper::getComponent('com_fmgallery', true)->enabled === false) {
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
        if ($context != $this->params->get('context', 'mod_quickicon-fmgallery')) {
            return;
        }

		$link = "index.php?option=com_fmgallery&view=%s";
		$id = "plg_quickicon_fmgallery_%s";

        return array(
            array(
            'link' => JText::sprintf($link, "addphotos"),
            'image' => "plus",
            'access' => array('core.manage', FM_GALLERY_COMPONENT),
            'text' => JText::_('COM_FMGALLERY_ADDPHOTOS_TITLE'),
            'id' => JText::sprintf($id, "addphotos"),
            'group' => 'COM_FMGALLERY'
        ),
            array(
            'link' => JText::sprintf($link, "photos"),
            'image' => "pictures",
            'access' => array('core.manage', FM_GALLERY_COMPONENT),
            'text' => JText::_('COM_FMGALLERY_PHOTOS_TITLE'),
            'id' => JText::sprintf($id, "photos"),
            'group' => 'COM_FMGALLERY'
        ),
            array(
            'link' => JText::sprintf($link, "videos"),
            'image' => "video",
            'access' => array('core.manage', FM_GALLERY_COMPONENT),
            'text' => JText::_('COM_FMGALLERY_VIDEOS_TITLE'),
            'id' => JText::sprintf($id, "videos"),
            'group' => 'COM_FMGALLERY'
        ),
            array(
            'link' => JText::sprintf($link, "files"),
            'image' => "stack",
            'access' => array('core.manage', FM_GALLERY_COMPONENT),
            'text' => JText::_('COM_FMGALLERY_FILES_TITLE'),
            'id' => JText::sprintf($id, "files"),
            'group' => 'COM_FMGALLERY'
        )
		);
    }

}