/**
 * @package     Joomla.Administrator
 * @subpackage  Templates.isis
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @since       3.0
 */

(function ($) {
    $(document).ready(function () {
        // Turn radios into btn-group
        $("#jform_tournament_id").on("change", function () {
            var id = $('#jform_tournament_id').val();

            if (id != undefined) {
                var dataToSend = { id: id };

                var success = function (result) {
                    if (result.type.has_ranking === 1) {
                        $('#ranking').show();
                        $('#jform_teams_repeater table tr th:nth-child(2)').css('width:auto');
                    }
                    else {
                        $('#ranking').hide();
                        $('#jform_teams_repeater table tr th:nth-child(2)').css('width:0px;');
                    }
                };

                FM.loadAjaxData("getTournament", dataToSend, success);
            }
        });
        $("#jform_tournament_id").trigger("change");
    });
})(jQuery);