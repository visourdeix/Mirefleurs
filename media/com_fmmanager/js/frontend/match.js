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
        loadMatchContent("callUp");
        loadMatchContent("teams");
        loadMatchContent("faceToFace");
        loadMatchContent("stats");
        loadMatchContent("results");
        loadMatchContent("ranking");
    });

    function createDoughnut(selector, data) {
        var options = { segmentShowStroke: false, percentageInnerCutout: 65, showTooltips: false, responsive: false };
        var ctx = $(selector).get(0).getContext('2d');
        new Chart(ctx).Doughnut(data, options);
    }

    function loadMatchContent(contentId) {
        if (jQuery('#fm-' + contentId).length > 0) {
            var id = jQuery("#fm-id").val();
            var paramsStr = base64.decode(jQuery("#fm-params").val());
            var url = 'index.php?option=com_fmmanager&task=match.displayContent';

            var params = (paramsStr == undefined) ? {} : JSON.parse(paramsStr);

            var data = {
                id: id,
                params: base64.encode(JSON.stringify(params)),
                model: 'match',
                content: contentId
            };

            var success = function () {
                if (contentId === 'faceToFace') {
                    var div = jQuery('#fm-' + contentId);
                    var charts = div.find('input[type="hidden"][name*="charts["]');

                    charts.each(function () {
                        var data = jQuery.parseJSON($(this).val());
                        createDoughnut("#" + $(this).attr('id') + "-chart", data);
                    });
                }
            }

            FM.displayAjax(url, data, '#fm-' + contentId, success);
        }
    }
})(jQuery);