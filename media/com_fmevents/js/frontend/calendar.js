/**
* @package     Joomla.Administrator
* @subpackage  Templates.isis
* @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
* @license     GNU General Public License version 2 or later; see LICENSE.txt
* @since       3.0
*/

'use strict';

(function ($) {
    $(document).ready(function () {
        $('#fm-calendar-filters .fm-filters-inputs input').on('change', function () {
            $('#fm-calendar').fullCalendar('refetchEvents');
        });

        $('#fm-calendar-filters #fm-select-all').on('change', function () {
            $('#fm-calendar-filters input').prop("checked", $('#fm-calendar-filters #fm-select-all').prop("checked"));
            $('#fm-calendar').fullCalendar('refetchEvents');
        });
    });
})(jQuery);