/**
 * @package     Joomla.Administrator
 * @subpackage  Templates.isis
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @since       3.0
 */

(function ($) {
    $(document).ready(function () {
        $("#jform_players_repeater table tbody").on('change', 'select[name="jform[players][person_id]"]', function (e) {
            var personId = $(e.currentTarget).val();
            var tr = $(e.currentTarget).closest("tr");

            if (personId) {
                var dataToSend = { id: personId };

                var success = function (result) {
                    var cat = result.category_id;
                    var pos = result.position_id;
                    $(tr).find('select[name="jform[players][category_id]"]').val(cat).trigger('liszt:updated');
                    $(tr).find('select[name="jform[players][position_id]"]').val(pos).trigger('liszt:updated');
                    $("#jform_players_repeater").data("Repeater").save();
                };

                FM.loadAjaxData("getPerson", dataToSend, success);
            }
        }.bind(this));

        $("#jform_players_repeater").on("rowAdded", function (e) {
            $(e.row).find('select[name="jform[players][person_id]"]').trigger("change");
        }.bind(this));
    });
})(jQuery);