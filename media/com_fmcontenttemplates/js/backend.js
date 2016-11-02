/*
* @author          Peter van Westen <peter@nonumber.nl>
* @link            http://www.nonumber.nl
    * @copyright       Copyright © 2016 NoNumber All Rights Reserved
    * @license         http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
    */

var FmContentTemplates = null;

(function ($) {
    "use strict";

    FmContentTemplates = {
        loadTemplate: function (plugin, data) {
            FM.loadAjaxPlugin("fmcontenttemplates", plugin, data, function (result) {
                var fields = {};
                $.each(result.data, function () {
                    $.extend(fields, this);
                });
                FmContentTemplates.loadData(fields);
            });
        },

        loadData: function (data) {
            if (data) {
                $.each(data, function (index, value) {
                    switch (index) {
                        case "jform_articletext":
                            FM.loadAjax("index.php?option=com_fmcontenttemplates&task=form.ajaxEditor", {}, function (result) {
                                var js = JSON.parse(result);
                                js = js.replace("[[EDITOR]]", index);
                                js = js.replace("[[HTML]]", JSON.stringify(value));
                                eval(js);
                            });
                            break;

                        default:
                            FM.setValue('#' + index, value);
                    }
                });
            }
        }
    }
})(jQuery);

function loadTemplate(plugin, data) {
    FmContentTemplates.loadTemplate(plugin, data);
}

function loadTemplateInParent(template) {
    var f = jQuery('#paramsform');
    if (document.formvalidator.isValid(f)) {
        var params = {};
        var fields = jQuery('*[name*="jform["]');
        jQuery.each(fields, function () {
            var indexStart = jQuery(this).attr('name').indexOf('[');
            var indexEnd = jQuery(this).attr('name').indexOf(']');
            if (indexStart !== -1 && indexEnd !== -1) {
                var shortName = jQuery(this).attr('name').substring(indexStart + 1, indexEnd);
                params[shortName] = jQuery(this).val();
            }
        });

        window.parent.loadTemplate(template, { params: params });
        window.parent.SqueezeBox.close();
    }
}