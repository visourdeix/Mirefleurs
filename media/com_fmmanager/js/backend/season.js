/**
 * @package     Joomla.Administrator
 * @subpackage  Templates.isis
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @since       3.0
 */

(function($)
{
    $(document).ready(function () {

        // Turn radios into btn-group
        $("#jform_start_date_datetimepicker").on("dp.change", function (e) {
            if ($('#jform_end_date_datetimepicker').data("DateTimePicker") != undefined) {
                $('#jform_end_date_datetimepicker').data("DateTimePicker").date(e.date.add(1, 'years').add(-1, "days"));
                $('#jform_end_date_datetimepicker').data("DateTimePicker").minDate(e.date);
            }
        });

    });

})(jQuery);
