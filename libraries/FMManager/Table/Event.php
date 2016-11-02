<?php
/**
 * @package     Fmmanager
 * @subpackage  Positions
 *
 * @copyright   Copyright (C) 2015 STéphane ANDRE. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace FMManager\Table;

defined('_JEXEC') or die;

/**
 * Positions Table.
 *
 */
abstract class Event extends \FootManager\Table\Table
{

    function __construct($model, &$db)
    {
        parent::__construct($model ,$db);

        $this->addNotEmptyFields("date");

    }

    public function deleteCallUp() {

        if(isset($this->call_up_id) && $this->call_up_id) {
            $table = \JTable::getInstance("Callup", "FmmanagerTable");
            $table->delete($this->call_up_id);

            $this->call_up_id = 0;
        }

        return true;

    }

    public function report() {

        $this->deleteCallUp();
        $this->state = \FMManager\Constants::REPORTED;

        return true;

    }
    
    public function stop() {

        $this->deleteCallUp();
        $this->state = \FMManager\Constants::STOPPED;

        return true;

    }

    public function cancel() {

        $this->deleteCallUp();
        $this->state = \FMManager\Constants::CANCELLED;

        return true;

    }

    public function active() {

        $this->state = \FMManager\Constants::PLAYED;

        return true;

    }

    public function inactive() {

        $this->deleteCallUp();
        $this->state = \FMManager\Constants::NOT_PLAYED;

        return true;

    }

}
?>