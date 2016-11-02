/**
 * @package     Joomla.Administrator
 * @subpackage  Templates.isis
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @since       3.0
 */

(function ($) {
    $(document).ready(function () {
        $("#jform_catid").on("change", function (e) {
            var cat = $('select[name="jform[catid]"]').val();

            if (cat !== '' && cat !== undefined) {
                var dataToSend = { id: cat };

                var success = function (result) {
                    FM.setValue('input[name="jform[title]"]', result.title);
                };

                FM.loadAjaxData("getCategory", dataToSend, success);
            } else {
                $('input[name="jform[title]"]').val("");
            }
        });
        $("#jform_catid").trigger("change");

        $("input[name='jform[date_option]']").on("change", function (e) {
            var custom = $('input[name="jform[date_option]"][value="2"]').prop("checked");

            if (custom) {
                $('#edit_date').show();
            } else {
                $("input[name='jform[date]']").val("");
                $('#edit_date').hide();
            }
        });

        var uploader = $('#jform_uploader').pluploadQueue();
        var savedTask = "";

        uploader.bind('BeforeUpload', function (up, file) {
            tags = [];

            $("#jform_tags option:selected").each(function () { tags.push($(this).val()); });

            up.settings.multipart_params = {
                "category": $("#jform_catid").val(),
                "title": $("#jform_title").val(),
                "date": $("#jform_date").val(),
                "state": $("#jform_state").val(),
                "tags": tags,
            };
        });

        uploader.bind('UploadComplete', function () {
            //$('#adminForm')[0].submit();
            Joomla.submitform(savedTask, document.getElementById("adminForm"));
        });

        Joomla.submitbutton = function (task) {
            savedTask = task;
            if (task === "addphotos.save" || task === "addphotos.save2new") {
                if ($("#jform_title").val() !== '' && $("#jform_catid").val() !== '') {
                    // Files in queue upload them first
                    if (uploader.files.length > 0) {
                        // When all files are uploaded submit form

                        uploader.start();
                        return;
                    }
                }
            }

            Joomla.submitform(task, document.getElementById("adminForm"));
        };
    });
})(jQuery);