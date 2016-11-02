<?php
/**
 * @package    Joomla.Administrator
 *
 * @copyright  Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace FootManager\UI\Html;

defined('JPATH_PLATFORM') or die;

use FootManager\Utilities\HtmlHelper;

/**
 * Utility class for the button bar.
 *
 * @since  1.5
 */
abstract class Media
{
	/**
     * Displays a modal button
     *
     * @param   string  $targetModalId  ID of the target modal box
     * @param   string  $icon           Icon class to show on modal button
     * @param   string  $alt            Title for the modal button
     *
     * @return  string
     *
     * @since   3.2
     */
	public static function video($file, $attribs = array())
	{
        \FootManager\UI\Loader::video();
        $id = isset($attribs["id"]) ? $attribs["id"] : uniqid();
        unset($attribs["id"]);

        $html = [];
        $html[] = '<video id="'.$id.'" class="video-js vjs-default-skin" controls data-setup="{}" ' . HtmlHelper::attribs($attribs) . '>';
        $html[] = '<source src="'.$file.'" type="video/mp4">';
        $html[] = '</video>';

        $html[] = '<script type="text/javascript">
                        videojs("#'.$id.'").ready(function(){
                            var aspectRatio = 9/16;

                            function resizeVideoJS(myPlayer){
                                var myPlayer = jQuery("#'.$id.'");
                                  var width = myPlayer.parent().width();
                                  // Set width to fill parent element, Set height
                                  myPlayer.width(width).height( width * aspectRatio );
                            }

                            resizeVideoJS();
                            window.onresize = resizeVideoJS;
                        });
                    </script>';

        return implode("\n", $html);
	}

}