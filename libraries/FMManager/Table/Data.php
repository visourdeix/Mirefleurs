<?php
/**
 * @package     Fmmanager
 * @subpackage  com_fmmanager
 *
 * @copyright   Copyright (C) 2015 STéphane ANDRE. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace FMManager\Table;

defined('_JEXEC') or die;

/**
 * Data Table.
 *
 */
abstract class Data extends \FootManager\Table\Table
{

    function __construct($model, &$db)
    {
        parent::__construct($model ,$db);

        $this->addNotEmptyFields("label");
        $this->addUniqueFields("label");

    }
}
?>