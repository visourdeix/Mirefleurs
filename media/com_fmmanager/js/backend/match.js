/**
 * @package     Joomla.Administrator
 * @subpackage  Templates.isis
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @since       3.0
 */

(function ($) {
    $(document).ready(function () {
        var importing = false;
        var previousTactic = [];
        var initialized = false;
        var cancelChangeTactic = false;

        // -------------- FUNCTIONS ---------------

        // ---- Tab General ----

        /* Update the field for a withdraw. */
        function updateWithdraw(number) {
            var winner = (number === "1") ? "2" : "1";
            var looser = number;
            $('input[type="checkbox"][name="jform[withdraw' + winner + ']"]').bootstrapToggle('off');
            $('input[name="jform[score' + looser + ']"]').val(0);
            $('input[name="jform[score' + winner + ']"]').val(3);
            $('input[type="checkbox"][name="jform[extra_time]"]').bootstrapToggle('off');
            $('input[name="jform[penalties' + winner + ']"]').val(0);
            $('input[name="jform[penalties' + looser + ']"]').val(0);
            $('input[name="jform[bonus' + looser + ']"]').val(-1);
            $('input[name="jform[bonus' + winner + ']"]').val(0);
            $('select[name="jform[state]"]').val(1).trigger('liszt:updated');
        }

        /* Initialise the input events. */
        function initGeneralInputs() {
            // Score changed -> State = played
            $('input[name="jform[score1]"], input[name="jform[score2]"], input[name="jform[penalties1]"], input[name="jform[penalties2]"]').on("change", function () {
                $('select[name="jform[state]"]').val(1).trigger('liszt:updated');
            });

            // Withdraw 1
            $('input[name="jform[withdraw1]"]').on("change", function () {
                if ($(this).prop("checked"))
                    updateWithdraw("1");
            });

            // Withdraw 2
            $('input[name="jform[withdraw2]"]').on("change", function () {
                if ($(this).prop("checked"))
                    updateWithdraw("2");
            });
        }

        // ---- Tab Teams ----

        /* Toggle the visibility between complex/simple squad. */
        function updateTacticVisibility(number, tacticId) {
            if (tacticId > 0) {
                $("#fm-match-players" + number).hide();
                $("#fm-match-tactic" + number).show();
            } else {
                $("#fm-match-players" + number).show();
                $("#fm-match-tactic" + number).hide();
            }
        }

        // -- Players Table --

        /* Toggle the visibility of fields in squad table. */
        function updatePlayersRowItemVisibility(row) {
            var state0 = $(row).find('input[name *="[state]"][value="0"]');
            var state3 = $(row).find('input[name *="[state]"][value="3"]');

            if (state0.prop("checked")) {
                $(row).find('input[name*="[state]"]').closest("td").nextAll('td').find('> div').hide();
            } else {
                $(row).find('input[name*="[state]"]').closest("td").nextAll('td').find('> div').show();
                if (state3.prop("checked"))
                    $(row).find('input[name*="[captain]"]').closest("td").find('> div').hide();
            }
        }

        // -- Players Tactic --

        /* Update the position of tactic. */
        function updateTactic(number, tacticId) {
            if (!cancelChangeTactic) {
                var saveImporting = importing;
                if (previousTactic[number] > 0 && tacticId !== previousTactic[number]) {
                    if (!confirm("Etes vous sur de vouloir modifier la tactique ? Vous perdrez les modifications sur la tactique actuelle.")) {
                        cancelChangeTactic = true;
                        FM.setValue('select[name="jform[tactic' + number + '_id]"]', previousTactic[number]);
                        cancelChangeTactic = false;
                        return;
                    }
                }

                previousTactic[number] = tacticId;
                updateTacticVisibility(number, tacticId);
                if (tacticId > 0) {
                    var dataToSend = { id: tacticId };

                    var success = function (result) {
                        $("#jform_firstTeamPlayers" + number + "_tacticeditor").data('TacticEditor').setReadOnlyPositions(result);
                        if (!saveImporting) $("#jform_firstTeamPlayers" + number + "_tacticeditor").data('TacticEditor').setValues([]);
                    };

                    var always = function () {
                        importing = false;
                    };

                    FM.loadAjaxData("getTacticPositions", dataToSend, success, "#fm-teams", always);
                } else {
                    updateStatisticsTableFromTable('#jform_playersStatistics' + number + '_personstable', '#jform_players' + number + '_personstable');
                }
            }
        }

        /* Display the captain in the tactic. */
        function updateCaptainInTactic(number, label) {
            $("#jform_firstTeamPlayers" + number + "_tacticeditor table tbody label").each(function (index, item) {
                if (label.data("captain") === 1 && label.attr("for") !== $(item).attr("for"))
                    $(item).data("captain", 0);

                if ($(item).data("captain") === 0 || $(item).data("captain") == undefined) {
                    $(item).closest("td").find(".fm-tactic-captain").remove();
                }
            });

            if (label.data("captain") === 1 && label.find('.fm-tactic-captain').length === 0)
                $('<span class="fm-tactic-captain" title="Capitaine"><i class="fa fa-certificate"></i></span>').insertAfter(label);

            $("#jform_firstTeamPlayers" + number + "_tacticeditor table tbody .fm-tactic-captain").tooltip();
        }

        // -- Buttons --

        /* Import tactic and players from previous match of the team. */
        function importSquadFromPreviousMatch(number) {
            importing = true;
            var matchId = $("#jform_id").val();
            var teamId = $("#jform_team" + number + "_id").val();

            var dataToSend = { match_id: matchId, team_id: teamId };

            var success = function (result) {
                var tactic = result["tactic"] ? result["tactic"] : "0";
                $('select[name="jform[tactic' + number + '_id]"]').val(tactic).trigger('liszt:updated');
                $('select[name="jform[tactic' + number + '_id]"]').trigger('change');

                if (result["players"].length) {
                    // Tactic
                    if (tactic > 0) {
                        var firstPlayers = $.grep(result["players"], function (a) { return (a.state === 2 || a.state === 1); });
                        var substitutes = $.grep(result["players"], function (a) { return a.state === 3; });
                        $("#jform_firstTeamPlayers" + number + "_tacticeditor").data('TacticEditor').setValues(firstPlayers);
                        $("#jform_substitutes" + number + "_repeater").data('Repeater').setValues(substitutes);
                    } else {
                        // Player Table
                        $('#jform_players' + number + '_personstable tr:not(.fm-row-all) input[name*="[state]"][value="0"]').prop("checked", true).trigger('change');
                        $('#jform_players' + number + '_personstable tr:not(.fm-row-all) input[name*="[captain]"]').bootstrapToggle("off");
                        $('#jform_players' + number + '_personstable tr:not(.fm-row-all) input[name*="[number]"]').val("");

                        for (var i = 0; i < result["players"].length; i++) {
                            var tr = $('#jform_players' + number + '_personstable input[name*="[person_id]"][value="' + result["players"][i]["person_id"] + '"]').closest("tr");
                            tr.find('input[name*="[state]"][value="' + result["players"][i]["state"] + '"]').prop("checked", true).trigger('change');
                            if (result["players"][i]["captain"] === 1)
                                tr.find('input[name*="[captain]"]').bootstrapToggle("on");
                            tr.find('input[name*="[number]"]').val(result["players"][i]["number"]);
                        }
                    }
                }

                // Staff Table
                if (result["staff"].length) {
                    $('#jform_staff' + number + '_personstable tr:not(.fm-row-all) input[name*="[state]"][value="0"]').prop("checked", true).trigger('change');

                    for (var j = 0; j < result["staff"].length; j++) {
                        var tr1 = $('#jform_staff' + number + '_personstable input[name*="[person_id]"][value="' + result["staff"][j]["person_id"] + '"]').closest("tr");
                        tr1.find('input[name*="[state]"][value="1"]').prop("checked", true).trigger('change');
                    }
                }
            };

            var always = function () {
                importing = false;
            };

            FM.loadAjaxData("getPreviousMatchTactic", dataToSend, success, "#fm-teams", always);
        }

        /* Import tactic and players from call up. */
        function importSquadFromCallUp(number) {
            importing = true;
            var callUpId = $("#jform_call_up_id").val();
            var dataToSend = { call_up_id: callUpId };
            var url = 'index.php?option=com_fmmanager&task=data.getCallUpPersons';

            var success = function (result) {
                if (result["players"].length) {
                    $('select[name="jform[tactic' + number + '_id]"]').val(0).trigger('liszt:updated');
                    $('select[name="jform[tactic' + number + '_id]"]').trigger('change');

                    // Player Table
                    $('#jform_players' + number + '_personstable tr:not(.fm-row-all) input[name*="[state]"][value="0"]').prop("checked", true).trigger('change');
                    $('#jform_players' + number + '_personstable tr:not(.fm-row-all) input[name*="[captain]"]').bootstrapToggle("off");
                    $('#jform_players' + number + '_personstable tr:not(.fm-row-all) input[name*="[number]"]').val("");

                    for (var i = 0; i < result["players"].length; i++) {
                        var tr = $('#jform_players' + number + '_personstable input[name*="[person_id]"][value="' + result["players"][i]["person_id"] + '"]').closest("tr");
                        tr.find('input[name*="[state]"][value="1"]').prop("checked", true).trigger('change');
                    }
                }

                // Staff Table
                if (result["staff"].length) {
                    $('#jform_staff' + number + '_personstable tr:not(.fm-row-all) input[name*="[state]"][value="0"]').prop("checked", true).trigger('change');

                    for (var j = 0; j < result["staff"].length; j++) {
                        var tr1 = $('#jform_staff' + number + '_personstable input[name*="[person_id]"][value="' + result["staff"][j]["person_id"] + '"]').closest("tr");
                        tr1.find('input[name*="[state]"][value="1"]').prop("checked", true).trigger('change');
                    }
                }
            };

            var always = function () {
                importing = false;
            };

            FM.loadAjaxData("getCallUpPersons", dataToSend, success, "#fm-teams", always);
        }

        // ---- Tab Stastistics ----

        /* Count the statistic from a column */
        function getSumStatistics(table, column) {
            var sum = 0;

            $(table + ' tr:not(.fm-row-all)').closest("tr").find('td[data-title="' + column + '"] input').each(function () {
                var val = ($(this).val() === '') ? 0 : $(this).val();
                sum += parseInt(val);
            });

            return sum;
        }

        /* Count the statistic from a column */
        function setAllSumStatistics(table) {
            $(table + ' tr.fm-row-all input[name *="statistic"]').each(function () {
                var title = $(this).closest("td").attr("data-title");
                $(this).val(getSumStatistics(table, title));
            });
        }

        /* Update row visibility of the table */
        function updateStatisticsTableFromTable(table, tableSource) {
            $(table + ' tbody tr:not(.fm-row-all)').each(function () {
                var personId = $(this).find('input[name*="[person_id]"]').val();
                if ($(tableSource + ' tbody tr input[name*="[person_id]"][value="' + personId + '"]').closest("tr").find('input[name *="[state]"][value="0"]').prop('checked')) {
                    $(this).find('input[name *="person_id"]').closest("td").nextAll("td").find("input").val("");
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
            setAllSumStatistics(table);
        }

        /* Update row visibility of the table */
        function updateStatisticsTableFromTactic(number, updateValue) {
            $('#jform_playersStatistics' + number + '_personstable tbody tr:not(.fm-row-all)').each(function () {
                var personId = $(this).find('input[name*="[person_id]"]').val();

                var isSub = ($('#jform_substitutes' + number + '_repeater select[name*="[person_id]"] option[value="' + personId + '"]:selected').length > 0);
                var isFirstTeam = ($('#jform_firstTeamPlayers' + number + '_tacticeditor_save').val().indexOf('"person_id":"' + personId + '"') > 0);

                if (!isSub && !isFirstTeam) {
                    if (updateValue)
                        $(this).find('input[name *="person_id"]').closest("td").nextAll("td").find("input").val("");
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
            setAllSumStatistics('#jform_playersStatistics' + number + '_personstable');
        }

        // -- Initialisation --

        /* initialise the events for a team. */
        function initTeamFields(number) {
            // Toggle players Tactic/Table
            previousTactic[number] = $('select[name="jform[tactic' + number + '_id]"]').val();
            updateTacticVisibility(number, previousTactic[number]);

            // -- Staff Table --

            // Initialise fields
            $('#jform_staff' + number + '_personstable .fmradio').radio();
            $('#jform_staff' + number + '_personstable tr:not(.fm-row-all) .fmtouchspin').TouchSpin();
            $('#jform_staff' + number + '_personstable .fmtoggle').bootstrapToggle();
            $('#jform_staff' + number + '_personstable .hasTooltip').tooltip();

            // State -> Row visibility
            $('#jform_staff' + number + '_personstable tbody tr:not(.fm-row-all)').each(function () {
                $(this).find('input[name *="[state]"]').on("change", function () {
                    updateStatisticsTableFromTable('#jform_staffStatistics' + number + '_personstable', '#jform_staff' + number + '_personstable');
                });
            });

            // Change all States
            $('#jform_staff' + number + '_personstable tr.fm-row-all input[name *="[state]"]').on("change", function () {
                if ($(this).prop("checked"))
                    $('#jform_staff' + number + '_personstable tr:not(.fm-row-all) input[name *="[state]"][value="' + $(this).val() + '"]').prop('checked', true).trigger("change");
            });

            // -- Players Table --
            $('table tr.fm-row-all *[name*="[all]"]').each(function () {
                $(this).attr('name', $(this).attr('name').replace('jform', 'all'));
            });

            // Initialise fields
            $('#jform_players' + number + '_personstable .fmradio').radio();
            $('#jform_players' + number + '_personstable tr:not(.fm-row-all) .fmtouchspin').TouchSpin();
            $('#jform_players' + number + '_personstable .fmtoggle').bootstrapToggle();
            $('#jform_players' + number + '_personstable .hasTooltip').tooltip();

            // Initialise row ALL
            $('#jform_players' + number + '_personstable tr.fm-row-all input[id *="_number"]').closest("td").find("div").hide();
            $('#jform_players' + number + '_personstable tr.fm-row-all input[id *="_captain"]').closest("td").find("div").hide();
            $('#jform_players' + number + '_personstable tr.fm-row-all span[id *="_goal"]').closest("td").find("div").hide();
            $('#jform_players' + number + '_personstable tr.fm-row-all .fm-addgoal').closest("td").find("div").hide();

            // Change all States
            $('#jform_players' + number + '_personstable tr.fm-row-all input[name *="[state]"]').on("change", function () {
                if ($(this).prop("checked"))
                    $('#jform_players' + number + '_personstable tr:not(.fm-row-all) input[name *="[state]"][value="' + $(this).val() + '"]').prop('checked', true).trigger("change");
            });

            // Force 1 or 0 captain.
            $('#jform_players' + number + '_personstable tr:not(.fm-row-all) input[name *="[captain]"]').on("change", function () {
                if ($(this).prop("checked"))
                    $('#jform_players' + number + '_personstable tr:not(.fm-row-all) input[name *="[captain]"]:not(#' + $(this).prop('id') + ')').bootstrapToggle('off');
            });

            // State -> Row visibility
            $('#jform_players' + number + '_personstable tbody tr:not(.fm-row-all)').each(function () {
                updatePlayersRowItemVisibility($(this));
                $(this).find('input[name *="[state]"]').on("change", function () {
                    updatePlayersRowItemVisibility($(this).closest("tr"));
                    updateStatisticsTableFromTable('#jform_playersStatistics' + number + '_personstable', '#jform_players' + number + '_personstable');
                });
            });

            // Add Goal
            $('#jform_players' + number + '_personstable tbody tr .fm-addgoal').on("click", function (e) {
                var personId = $(this).closest("tr").find('input[name *="[person_id]"]').val();
                $('#jform_goals' + number + '_repeater').data('Repeater').addRow({ striker_id: personId });
                e.preventDefault();
            });

            // -- Players Tactic --

            // Update tactic positions
            $('select[name="jform[tactic' + number + '_id]"]').on("change", function () {
                var val = $('select[name="jform[tactic' + number + '_id]"]').val();
                updateTactic(number, val);
            });

            // Captain in Tactics
            $("#jform_firstTeamPlayers" + number + "_tacticeditor").on("positionUpdated", function (e) {
                if ($('select[name="jform[tactic' + number + '_id]"]').val() > 0)
                    updateCaptainInTactic(number, e.label);
            });

            // Update Statitistcs Row Visibility
            if ($('select[name="jform[tactic' + number + '_id]"]').val() > 0)
                updateStatisticsTableFromTactic(number, false);

            $("#jform_firstTeamPlayers" + number + "_tacticeditor, #jform_substitutes" + number + "_repeater").on("save", function () {
                if ($('select[name="jform[tactic' + number + '_id]"]').val() > 0)
                    updateStatisticsTableFromTactic(number, true);
            });

            // -- Buttons --

            // Import from Previous match
            $("#team" + number + "-import-from-previous-match:not(.disabled)").on("click", function () {
                importSquadFromPreviousMatch(number);
            });

            // Import from Call up
            $("#team" + number + "-import-from-call-up:not(.disabled)").on("click", function () {
                importSquadFromCallUp(number);
            });

            // -- Statistics Tab --

            // -- Players Statistics --
            if ($('select[name="jform[tactic' + number + '_id]"]').val() === "") {
                updateStatisticsTableFromTable('#jform_playersStatistics' + number + '_personstable', '#jform_players' + number + '_personstable');
            }

            // Initialise fields
            $('#jform_playersStatistics' + number + '_personstable .fmradio').radio();
            $('#jform_playersStatistics' + number + '_personstable tr:not(.fm-row-all) .fmtouchspin').TouchSpin();
            $('#jform_playersStatistics' + number + '_personstable .fmtoggle').bootstrapToggle();
            $('#jform_playersStatistics' + number + '_personstable .hasTooltip').tooltip();

            // Initialise row ALL
            $('#jform_playersStatistics' + number + '_personstable tr.fm-row-all input[id *="_statistic"]').attr('disabled', 'disabled');

            // Count statistics
            setAllSumStatistics('#jform_playersStatistics' + number + '_personstable');
            $('#jform_playersStatistics' + number + '_personstable tr:not(.fm-row-all) input[name *="statistic"]').on("change", function () {
                var inputTot = $('#jform_playersStatistics' + number + '_personstable tr.fm-row-all td[data-title="' + $(this).closest('td').attr("data-title") + '"] input');
                inputTot.val(getSumStatistics('#jform_playersStatistics' + number + '_personstable', $(this).closest('td').attr("data-title")));
            });

            // -- Staff Statistics --
            updateStatisticsTableFromTable('#jform_staffStatistics' + number + '_personstable', '#jform_staff' + number + '_personstable');

            // Initialise fields
            $('#jform_staffStatistics' + number + '_personstable .fmradio').radio();
            $('#jform_staffStatistics' + number + '_personstable tr:not(.fm-row-all) .fmtouchspin').TouchSpin();
            $('#jform_staffStatistics' + number + '_personstable .fmtoggle').bootstrapToggle();
            $('#jform_staffStatistics' + number + '_personstable .hasTooltip').tooltip();

            // Initialise row ALL
            $('#jform_staffStatistics' + number + '_personstable tr.fm-row-all input[name *="statistic"]').attr('disabled', 'disabled');

            // Count statistics
            setAllSumStatistics('#jform_staffStatistics' + number + '_personstable');
            $('#jform_staffStatistics' + number + '_personstable tr:not(.fm-row-all) input[name *="statistic"]').on("change", function () {
                var inputTot = $('#jform_staffStatistics' + number + '_personstable tr.fm-row-all td[data-title="' + $(this).closest('td').attr("data-title") + '"] input');
                inputTot.val(getSumStatistics('#jform_staffStatistics' + number + '_personstable', $(this).closest('td').attr("data-title")));
            });
        }

        // -------------- INITIALISATION ---------------

        initGeneralInputs();
        initTeamFields("1");
        initTeamFields("2");

        initialized = true;
    });
})(jQuery);