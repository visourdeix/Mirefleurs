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
            throw 'repeater requires jQuery to be loaded first';
        }
        factory(jQuery);
    }
}(function ($) {
    var repeater = function (element, options) {
        var repeaterTable = {},
            rowTemplate,
            body,
            addButton,
            saveInput,
            initialized = false,

            // Private functions

                        getRows = function () {
                            return body.find("> tr");
                        },

                                    notifyEvent = function (e) {
                                        element.trigger(e);
                                    },

                        save = function () {
                            var i, type, json = [];
                            var rows = getRows();

                            for (i = 0; i < rows.length; i++) {
                                var fields = $(rows[i]).find('*[name*="]["]');
                                var item = {};

                                $.each(fields, function (j, field) {
                                    var indexStart = field.name.indexOf("]") + 1;
                                    var indexEnd = field.name.indexOf("]", indexStart);

                                    if (indexStart !== -1 && indexEnd !== -1) {
                                        var shortName = field.name.substring(indexStart + 1, indexEnd);
                                        type = $(this).attr('type');

                                        var value;
                                        if (type === 'radio') {
                                            if ($(this).prop('checked'))
                                                item[shortName] = $(this).val();
                                        } else {
                                            if (type === 'checkbox') {
                                                value = ($(this).prop('checked')) ? 1 : 0;
                                            } else {
                                                value = $(this).val();
                                            }

                                            item[shortName] = value;
                                        }
                                    }
                                });

                                json.push(item);
                            }

                            saveInput.val(JSON.stringify(json));

                            if (initialized) {
                                notifyEvent({
                                    type: 'save'
                                });
                            } else {
                                notifyEvent({
                                    type: 'initialised'
                                });
                            }

                            return true;
                        },

            renameInputRow = function (tr, i) {
                var regex = /\[\]/;

                // For all input
                $.each($(tr).find('input, select'), function (index, c) {
                    if (c.id !== "") {
                        var linked = $.find('label[for="' + c.id + '"], button[for="' + c.id + '"]');
                        c.id = c.id + '_' + Math.floor((Math.random() * 10000000));
                        $(linked).attr("for", c.id);
                    }
                });

                // For radio buttons
                var chx = $(tr).find('input[type="radio"]');
                $.each(chx, function (index, r) {
                    var linked = $.find('label[for="' + r.id + '"], button[for="' + r.id + '"]');
                    if (r.name.match(regex) === null) {
                        r.name += '[' + i + ']';
                    } else {
                        r.name = r.name.replace(regex, '[' + i + ']');
                        r.name += '[]';
                    }

                    r.id += "_" + index;

                    $(linked).attr('for', r.id);
                });
            },

            setSpecialFields = function (tr) {
                // SELECT
                tr.find('select').removeClass('chzn-done').show();
                tr.find('.chzn-container').remove();
                $('select').chosen({
                    disable_search_threshold: 5,
                    allow_single_deselect: false
                });

                // FMTOGGLE
                try {
                    tr.find('.fmtoggle').bootstrapToggle();
                } catch (e) {
                }

                // FMTOUCHSPIN
                try {
                    tr.find('.fmtouchspin').TouchSpin();
                } catch (e) {
                }

                // FMDATETIMEPICKER
                try {
                    tr.find('.fmdatetimepicker').datetimepicker();
                    tr.on('dp.change', '.fmdatetimepicker', function () {
                        save();
                    }.bind(this));
                } catch (e) {
                }

                // STATES SELECT
                try {
                    tr.find('select[class^="fm-chzn-states"], select[class*=" fm-chzn-states"]').statesselect();
                } catch (e) {
                }

                // RADIO
                try {
                    tr.find('.fmradio').radio();
                } catch (e) {
                }

                // TOOLTIP
                try {
                    tr.find('.hasTooltip').tooltip();
                } catch (e) {
                }

                // COLORPICKER
                try {
                    tr.find('.minicolors').each(function () {
                        $(this).minicolors({
                            control: 'hue',
                            position: 'right',
                            theme: 'bootstrap',
                            change: function () {
                                save();
                            }
                        });
                    });
                } catch (e) {
                }
            },

                        removeRow = function (tr) {
                            $(tr).remove();

                            // Unstyle disabled add buttons
                            if (addButton != undefined && addButton.hasClass("disabled")) {
                                addButton.removeClass("disabled").addClass("btn-success");
                            }

                            notifyEvent({
                                type: 'rowRemoved',
                                row: $(tr)
                            });

                            save();
                            return true;
                        },

            addRowInTable = function (values, addInFirst) {
                // Don't allow a new row to be added if we're at the maximum value
                if (options.maximum && getRows().length >= options.maximum)
                    return false;

                var clone = rowTemplate.clone();

                if (addInFirst)
                    clone.prependTo(body);
                else
                    clone.appendTo(body);

                // 'Disable' the new button if we are at the maximum value
                if (addButton != undefined && options.maximum && getRows().length === (options.maximum - 1))
                    addButton.removeClass("btn-success").addClass("disabled");

                renameInputRow(clone, getRows().length);

                // Insert values
                var subkeys = Object.keys(values);

                $.each(subkeys, function (index, l) {
                    clone.find('*[name*="[' + l + ']"]').each(function (index, f) {
                        var type = $(f).attr('type');
                        var value = values[l];

                        if (type === 'checkbox') {
                            if (value === 1)
                                $(f).prop('checked', true);
                        } else if (type === 'radio') {
                            if (value === $(f).val()) {
                                $(f).prop('checked', true);
                                $(f).trigger('change');
                            }
                        } else {
                            // Works for input,select and textareas
                            $(f).val(value);
                            if ($(f).prop('tagName') === 'SELECT') {
                                // Manually fire chosen dropdown update
                                $(f).trigger('liszt:updated');
                            }
                        }
                    });
                });

                setSpecialFields(clone);

                // Events
                if (options.canremove) {
                    clone.find("*[data-repeater-remove-button]").click(function (e) {
                        var tr = $(e.target).closest("tr");
                        if (tr.length > 0) return removeRow(tr);
                        return false;
                    }.bind(this));
                }

                clone.on('change', '*[name*="]["]', function () {
                    notifyEvent({
                        type: 'rowChanged',
                        row: $(this).closest("tr")
                    });

                    save();
                }.bind(this));

                if (initialized) {
                    notifyEvent({
                        type: 'rowAdded',
                        row: clone
                    });
                } else {
                    notifyEvent({
                        type: 'rowInitialized',
                        row: clone
                    });
                }

                save();

                return clone;
            },

            addRow = function (values) {
                addRowInTable(values, options.addInFirst);
            },

            reset = function () {
                getRows().remove();

                // Unstyle disabled add buttons
                if (addButton != undefined && addButton.hasClass("disabled")) {
                    addButton.removeClass("disabled").addClass("btn-success");
                }

                save();
                return true;
            },

            setValues = function (newValues) {
                reset();

                // Add initiale values
                var values = $.map(newValues, function (value) {
                    return [value];
                });

                for (var i = 0; i < values.length; i++) {
                    var rowValues = values[i];
                    addRowInTable(rowValues, false);
                }

                options.values = values;
            };

        // Public API
        repeaterTable.addRow = addRow;
        repeaterTable.removeRow = removeRow;
        repeaterTable.save = save;
        repeaterTable.reset = reset;
        repeaterTable.setValues = setValues;

        // Initializing elements
        initialized = false;
        body = element.find("tbody").first();

        if (body.length === 0)
            throw "Repeater element must have a tbody item.";

        rowTemplate = body.find("tr").first().clone();

        if (element.find('*[data-repeater-add-button]').size() === 0) {
            addButton = element.find('.btn.btn-success');
        } else {
            addButton = element.find('*[data-repeater-add-button]');
        }

        if (element.find('*[data-repeater-save]').size() === 0) {
            element.append('<input type="hidden" value="" data-repeater-save />');
        }

        saveInput = element.find('*[data-repeater-save]');

        // Remove the rom model of the body
        element.find("tbody tr").first().remove();

        // Events
        if (options.canadd) {
            addButton.click(function () {
                return addRow(options.defaultValues);
            }.bind(this));
        }

        // Add initiale values
        setValues(options.values);

        initialized = true;

        return repeaterTable;
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

    $.fn.repeater = function (options) {
        return this.each(function () {
            var $this = $(this);
            if (!$this.data('Repeater')) {
                var elopts = optsFromEl(this, 'repeater');
                // create a private copy of the defaults object
                options = $.extend(true, {}, $.fn.repeater.defaults, elopts, options);
                $this.data('Repeater', repeater($this, options));
            }
        });
    };

    $.fn.repeater.defaults = {
        maximum: false,
        addInFirst: true,
        canadd: true,
        canremove: true,
        defaultValues: {},
        values: {}
    };
}));