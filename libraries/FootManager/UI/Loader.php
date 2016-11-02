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
abstract class Loader
{
    /**
     * This parameter contains an information for loaded files.
     *
     * @var   array
     */
    protected static $loaded = array();
    protected static $base_path = "media/FootManager/ui/";

    /**
     * Include jQuery plugin is-loading
     */
    public static function scripts()
    {
        // Only load once
        if (!empty(self::$loaded[__FUNCTION__])) return;

        // Load jQuery
		\JHtml::_('jquery.framework');

        self::addScript('jui/bootstrap.min.js');
        self::addScript(FM.'/fastclick.min.js');
        self::addScript(FM.'/FootManager.min.js');

        self::$loaded[__FUNCTION__] = true;
    }

    /**
     * Include some general styles.
     */
    public static function styles()
    {
        // Only load once
        if (!empty(self::$loaded[__FUNCTION__])) return;

        //\JHtml::_('bootstrap.loadCss');
        self::addStyle(FM.'/FootManager.min.css');
        self::icons();

        self::$loaded[__FUNCTION__] = true;
    }

    /**
     * Loads Icons css.
     */
	public static function icons()
	{
        // Only load once
        if (!empty(self::$loaded[__FUNCTION__])) return;

        self::addStyle(FM.'/font-awesome.min.css');

        self::$loaded[__FUNCTION__] = true;
	}

    /**
     * Add style File.
     * @param mixed $path
     * @param mixed $relative
     */
    public static function addStyle($path, $relative = true) {
        \JHtml::stylesheet($path, array(), $relative, false, true, true);
    }

    /**
     * Add script File.
     * @param mixed $path
     * @param mixed $relative
     * @param mixed $defer
     * @param mixed $async
     */
    public static function addScript($path, $relative = true, $defer = true, $async = false) {
        self::script($path, false, $relative, false, true, true, $defer, $async);
    }

    /**
     * Load library.
     */
	protected static function loadComponent($name)
	{
        // Only load once
        if (!empty(self::$loaded[$name])) return false;

        $path = self::$base_path.$name."/".$name;

        self::addScript($path.'.min.js', false);
        self::addStyle($path.".min.css", false);

        self::$loaded[$name] = true;

        return true;
	}

    /**
     * Add a javascript treatment.
     * @param mixed $script
     */
    public static function javacript($script) {

        $sig = md5(serialize($script));

        // Only load once
        if (!empty(self::$loaded[__FUNCTION__][$sig])) return;

        \JFactory::getDocument()->addScriptDeclaration($script);

        // Set static array
        static::$loaded[__FUNCTION__][$sig] = true;

		return;
    }

    /**
     * Add a javascript treatment.
     * @param string $script
     */
    public static function jQuery($script) {

        $sig = md5(serialize($script));

        // Only load once
        if (!empty(self::$loaded[__FUNCTION__][$sig])) return;

        // Attach typehead to document
        self::javacript(
            "jQuery(document).ready(function()
				{
					".$script."
				});"
        );

        // Set static array
        static::$loaded[__FUNCTION__][$sig] = true;

    }

    /**
     * Load library.
     */
	public static function jQueryUi()
	{
        // Only load once
        if (!empty(self::$loaded[__FUNCTION__])) return;

        $base = self::$base_path."jquery-ui/";

        // Load jQuery
		\JHtml::_('jquery.framework');

        \JHtml::_('jquery.ui', array('core', 'sortable'));

        self::addScript($base.'jquery-ui.min.js', false);

        self::addStyle($base."jquery-ui.min.css", false);
        self::addStyle($base."jquery-ui.structure.min.css", false);

        self::$loaded[__FUNCTION__] = true;
	}

    /**
     * Load library.
     */
	public static function photoswipe()
	{
        // Only load once
        if (!empty(self::$loaded[__FUNCTION__])) return;

        $base = self::$base_path.__FUNCTION__."/";

        self::addScript($base.'js/photoswipe.min.js', false);
        self::addScript($base.'js/photoswipe-ui-default.min.js', false);
        self::addScript($base.'photoswipe.min.js', false);

        self::addStyle($base."css/photoswipe.min.css", false);
        self::addStyle($base."default-skin/default-skin.min.css", false);

        self::$loaded[__FUNCTION__] = true;
	}

    /**
     * Load library.
     */
	public static function plupload()
	{
        // Only load once
        if (!empty(self::$loaded[__FUNCTION__])) return;

        $base = self::$base_path.__FUNCTION__."/";

        $lang = \JFactory::getLanguage();
        $language = explode("-",$lang->getTag())[0];

        self::jQueryUi();

        self::addScript($base.'js/plupload.full.min.js', false);
        //self::addScript($base.'js/jquery.ui.plupload/jquery.ui.plupload.min.js', false);
        self::addScript($base.'js/i18n/'.$language.'.min.js', false);
        self::addScript($base.'js/jquery.plupload.queue/jquery.plupload.queue.min.js', false);

        //self::addStyle($base."js/jquery.ui.plupload/css/jquery.ui.plupload.min.css", false);
        self::addStyle($base."js/jquery.plupload.queue/css/jquery.plupload.queue.min.css", false);

        self::$loaded[__FUNCTION__] = true;
	}

    /**
     * Load library.
     */
	public static function lazy()
	{
        // Only load once
        if (!empty(self::$loaded[__FUNCTION__])) return;

        $base = self::$base_path.__FUNCTION__."/";

        self::addScript($base.'jquery.lazy.min.js', false);

        self::$loaded[__FUNCTION__] = true;
	}

    /**
     * Load library.
     */
	public static function easytabs()
	{
        // Only load once
        if (!empty(self::$loaded[__FUNCTION__])) return;

        $base = self::$base_path.__FUNCTION__."/";

        self::addScript($base.'jquery.easytabs.min.js', false);

        self::$loaded[__FUNCTION__] = true;
	}

    /**
     * Load library.
     */
	public static function jscroll()
	{
        // Only load once
        if (!empty(self::$loaded[__FUNCTION__])) return;

        $base = self::$base_path.__FUNCTION__."/";

        self::addScript($base.'jquery.jscroll.min.js', false);

        self::$loaded[__FUNCTION__] = true;
	}

    /**
     * Load library.
     */
	public static function masonry()
	{
        // Only load once
        if (!empty(self::$loaded[__FUNCTION__])) return;

        $base = self::$base_path.__FUNCTION__."/";

        self::addScript($base.'masonry.pkgd.min.js', false);
        self::addScript($base.'imagesloaded.pkgd.min.js', false);

        self::$loaded[__FUNCTION__] = true;
	}

    /**
     * Load library.
     */
	public static function isotope($layout = '')
	{
        // Only load once
        if (!empty(self::$loaded[__FUNCTION__])) return;

        $base = self::$base_path.__FUNCTION__."/";

        self::addScript($base.'isotope.pkgd.min.js', false);
        if($layout) self::addScript($base.$layout.'-mode.pkgd.min.js', false);

        self::$loaded[__FUNCTION__] = true;
	}

    /**
     * Load library.
     */
	public static function camera()
	{
        // Only load once
        if (!empty(self::$loaded[__FUNCTION__])) return;

        $base = self::$base_path.__FUNCTION__."/";

        self::addStyle($base."camera.min.css", false);
        self::addScript($base.'jquery.easing.1.3.js', false, false);
        self::addScript($base.'jquery.mobile.customized.min.js', false);
        self::addScript($base.'camera.min.js', false);

        self::$loaded[__FUNCTION__] = true;
	}

    /**
     * Load library.
     */
	public static function iView()
	{
        // Only load once
        if (!empty(self::$loaded[__FUNCTION__])) return;

        $base = self::$base_path.__FUNCTION__."/";

        self::addStyle($base."css/styles.min.css", false);
        self::addStyle($base."css/iview.min.css", false);
        self::addStyle($base."css/skin 2/style.css", false);
        self::addScript($base.'js/raphael-min.min.js', false);
        self::addScript($base.'js/jquery.easing.js', false);
        self::addScript($base.'js/iview.min.js', false);

        self::$loaded[__FUNCTION__] = true;
	}

    /**
     * Load library.
     */
	public static function qTip()
	{
        // Only load once
        if (!empty(self::$loaded[__FUNCTION__])) return;

        $base = self::$base_path.__FUNCTION__."/";

        self::addScript($base.'jquery.qtip.min.js', false);
        self::addStyle($base."jquery.qtip.min.css", false);

        self::$loaded[__FUNCTION__] = true;
	}

    /**
     * Load library.
     */
	public static function calendar()
	{
        // Only load once
        if (!empty(self::$loaded[__FUNCTION__])) return;

        $base = self::$base_path."fullcalendar/";
        $lang = \JFactory::getLanguage();
        $language = explode("-",$lang->getTag())[0];

        self::moment();
        self::addScript($base.'js/fullcalendar.min.js', false);
        self::addScript($base.'js/lang/'.$language.'.js', false);
        self::addStyle($base."css/fullcalendar.min.css", false);

        self::$loaded[__FUNCTION__] = true;
	}

    /**
     * Load library.
     */
	public static function google()
	{
        // Only load once
        if (!empty(self::$loaded[__FUNCTION__])) return;

        $base = self::$base_path."gmap/";
        self::addScript('http://maps.google.com/maps/api/js?key=AIzaSyDiWZ6GZl3_AW-LXlhcU9dYxbPEknOuElg');
        self::addScript($base.'js/gmap3.min.js', false);

        self::$loaded[__FUNCTION__] = true;
	}

    /**
     * Load library.
     */
	public static function video()
	{
        // Only load once
        if (!empty(self::$loaded[__FUNCTION__])) return;

        $min = !JDEBUG ? ".min" : "";
        self::addStyle("//vjs.zencdn.net/5.8/video-js".$min.".css", false);
        self::addScript("//vjs.zencdn.net/5.8/video".$min.".js", false, false);

        self::$loaded[__FUNCTION__] = true;
	}

    /**
     * Load library.
     */
	public static function sortable()
	{
        // Only load once
        if (!empty(self::$loaded[__FUNCTION__])) return;

        $base = self::$base_path.__FUNCTION__."/";

        self::jQueryUi();

        self::addStyle($base."sortable.min.css", false);

        self::$loaded[__FUNCTION__] = true;
	}

    /**
     * Load library.
     */
	public static function moment()
	{
        // Only load once
        if (!empty(self::$loaded[__FUNCTION__])) return;

        self::addScript("FootManager/moment.min.js");

        self::$loaded[__FUNCTION__] = true;
	}

    /**
     * Load library.
     */
	public static function datetimepicker()
	{
        // Only load once
        if (!empty(self::$loaded[__FUNCTION__])) return;

        self::moment();
        self::loadComponent(__FUNCTION__);
	}

    /**
     * Load library.
     */
	public static function touchspin()
	{
        self::loadComponent(__FUNCTION__);
	}

    /**
     * Load library.
     */
	public static function repeater()
	{
        self::loadComponent(__FUNCTION__);
	}

    /**
     * Load library.
     */
	public static function toggle()
	{
        self::loadComponent(__FUNCTION__);
	}

    /**
     * Load library.
     */
	public static function slick()
	{
        self::loadComponent(__FUNCTION__);
	}

    /**
     * Load library.
     */
	public static function table()
	{
        if(self::loadComponent(__FUNCTION__)) {
            $path = self::$base_path.__FUNCTION__."/";

            $lang = \JFactory::getLanguage();
            self::addScript($path.'tableFormatters.min.js', false);
            self::addScript($path.'table-locale/bootstrap-table-'.$lang->getTag().'.min.js', false);
        }
	}

    /**
     * Load library.
     */
	public static function chart()
	{
        self::loadComponent(__FUNCTION__);
	}

    /**
     * Load library.
     */
	public static function countdown()
	{
        self::loadComponent(__FUNCTION__);
	}

    /**
     * Load library.
     */
	public static function radio()
	{
        self::loadComponent(__FUNCTION__);
	}

    /**
     * Load library.
     */
	public static function statesselect()
	{
        self::loadComponent(__FUNCTION__);
	}

    /**
     * Write a <script></script> element
     *
     * @param   string   $file            path to file.
     * @param   boolean  $framework       load the JS framework.
     * @param   boolean  $relative        path to file is relative to /media folder.
     * @param   boolean  $path_only       return the path to the file only.
     * @param   boolean  $detect_browser  detect browser to include specific browser js files.
     * @param   boolean  $detect_debug    detect debug to search for compressed files if debug is on.
     *
     * @return  mixed  nothing if $path_only is false, null, path or array of path if specific js browser files were detected.
     *
     * @see     JHtml::stylesheet()
     * @since   1.5
     */
	public static function script($file, $framework = false, $relative = false, $path_only = false, $detect_browser = true, $detect_debug = true, $defer = false, $async = false)
	{
		// Include MooTools framework
		if ($framework)
		{
			static::_('behavior.framework');
		}

		$includes = static::includeRelativeFiles('js', $file, $relative, $detect_browser, $detect_debug);

		// If only path is required
		if ($path_only)
		{
			if (count($includes) == 0)
			{
				return null;
			}
			elseif (count($includes) == 1)
			{
				return $includes[0];
			}
			else
			{
				return $includes;
			}
		}
		// If inclusion is required
		else
		{
			$document = \JFactory::getDocument();

			foreach ($includes as $include)
			{
				$document->addScript($include, 'text/javascript', $defer, $async);
			}
            return true;
		}
	}

    /**
     * Compute the files to be included
     *
     * @param   string   $folder          folder name to search into (images, css, js, ...).
     * @param   string   $file            path to file.
     * @param   boolean  $relative        path to file is relative to /media folder  (and searches in template).
     * @param   boolean  $detect_browser  detect browser to include specific browser files.
     * @param   boolean  $detect_debug    detect debug to include compressed files if debug is on.
     *
     * @return  array    files to be included.
     *
     * @see     JBrowser
     * @since   1.6
     */
	protected static function includeRelativeFiles($folder, $file, $relative, $detect_browser, $detect_debug)
	{
		// If http is present in filename
		if (strpos($file, 'http') === 0 || strpos($file, '//') === 0)
		{
			$includes = array($file);
		}
		else
		{
			// Extract extension and strip the file
			$strip = \JFile::stripExt($file);
			$ext   = \JFile::getExt($file);

			// Prepare array of files
			$includes = array();

			// Detect browser and compute potential files
			if ($detect_browser)
			{
				$navigator = \JBrowser::getInstance();
				$browser = $navigator->getBrowser();
				$major = $navigator->getMajor();
				$minor = $navigator->getMinor();

				// Try to include files named filename.ext, filename_browser.ext, filename_browser_major.ext, filename_browser_major_minor.ext
				// where major and minor are the browser version names
				$potential = array($strip, $strip . '_' . $browser,  $strip . '_' . $browser . '_' . $major,
					$strip . '_' . $browser . '_' . $major . '_' . $minor);
			}
			else
			{
				$potential = array($strip);
			}

			// If relative search in template directory or media directory
			if ($relative)
			{
				// Get the template
				$template = \JFactory::getApplication()->getTemplate();

				// For each potential files
				foreach ($potential as $strip)
				{
					$files = array();

					// Detect debug mode
					if ($detect_debug && \JFactory::getConfig()->get('debug'))
					{
						/*
                         * Detect if we received a file in the format name.min.ext
                         * If so, strip the .min part out, otherwise append -uncompressed
                         */
						if (strrpos($strip, '.min', -4))
						{
							$position = strrpos($strip, '.min', -4);
							$filename = str_replace('.min', '.', $strip, $position);
							$files[]  = $filename . $ext;
						}
						else
						{
							$files[] = $strip . '-uncompressed.' . $ext;
						}
					}

					$files[] = $strip . '.' . $ext;

					/*
                     * Loop on 1 or 2 files and break on first found.
                     * Add the content of the MD5SUM file located in the same folder to url to ensure cache browser refresh
                     * This MD5SUM file must represent the signature of the folder content
                     */
					foreach ($files as $file)
					{
						// If the file is in the template folder
						$path = JPATH_THEMES . "/$template/$folder/$file";

						if (file_exists($path))
						{
							$md5 = dirname($path) . '/MD5SUM';
							$includes[] = \JUri::base(true) . "/templates/$template/$folder/$file" .
								(file_exists($md5) ? ('?' . file_get_contents($md5)) : '');

							break;
						}
						else
						{
							// If the file contains any /: it can be in an media extension subfolder
							if (strpos($file, '/'))
							{
								// Divide the file extracting the extension as the first part before /
								list($extension, $file) = explode('/', $file, 2);

								// If the file yet contains any /: it can be a plugin
								if (strpos($file, '/'))
								{
									// Divide the file extracting the element as the first part before /
									list($element, $file) = explode('/', $file, 2);

									// Try to deal with plugins group in the media folder
									$path = JPATH_ROOT . "/media/$extension/$element/$folder/$file";

									if (file_exists($path))
									{
										$md5 = dirname($path) . '/MD5SUM';
										$includes[] = \JUri::root(true) . "/media/$extension/$element/$folder/$file" .
											(file_exists($md5) ? ('?' . file_get_contents($md5)) : '');

										break;
									}

									// Try to deal with classical file in a a media subfolder called element
									$path = JPATH_ROOT . "/media/$extension/$folder/$element/$file";

									if (file_exists($path))
									{
										$md5 = dirname($path) . '/MD5SUM';
										$includes[] = \JUri::root(true) . "/media/$extension/$folder/$element/$file" .
											(file_exists($md5) ? ('?' . file_get_contents($md5)) : '');

										break;
									}

									// Try to deal with system files in the template folder
									$path = JPATH_THEMES . "/$template/$folder/system/$element/$file";

									if (file_exists($path))
									{
										$md5 = dirname($path) . '/MD5SUM';
										$includes[] = \JUri::root(true) . "/templates/$template/$folder/system/$element/$file" .
											(file_exists($md5) ? ('?' . file_get_contents($md5)) : '');

										break;
									}

									// Try to deal with system files in the media folder
									$path = JPATH_ROOT . "/media/system/$folder/$element/$file";

									if (file_exists($path))
									{
										$md5 = dirname($path) . '/MD5SUM';
										$includes[] = \JUri::root(true) . "/media/system/$folder/$element/$file" .
											(file_exists($md5) ? ('?' . file_get_contents($md5)) : '');

										break;
									}
								}
								else
								{
									// Try to deals in the extension media folder
									$path = JPATH_ROOT . "/media/$extension/$folder/$file";

									if (file_exists($path))
									{
										$md5 = dirname($path) . '/MD5SUM';
										$includes[] = \JUri::root(true) . "/media/$extension/$folder/$file" .
											(file_exists($md5) ? ('?' . file_get_contents($md5)) : '');

										break;
									}

									// Try to deal with system files in the template folder
									$path = JPATH_THEMES . "/$template/$folder/system/$file";

									if (file_exists($path))
									{
										$md5 = dirname($path) . '/MD5SUM';
										$includes[] = \JUri::root(true) . "/templates/$template/$folder/system/$file" .
											(file_exists($md5) ? ('?' . file_get_contents($md5)) : '');

										break;
									}

									// Try to deal with system files in the media folder
									$path = JPATH_ROOT . "/media/system/$folder/$file";

									if (file_exists($path))
									{
										$md5 = dirname($path) . '/MD5SUM';
										$includes[] = \JUri::root(true) . "/media/system/$folder/$file" .
											(file_exists($md5) ? ('?' . file_get_contents($md5)) : '');

										break;
									}
								}
							}
							// Try to deal with system files in the media folder
							else
							{
								$path = JPATH_ROOT . "/media/system/$folder/$file";

								if (file_exists($path))
								{
									$md5 = dirname($path) . '/MD5SUM';
									$includes[] = \JUri::root(true) . "/media/system/$folder/$file" .
											(file_exists($md5) ? ('?' . file_get_contents($md5)) : '');

									break;
								}
							}
						}
					}
				}
			}
			// If not relative and http is not present in filename
			else
			{
				foreach ($potential as $strip)
				{
					$files = array();

					// Detect debug mode
					if ($detect_debug && \JFactory::getConfig()->get('debug'))
					{
						/*
                         * Detect if we received a file in the format name.min.ext
                         * If so, strip the .min part out, otherwise append -uncompressed
                         */
						if (strrpos($strip, '.min', -4))
						{
							$position = strrpos($strip, '.min', -4);
							$filename = str_replace('.min', '.', $strip, $position);
							$files[]  = $filename . $ext;
						}
						else
						{
							$files[] = $strip . '-uncompressed.' . $ext;
						}
					}

					$files[] = $strip . '.' . $ext;

					/*
                     * Loop on 1 or 2 files and break on first found.
                     * Add the content of the MD5SUM file located in the same folder to url to ensure cache browser refresh
                     * This MD5SUM file must represent the signature of the folder content
                     */
					foreach ($files as $file)
					{
						$path = JPATH_ROOT . "/$file";

						if (file_exists($path))
						{
							$md5 = dirname($path) . '/MD5SUM';
							$includes[] = \JUri::root(true) . "/$file" .
								(file_exists($md5) ? ('?' . file_get_contents($md5)) : '');

							break;
						}
					}
				}
			}
		}

		return $includes;
	}
}