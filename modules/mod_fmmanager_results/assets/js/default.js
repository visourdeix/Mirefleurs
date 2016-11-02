/**
 * @package     Joomla.Administrator
 * @subpackage  Templates.isis
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @since       3.0
 */

(function ($) {
    $(document).ready(function () {
        $('.mod-fmmanager-results #fm-previous, .mod-fmmanager-results #fm-next').on('click', function () {
            updateEvent($(this).closest('.mod-fmmanager-results').attr('id'), $(this).attr("data-direction"));
        });
    });

    function updateEvent(id, direction) {
        var date = $('#' + id + ' #fm-date').val();

        var params = { date: date, direction: direction };
        FM.displayModule('fmmanager_results', id, params);

        return false;
    }
})(jQuery)