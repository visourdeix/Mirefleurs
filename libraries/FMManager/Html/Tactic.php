<?php
/**
 * @package      Fmmanager
 * @subpackage   lib_FootManager
 *
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      http://www.gnu.org/licenses/gpl.html GNU/GPL, see LICENSE.txt
 */

namespace FMManager\Html;

defined('_JEXEC') or die();

/**
 * Html for Foot Manager classes.
 *
 */
abstract class Tactic
{

    /**
     * Execute function.
     * @param mixed $selector
     * @param mixed $params
     */
    public static function editor($selector = '.fmtactic', $params = array())
	{
        \FootManager\UI\Loader::addScript(FM_MANAGER_COMPONENT."/tacticeditor.min.js");
		\FootManager\UI\ui::execute("TacticEditor", $selector,$params);
	}

}