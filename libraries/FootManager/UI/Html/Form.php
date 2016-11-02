<?php
/**
 * @package     Joomla.Libraries
 * @subpackage  HTML
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace FootManager\UI\Html;

defined('JPATH_PLATFORM') or die;

use FootManager\Utilities\HtmlHelper;

/**
 * Utility class for all HTML drawing classes
 *
 * @since  1.5
 */
abstract class Form
{

    static public function textbox($attribs = array(), $readonly = false) {

        $readonly = ($readonly) ? ' disabled' : '';

        if(isset($attribs["class"]))
            $attribs["class"] .= $readonly;
        else
            $attribs["class"] = $readonly;

        $str = array();
        $attribs_html = HtmlHelper::attribs($attribs);

		$str[] = '    <input type="text"'.$attribs_html. $readonly . '>';

        return implode("\n", $str);

    }
    static public function textboxAppend($attribsInput = array(), $attribsDiv = array(), $icon = "plus", $readonly = false, $iconClass = "") {

        $readonly = ($readonly) ? ' readonly' : '';

        if(isset($attribsDiv["class"]))
            $attribsDiv["class"] .= " input-append";
        else
            $attribsDiv["class"] = " input-append";

        $str = array();
        $attribs_div = HtmlHelper::attribs($attribsDiv);
        $attribs_input = HtmlHelper::attribs($attribsInput);

        $str[] = '<div' . $attribs_div . '>';
		$str[] = '    <input type="text"'.$attribs_input. $readonly . '>';

        if(!$readonly) {
            $str[] = '	  <span class="add-on '.$iconClass.'">';
            $str[] = '      <i class="fa fa-'.$icon.'"></i>';
            $str[] = '	  </span>';
        }
		$str[] = '</div>';

        return implode("\n", $str);
    }

    static public function checkbox($attribs = array(), $checked = false, $readonly = false) {

        $readonly = ($readonly) ? ' disabled ' : '';
        $checked = ($checked) ? ' checked ' : '';

        if(isset($attribs["class"]))
            $attribs["class"] .= $readonly;
        else
            $attribs["class"] = $readonly;

        $str = array();
        $attribs_html = HtmlHelper::attribs($attribs);

		$str[] = '    <input type="checkbox"'. $attribs_html . $readonly.$checked.' />';

        return implode("\n", $str);
    }

    static public function hidden($attribs = array()) {

        $str = array();
        $attribs_html = HtmlHelper::attribs($attribs);

		$str[] = '    <input type="hidden"'. $attribs_html.' />';

        return implode("\n", $str);
    }

    static public function select($options = array(), $value = 0, $attribs = array()) {

        \JHtml::_('formbehavior.chosen', 'select');

        $id = isset($attribs["id"]) ? $attribs["id"] : "";
        $name = isset($attribs["name"]) ? $attribs["name"] : "";

        $str = array();
        $attribs_html = HtmlHelper::attribs($attribs);

		$str[] = \JHtml::_('select.genericlist', $options, $name, array("list.attr" => trim($attribs_html), "option.attr" => "attributes", "list.select" =>$value, "id" => $id));

        return implode("\n", $str);
    }

}