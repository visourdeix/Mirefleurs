<?php
/**
 * @package      FootManager
 * @subpackage   Controllers
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FootManager\Model;

use Joomla\Utilities\ArrayHelper;
use FootManager\Utilities\StringHelper;

defined('JPATH_PLATFORM') or die;
/**
 * This class contains common methods and properties
 * used in work with ajax actions.
 *
 * @package      FootManager
 * @subpackage   Controllers
 */
abstract class Ajax extends Item
{
    /**
     * Gets the data.
     * @param mixed $id
     * @param mixed $params
     */
    public abstract function getData($id, &$params = array());
}