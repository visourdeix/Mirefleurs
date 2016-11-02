'use strict';

var FMMod_Events = null;

(function ($) {
    FMMod_Events = {
        initialiseScore: function (selector) {
            $(selector + ' .fm-results-score').on('change', function () {
                if ($(this).val() !== '') {
                    $(this).closest('.fm-match-thumbnail').find('.fm-results-state').val(1).trigger("liszt:updated");
                } else if ($(this).closest('.fm-match-thumbnail').find('input[name*="score1"]').val() === '' && $(this).closest('.fm-match-thumbnail').find('input[name*="score2"]').val() === '') {
                    $(this).closest('.fm-match-thumbnail').find('.fm-results-state').val(0).trigger("liszt:updated");
                }
                $(this).closest(selector).find('#toolbar #refresh, #toolbar #save').show();
                $(this).closest(selector).find('#message').hide();
                $(this).closest('.fm-match-thumbnail').attr('data-updated', "1");
            });

            $(selector + ' .fm-results-state').on('change', function () {
                if ($(this).prop('checked')) {
                    if ($(this).closest('.fm-match-thumbnail').find('input[name*="score1"]').val() === '') $(this).closest('.fm-match-thumbnail').find('input[name*="score1"]').val(0);
                    if ($(this).closest('.fm-match-thumbnail').find('input[name*="score2"]').val() === '') $(this).closest('.fm-match-thumbnail').find('input[name*="score2"]').val(0);
                } else {
                    $(this).closest('.fm-match-thumbnail').find('input[name*="score1"]').val('');
                    $(this).closest('.fm-match-thumbnail').find('input[name*="score2"]').val('');
                }

                $(this).closest(selector).find('#toolbar #refresh, #toolbar #save').show();
                $(this).closest(selector).find('#message').hide();
                $(this).closest('.fm-match-thumbnail').attr('data-updated', "1");
            });
        },

        save: function (module, id) {
            var matches = [];

            $('#' + id + ' .fm-match-thumbnail[data-updated="1"] input[name*="matches[id]"]').each(function () {
                var item = {
                    id: $(this).val(),
                    score1: $(this).closest('.fm-match-thumbnail').find('input[name*="score1"]').val(),
                    state: $(this).closest('.fm-match-thumbnail').find('select[name*="state"]').val(),
                    score2: $(this).closest('.fm-match-thumbnail').find('input[name*="score2"]').val()
                };
                matches.push(item);
            });

            var dataToSend = { matches: matches };

            var success = function (result) {
                FMMod_Events.updateEvents(module, id);
                var data = $.parseJSON(result);
                var alertHtml = '<div class="alert alert-' + data["class"] + '">' + data["message"] + '</div>';
                $('#' + id + ' #message').html(alertHtml);
                $('#' + id + ' #message').show();
            };

            FM.loadAjax('index.php?option=com_fmmanager&task=match.saveOnAjax', dataToSend, success, '#' + id);
        },

        updateEvents: function (module, id) {
            var params = {};
            $('#' + id + ' #filter input[type="text"], #' + id + ' #filter input[type="radio"]:checked').each(function () {
                var name = $(this).attr("name");
                if (name !== undefined) {
                    var indexStart = name.indexOf("[") + 1;
                    var indexEnd = name.indexOf("]", indexStart);
                    var field = name.substring(indexStart, indexEnd);
                    params[field] = $(this).val();
                }
            });

            $('#' + id + ' #filter select option:selected').each(function () {
                var name = $(this).closest("select").attr("name");
                var isMultiple = $(this).closest("select").attr("multiple");
                if (name !== undefined) {
                    var indexStart = name.indexOf("[") + 1;
                    var indexEnd = name.indexOf("]", indexStart);
                    var field = name.substring(indexStart, indexEnd);
                    if (isMultiple !== undefined) {
                        if (!params[field]) params[field] = [];
                        params[field].push($(this).val());
                    } else {
                        params[field] = $(this).val();
                    }
                }
            });

            var success = function () {
                $('#' + id + ' .fm-results-score').TouchSpin({
                    verticalbuttons: true
                });

                $('#' + id + ' .fm-results-state').removeClass('chzn-done').show();
                $('#' + id + ' .fm-results-state').find('.chzn-container').remove();
                $('#' + id + ' .fm-results-state').chosen({
                    disable_search_threshold: 5,
                    allow_single_deselect: false
                });
                $('#' + id + ' .fm-results-state').statesselect();

                FMMod_Events.initialiseScore('#' + id);

                $('#' + id + ' #refresh, #' + id + ' #save').hide();
            };

            FM.displayModule(module, id, params, undefined, success);
            $('#' + id + ' #message').hide();

            return false;
        },

        initialise: function (module, selector) {
            FMMod_Events.initialiseScore(selector);

            $(selector + ' #filter input.on_change, ' + selector + ' #filter select.on_change').on('change', function () {
                FMMod_Events.updateEvents(module, $(this).closest(selector).attr('id'));
            });

            $(selector + ' #refresh, ' + selector + ' #search').on('click', function () {
                FMMod_Events.updateEvents(module, $(this).closest(selector).attr('id'));
            });

            $(selector + ' #save').on('click', function () {
                FMMod_Events.save(module, $(this).closest(selector).attr('id'));
            });

            FMMod_Events.updateEvents(module, $(selector).attr('id'));
        }
    }
})(jQuery);