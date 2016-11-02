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
 * HTML utility class for building a dropdown menu
 *
 * @since  3.2
 */
abstract class Chart
{
    static public function doughnut($data, $id = "", $width = "200", $height = "200", $options = array()) {

        $str = array();
        $id = ($id) ? $id : uniqid();

        $options["segmentShowStroke"] = \JArrayHelper::getValue($options, "segmentShowStroke", false);
        $options["percentageInnerCutout"] = \JArrayHelper::getValue($options, "percentageInnerCutout", 65);

		$str[] = '<canvas id="'.$id.'" width="'.$width.'" height="'.$height.'"></canvas>';
        \FootManager\UI\ui::chart("#".$id, "doughnut", $data, $options);

        return implode("\n", $str);

    }
}