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
        function createDoughnut(selector, data) {
            var options = { segmentShowStroke: false, percentageInnerCutout: 65, showTooltips: false, responsive: false };
            var ctx = $(selector).get(0).getContext('2d');
            new Chart(ctx).Doughnut(data, options);
        }

        var displayContent = function () {
            var type = $('input[name="type"]:checked').val();
            var competitions = [];

            $('input[name="competitions[]"]').each(function () {
                if ($(this).attr('checked') === 'checked') competitions.push($(this).val());
            });

            FM.displayContent({ type: type, competitions: competitions }, success);
        }

        var success = function updateCharts() {
            var charts = $('#fm-content input[type="hidden"][name*="charts["]');

            charts.each(function () {
                var data = jQuery.parseJSON($(this).val());
                createDoughnut("#" + $(this).attr('id') + "-chart", data);
            });
        };

        $('input[name="type"], input[name="competitions[]"]').on('change', function () {
            displayContent();
        });
        displayContent();
    });
})(jQuery);