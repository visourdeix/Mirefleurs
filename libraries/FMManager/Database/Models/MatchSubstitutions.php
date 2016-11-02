<?php
/**
 * @package      FMManager
 * @subpackage   Models
 * @author       Stéphane ANDRE
 * @copyright    Copyright (C) 2015 Stéphane ANDRE. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace FMManager\Database\Models;

defined('JPATH_PLATFORM') or die;

use FootManager\Database\Eloquent\Model;

/**
 * This class contains common methods and properties for a database item
 *
 * @package      FMManager
 * @subpackage   Models
 */
class MatchSubstitutions extends MatchItem {

    /**
     * Main Table.
     * @var string
     */
    protected $table = "fm_match_substitutions";

    /**
     * Get the person.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function playerOut()
    {
        return $this->belongsTo(Person::class, "playerOut_id");
    }

    /**
     * Get the person.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function playerIn()
    {
        return $this->belongsTo(Person::class, "playerIn_id");
    }

}

?>