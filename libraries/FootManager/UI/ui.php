<?php
/**
 * @package      FootManager
 * @subpackage   UI
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FootManager\UI;

defined('JPATH_PLATFORM') or die;

/**
 * Footmanager UI Html Helper
 *
 * @package       FootManager
 * @subpackage    UI
 */
abstract class ui
{
    /**
     * This parameter contains an information for loaded files.
     *
     * @var   array
     */
    protected static $loaded = array();

    /**
     * Add a javascript component.
     * @param mixed $function
     * @param mixed $selector
     * @param mixed $params
     */
    public static function execute($function, $selector, $params) {
        if (isset(static::$loaded[$function][$selector])) return;

        $options = \FootManager\Utilities\HtmlHelper::getJSObject($params);
        Loader::jQuery("jQuery('" . $selector . "').".$function."(" . $options . ");");

        static::$loaded[$function][$selector] = true;

    }

    /**
     * Display javascript content.
     */
    public static function displayContent($params = array(), $callbackSuccess = "undefined") {
        if (isset(static::$loaded[__FUNCTION__])) return;

        $params = \FootManager\Utilities\HtmlHelper::getJSObject($params);
        Loader::jQuery("FM.displayContent(" . $params . ", ".$callbackSuccess.");");

        static::$loaded[__FUNCTION__] = true;
    }

    /**
     * Display javascript module content.
     */
    public static function displayModule($module, $id, $params = array(), $callbackSuccess = "undefined") {
        if (isset(self::$loaded[__FUNCTION__][$id])) return;

        $params = \FootManager\Utilities\HtmlHelper::getJSObject((array)$params);

        $app = \JFactory::getApplication();
        $Itemid = $app->input->getInt('Itemid', 0);

        Loader::jQuery("FM.displayModule('" . $module . "', '".$id."', ".$params.", '" . $Itemid . "', ".$callbackSuccess.");");

        // Set static array
        static::$loaded[__FUNCTION__][$id] = true;

    }

    /**
     * Summary of toggleVisibility
     * @param mixed $fieldSelector
     * @param mixed $valueForShow
     * @param mixed $targetSelector
     */
    public static function toggleVisibility($fieldSelector, $valueForShow, $targetSelector) {
        Loader::jQuery("FM.toggleVisibility('$fieldSelector', '$valueForShow', '$targetSelector')");
    }

    /**
     * Execute function.
     * @param mixed $selector
     * @param mixed $params
     */
    public static function datetimepicker($selector = '.fmdatetimepicker', $params = array())
	{
        Loader::datetimepicker();
		self::execute(__FUNCTION__, $selector,$params);
	}

    /**
     * Execute function.
     * @param mixed $selector
     * @param mixed $params
     */
    public static function toggle($selector = '.fmtoggle', $params = array())
	{
        Loader::toggle();
		self::execute("bootstrapToggle", $selector,$params);
	}

    /**
     * Execute function.
     * @param mixed $selector
     * @param mixed $params
     */
    public static function touchspin($selector = '.fmtouchspin', $params = array())
	{
        Loader::touchspin();
		self::execute("TouchSpin", $selector,$params);
	}

    /**
     * Execute function.
     * @param mixed $selector
     * @param mixed $params
     */
    public static function statesselect($selector = '.fmstatesselect', $params = array())
	{
        Loader::statesselect();
		self::execute(__FUNCTION__, $selector,$params);
	}

    /**
     * Execute function.
     * @param mixed $selector
     * @param mixed $params
     */
	public static function radio($selector = '.fmradio', $params = array())
	{
        Loader::radio();
        self::execute(__FUNCTION__, $selector,$params);
	}

    /**
     * Execute function.
     * @param mixed $selector
     * @param mixed $params
     */
	public static function repeater($selector = '.fmrepeater', $params = array())
	{
        Loader::repeater();
        self::execute(__FUNCTION__, $selector,$params);
	}

    /**
     * Execute function.
     * @param mixed $selector
     * @param mixed $params
     */
    public static function slick($selector = '.slick', $params = array())
	{
        Loader::slick();
        self::execute(__FUNCTION__, $selector,$params);
	}

    /**
     * Execute function.
     * @param mixed $selector
     * @param mixed $params
     */
    public static function table($selector = '.table', $params = array())
	{
        Loader::table();
        self::execute("bootstrapTable", $selector,$params);
	}

    /**
     * Execute function.
     * @param mixed $selector
     * @param mixed $params
     */
    public static function countdown($selector = '.countdown', $params = array())
	{
        Loader::countdown();
        self::execute(__FUNCTION__, $selector,$params);
	}

    /**
     * Execute function.
     * @param mixed $selector
     * @param mixed $type
     * @param mixed $data
     * @param mixed $params
     */
    public static function chart($selector = '.chart', $type, $data, $params = array())
	{
        Loader::chart();

        $params["showTooltips"] = isset($params["showTooltips"]) ? $params["showTooltips"]: false;
        $params["responsive"] = isset($params["responsive"]) ? $params["responsive"]: false;

        $options = \FootManager\Utilities\HtmlHelper::getJSObject($params);
        $data = \FootManager\Utilities\HtmlHelper::getJSObject($data);

        $script = "var ctx = jQuery('".$selector."').get(0).getContext('2d');
                   if(window.charts === undefined)
                        window.charts = [];
                   window.charts['".$selector."'] = new Chart(ctx).".ucfirst($type)."(" . $data . ", " . $options . ");";
        Loader::jQuery($script);
	}

    /**
     * Execute function.
     * @param mixed $selector
     * @param mixed $params
     */
    public static function plupload($selector = '.plupload', $params = array())
	{
        Loader::plupload();
        self::execute("pluploadQueue", $selector,$params);
	}

    /**
     * Execute function.
     * @param mixed $selector
     * @param mixed $params
     */
	public static function lazy($selector = '.lazy', $params = array())
	{
        Loader::lazy();
        self::execute(__FUNCTION__, $selector,$params);
	}

    /**
     * Execute function.
     * @param mixed $selector
     * @param mixed $params
     */
	public static function easytabs($selector = '.easytabs', $params = array())
	{
        Loader::easytabs();
        self::execute(__FUNCTION__, $selector,$params);
	}

    /**
     * Execute function.
     * @param mixed $selector
     * @param mixed $params
     */
	public static function jscroll($selector = '.jscroll', $params = array())
	{
        $params["loadingHtml"] = \JArrayHelper::getValue($params, "loadingHtml", "<div class='cssload-loader'></div>");
        Loader::jscroll();
        self::execute(__FUNCTION__, $selector,$params);
	}

    /**
     * Execute function.
     * @param mixed $selector
     * @param mixed $params
     */
	public static function masonry($selector = '.masonry', $params = array())
	{
        Loader::masonry();
        self::execute(__FUNCTION__, $selector,$params);
	}

    /**
     * Execute function.
     * @param mixed $selector
     * @param mixed $params
     */
	public static function isotope($selector = '.isotope',$layout = 'packery', $params = array())
	{
        Loader::isotope($layout);

        $params["layoutMode"] = $layout;
        self::execute(__FUNCTION__, $selector,$params);
	}

    /**
     * Execute function.
     * @param mixed $selector
     * @param mixed $params
     */
	public static function camera($selector = '.camera', $params = array())
	{
        Loader::camera();
        self::execute(__FUNCTION__, $selector,$params);
	}

    /**
     * Execute function.
     * @param mixed $selector
     * @param mixed $params
     */
	public static function iView($selector = '.camera', $params = array())
	{
        Loader::iView();
        self::execute(__FUNCTION__, $selector,$params);
	}

    /**
     * Execute function.
     * @param mixed $selector
     * @param mixed $params
     */
	public static function sortable($selector = '.sortable', $params = array())
	{
        Loader::sortable();
        self::execute(__FUNCTION__, $selector,$params);
	}

    /**
     * Execute function.
     * @param mixed $selector
     * @param mixed $params
     */
	public static function calendar($selector = '.calendar', $params = array())
	{
        Loader::calendar();
        self::execute("fullCalendar", $selector,$params);
	}

    /**
     * Execute function.
     * @param mixed $selector
     * @param mixed $params
     */
	public static function qTip($selector = '.qtip', $params = array())
	{
        Loader::qTip();
        self::execute("qtip", $selector,$params);
	}

    /**
     * Execute function.
     * @param mixed $selector
     * @param mixed $params
     */
	public static function map($selector = '.map', $params = array())
	{
        Loader::google();
        self::execute("gmap3", $selector,$params);
	}

    /**
     * Execute function.
     * @param mixed $selector
     * @param mixed $params
     */
    public static function photoswipe($selector = '.fm-images-gallery', $params = array())
	{
        Loader::photoswipe();

        $params["shareButtons"] = "\\[
            {id:'fb', label: '".\JText::sprintf("FMLIB_SHARE_ON", \JText::_("FMLIB_FACEBOOK"))."', url: 'https://www.facebook.com/sharer/sharer.php?u={{url}}'},
            {id:'tw', label:'".\JText::sprintf("FMLIB_SHARE_ON", \JText::_("FMLIB_TWITTER"))."', url:'https://twitter.com/intent/tweet?text={{text}}&url={{url}}'},
            {id:'dl', label:'".\JText::_("FMLIB_DOWNLOAD")."', url:'{{raw_image_url}}', download:true}
            ]";

        $options = \FootManager\Utilities\HtmlHelper::getJSObject($params);

        $script = "initPhotoSwipeFromDOM('$selector', $options);";
        Loader::jQuery($script);
	}
}