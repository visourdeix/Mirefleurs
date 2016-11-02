/**
 * @package     Joomla.Administrator
 * @subpackage  Templates.isis
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @since       3.0
 */

(function ($) {
    $(document).ready(function () {
        var updating = false;
        var updateField = function (source, target, functionName) {
            $(source).on("change", function () {
                var value = $(source).val();

                if (value !== '' && !updating) {
                    updating = true;
                    var dataToSend = { value: value };

                    var success = function (result) {
                        FM.setValue(target, result);
                        updating = false;
                    };

                    FM.loadAjaxData(functionName, dataToSend, success);
                }
            });
        };

        updateField("#jform_city", "#jform_postal_code", "getPostalCodeFromCity");
        updateField("#jform_postal_code", "#jform_city", "getCityFromPostalCode");

        // Turn radios into btn-group
        $("#jform_birthdate_datetimepicker").on("dp.change", function () {
            if ($('#jform_birthdate_datetimepicker').data("DateTimePicker") != undefined) {
                var date = $('#jform_birthdate_datetimepicker').data("DateTimePicker").date;
                if (date) {
                    var dataToSend = { birthdate: date };

                    var success = function (result) {
                        FM.setValue('select[name="jform[category_id]"]', result);
                    };

                    FM.loadAjaxData("getCategoryFromBirthdate", dataToSend, success);
                }
            }
        });
    });
})(jQuery);