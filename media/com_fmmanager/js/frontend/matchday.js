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
        loadMatchContent("matches");
        loadMatchContent("stats");

        $(".fm-matchday > .fm-matchdays").on('beforeChange', function (event, slick, currentSlide, nextSlide) {
            if (currentSlide !== nextSlide) {
                var link = $('.fm-matchday > .fm-matchdays .fm-slick-matchday[data-slick-index="' + nextSlide + '"] a').attr("href");
                window.location.href = link;
            }
        });

        function loadMatchContent(contentId) {
            if (jQuery('#fm-' + contentId).length > 0) {
                var id = jQuery("#fm-id").val();
                var paramsStr = base64.decode(jQuery("#fm-params").val());
                var url = 'index.php?option=com_fmmanager&task=matchday.displayContent';

                var params = (paramsStr == undefined) ? {} : JSON.parse(paramsStr);

                var data = {
                    id: id,
                    params: base64.encode(JSON.stringify(params)),
                    model: 'matchday',
                    content: contentId
                };

                FM.displayAjax(url, data, '#fm-' + contentId);
            }
        }
    });
})(jQuery);