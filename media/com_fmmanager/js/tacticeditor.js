/**
 * @package		Joomla.JavaScript
 * @copyright	Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

(function (factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD is used - Register as an anonymous module.
        define(['jquery'], factory);
    } else if (typeof exports === 'object') {
        factory(require('jquery'));
    } else {
        // Neither AMD nor CommonJS used. Use global variables.
        if (typeof jQuery === 'undefined') {
            throw 'TacticEditor requires jQuery to be loaded first';
        }
        factory(jQuery);
    }
}(function ($) {
    var tacticeditor = function (element, options) {
        var editor = {},
            id = $(element).attr('id'),
            activeInput = "",
            initialized = false,

             notifyEvent = function (e) {
                 element.trigger(e);
             },

            save = function () {
                var input, label, idInput, valueInput, checked, json = [];

                for (var i = 1; i <= options.countrows; i++) {
                    for (var j = 1; j <= options.countcolumns; j++) {
                        valueInput = i + "_" + j;
                        idInput = id + "_" + valueInput;
                        input = $(element).find('#' + idInput);
                        label = $(element).find('label[for="' + idInput + '"]');
                        checked = input.prop("checked");

                        if (checked) {
                            var item = {};

                            $.each(label.data(), function (key, value) {
                                if (key !== "tooltip" && key !== "target" && key !== "toggle")
                                    item[key] = value.toString();
                            });

                            json.push(item);
                        }
                    }
                }

                $(element).find('#' + id + "_save").val(JSON.stringify(json));

                if (initialized)
                    notifyEvent({
                        type: 'save'
                    });
                else
                    notifyEvent({
                        type: 'initialized'
                    });

                return true;
            },

            getTemplate = function () {
                var table = $('<table></table>');
                var body = $('<tbody></tbody>');

                var tr, td, input, label, itemLabel, button, idInput, valueInput;
                for (var i = 1; i <= options.countrows; i++) {
                    tr = $('<tr></tr>');

                    for (var j = 1; j <= options.countcolumns; j++) {
                        td = $('<td></td>');
                        valueInput = i + "_" + j;
                        idInput = id + "_" + valueInput;
                        input = $('<input type="checkbox">');
                        input.attr('id', idInput);
                        input.attr('value', valueInput);

                        input.on("change", function () {
                            if ($(this).prop("checked")) {
                                $(this).closest("td").find("label").tooltip();
                            } else {
                                $(this).closest("td").find("label").tooltip('destroy');
                            }
                            save();
                        });

                        label = $('<label></label>');
                        itemLabel = $('<div id="' + idInput + '_title"></div>');

                        label.data('column', j);
                        label.data('row', i);
                        label.attr('for', idInput);

                        td.append(input);
                        label.append(itemLabel);
                        td.append(label);

                        button = $('<span></span>');
                        button.addClass('fa fa-edit fm-edit btn');
                        button.attr('data-target', '#' + id + "_modal");
                        button.attr('data-toggle', 'modal');

                        td.append(button);

                        button.on("click", function () {
                            activeInput = $(this).closest("td").find("input").attr("id");
                        });
                        label.on("click", function () {
                            activeInput = $(this).closest("td").find("input").attr("id");
                        });

                        tr.append(td);
                    }

                    body.append(tr);
                }

                table.append(body);

                return table;
            },

            getSaveInput = function () {
                var input = $('<input type="hidden" >');
                input.attr("id", id + "_save");
                input.attr("name", options.name);
                return input;
            },

            getModalTemplate = function () {
                var template = $('<div></div>');
                template.attr('id', id + "_modal");
                template.addClass('modal hide fade fm-tactic-modal');

                var form = $('<div class="form-horizontal"></div>');
                var row = $('<div class="row-fluid"></div>');
                var span = $('<div class="span12"></div>');

                row.append(span);
                form.append(row);
                template.append(form);

                var group = $('<div class="control-group"></div>');
                var control = $('<div class="control-label"></div>');
                var controls = $('<div class="controls"></div>');

                $.each(options.editinputs, function (i, item) {
                    var controlLabel = control.clone();
                    var controlInput = controls.clone();
                    var groupInput = group.clone();
                    var label = item.label;
                    var input = item.input;

                    input = $(input).attr("id", id + "_edit_" + item.key);
                    input = $(input).attr("name", "");
                    label = $(label).attr("for", id + "_edit_" + item.key);

                    controlLabel.append(label);
                    controlInput.append(input);
                    groupInput.append(controlLabel);
                    groupInput.append(controlInput);

                    template.find(".span12").append(groupInput);

                    template.find("select").chosen({
                        disable_search_threshold: 5,
                        allow_single_deselect: true,
                        width: "220px"
                    });

                    // FMTOGGLE
                    try {
                        template.find('.fmtoggle').bootstrapToggle();
                    } catch (e) {
                    }

                    // FMTOUCHSPIN
                    try {
                        template.find('.fmtouchspin').TouchSpin();
                    } catch (e) {
                    }

                    template.find("#" + $(input).attr("id")).on("change", function () {
                        if (activeInput !== "") {
                            var val = $(this).val();

                            if ($(this).attr("type") === "checkbox") {
                                val = $(this).prop("checked") ? 1 : 0;
                            }

                            notifyEvent({
                                type: 'positionUpdating',
                                label: $('label[for="' + activeInput + '"]')
                            });

                            $('label[for="' + activeInput + '"]').data(item.key, val);

                            var text = val;
                            if ($(this).hasClass("chzn-done")) {
                                text = $("#" + $(this).attr("id") + "_chzn > .chzn-single > span").text();
                            }

                            if (options.tooltipkey === item.key) {
                                $('label[for="' + activeInput + '"]').attr("data-original-title", text);
                                $('label[for="' + activeInput + '"]').attr("title", text);
                            }

                            if (options.labelkey === item.key) {
                                $('label[for="' + activeInput + '"] > div').text(text);
                            }

                            if (options.numberkey === item.key) {
                                $('label[for="' + activeInput + '"]').attr("data-number", text);
                            }

                            notifyEvent({
                                type: 'positionUpdated',
                                label: $('label[for="' + activeInput + '"]')
                            });
                        }
                        save();
                    });
                });

                template.on("show", function () {
                    $.each(options.editinputs, function (i, item) {
                        if ($("#" + id + "_edit_" + item.key).attr("type") === "checkbox") {
                            var val = $('#' + activeInput).closest("td").find("label").data(item.key);

                            if (val === 1)
                                $("#" + id + "_edit_" + item.key).bootstrapToggle('on');
                            else
                                $("#" + id + "_edit_" + item.key).bootstrapToggle('off');
                        } else {
                            $("#" + id + "_edit_" + item.key).val($('#' + activeInput).closest("td").find("label").data(item.key));
                            $("#" + id + "_modal select").trigger('liszt:updated');
                        }
                    });
                });

                return template;
            },

            setPositions = function (values, readonlypositions, disabledpositions) {
                for (var i = 1; i <= options.countrows; i++) {
                    for (var j = 1; j <= options.countcolumns; j++) {
                        var valueInput = i + "_" + j;
                        var idInput = id + "_" + valueInput;
                        var item = undefined;

                        var itemsChecked = [];
                        var itemsReadonly = [];
                        var itemsDisabled = [];

                        jQuery.each(values, function (index, value) {
                            if (value.row === i && value.column === j) itemsChecked.push(value);
                        });
                        jQuery.each(readonlypositions, function (index, value) {
                            if (value.row === i && value.column === j) itemsReadonly.push(value);
                        });
                        jQuery.each(disabledpositions, function (index, value) {
                            if (value.row === i && value.column === j) itemsDisabled.push(value);
                        });

                        if (itemsChecked.length > 0)
                            item = itemsChecked[0];
                        else if (itemsReadonly.length > 0)
                            item = itemsReadonly[0];

                        var checked = (item != undefined);
                        var readonly = itemsReadonly.length > 0 || itemsDisabled.length > 0 || options.readonly;

                        var input = $('#' + idInput);

                        if (checked)
                            input.prop('checked', true);
                        else
                            input.prop('checked', false);

                        if (readonly) {
                            input.attr('disabled', "disabled");
                            input.attr('readonly', "readonly");
                        } else {
                            input.prop('disabled', false);
                            input.prop('readonly', false);
                        }

                        var label = $('label[for="' + idInput + '"]');
                        label.attr('title', '');
                        label.attr('data-number', '');

                        var itemLabel = label.find('div');
                        itemLabel.text('');

                        if (readonly) {
                            label.attr('data-target', '#' + id + "_modal");
                            label.attr('data-toggle', 'modal');
                        } else {
                            label.attr('data-target', '');
                            label.attr('data-toggle', '');
                        }

                        label.removeData();
                        if (item != undefined) {
                            $.each(item, function (key, value) {
                                //label.attr('data-' + key, value);
                                label.data(key, value);

                                if (options.tooltipkey === key)
                                    label.attr('title', value);

                                if (options.labelkey === key) {
                                    if ($("#" + id + "_edit_" + key).hasClass("chzn-done")) {
                                        $("#" + id + "_edit_" + key).val(value);
                                        $("#" + id + "_modal select").trigger('liszt:updated');
                                        value = $("#" + id + "_edit_" + key + "_chzn > .chzn-single > span").text();
                                    }
                                    itemLabel.text(value);
                                }

                                if (options.numberkey === key)
                                    label.attr('data-number', value);
                            });
                        } else {
                            label.data('column', j);
                            label.data('row', i);
                        }
                    }
                }

                notifyEvent({
                    type: 'positionsUpdated'
                });

                save();
            };

        // Public API
        editor.setValues = function (values) {
            setPositions(values, options.readonlypositions, options.disabledpositions);
            options.values = values;
        };
        editor.setReadOnlyPositions = function (readonlypositions) {
            setPositions(options.values, readonlypositions, options.disabledpositions);
            options.readonlypositions = readonlypositions;
        };
        editor.setDisabledPositions = function (disabledpositions) {
            setPositions(options.values, options.readonlypositions, disabledpositions);
            options.disabledpositions = disabledpositions;
        };
        editor.setAllPositions = function (values, readonlypositions, disabledpositions) {
            setPositions(values, readonlypositions, disabledpositions);
            options.disabledpositions = disabledpositions;
            options.readonlypositions = readonlypositions;
            options.values = values;
        };

        if (!$(element).hasClass("fm-tactic-editor"))
            $(element).addClass("fm-tactic-editor");

        $(element).append(getModalTemplate());
        $(element).append(getTemplate());
        $(element).append(getSaveInput());

        setPositions(options.values, options.readonlypositions, options.disabledpositions);

        initialized = true;

        return editor;
    };

    /********************************************************************************
     *
     * jQuery plugin constructor and defaults object
     *
     ********************************************************************************/

    function optsFromEl(el, prefix) {
        // Derive options from element data-attrs
        var data = $(el).data(),
			out = {}, inkey,
			replace = new RegExp('^' + prefix.toLowerCase() + '([A-Z])');
        prefix = new RegExp('^' + prefix.toLowerCase());
        function reLower(_, a) {
            return a.toLowerCase();
        }
        for (var key in data)
            if (data.hasOwnProperty(key))
                if (prefix.test(key)) {
                    inkey = key.replace(replace, reLower);
                    out[inkey] = data[key];
                }
        return out;
    }

    $.fn.TacticEditor = function (options) {
        return this.each(function () {
            var $this = $(this);
            if (!$this.data('TacticEditor')) {
                var elopts = optsFromEl(this, '');
                // create a private copy of the defaults object
                options = $.extend(true, {}, $.fn.TacticEditor.defaults, elopts, options);
                $this.data('TacticEditor', tacticeditor($this, options));
            }
        });
    };

    $.fn.TacticEditor.defaults = {
        name: "",
        countrows: 7,
        countcolumns: 5,
        readonly: false,
        disabledpositions: [
             { row: 7, column: 1 },
             { row: 7, column: 2 },
             { row: 7, column: 4 },
             { row: 7, column: 5 },
             { row: 6, column: 1 },
             { row: 6, column: 2 },
             { row: 6, column: 4 },
             { row: 6, column: 5 }
        ],
        readonlypositions: [
             { row: 7, column: 3 }
        ],
        values: [],
        editinputs: [
            {
                key: "number",
                label: "<label title=\"Indiquez le numéro par défaut pour ce poste.\">Numéro</label>",
                input: "<input type=\"text\" class=\"fmtouchspin fm-input-xxmini\" id=\"jform_positions_editNumber\">",
                isTooltip: false
            }
        ],
        tooltipkey: "",
        labelkey: "",
        numberkey: ""
    };
}));